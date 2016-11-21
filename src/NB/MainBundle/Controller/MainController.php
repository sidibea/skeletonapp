<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/11/16
 * Time: 3:31 AM
 */

namespace NB\MainBundle\Controller;


use NB\MainBundle\Entity\Income;
use NB\MainBundle\Entity\Outcome;
use NB\MainBundle\Entity\Reservation;
use NB\MainBundle\Entity\Ticket;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Unirest;

class MainController extends Controller{

    public function indexAction(){

        //  $cities = Unirest\Request::get('http://localhost/nextapi/web/app_dev.php/cities/name')->body;
     //   dump(array($cities)); exit;
        return $this->render('NBMainBundle::index.html.twig');
    }

    public function dashboardAction(){
        $user = $this->getUser();

        //  $cities = Unirest\Request::get('http://localhost/nextapi/web/app_dev.php/cities/name')->body;
        //   dump(array($cities)); exit;
        $latest_reservation = $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Reservation') ->getLatests($user->getId());
       // dump($reservation); exit;
        $sold = $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Reservation') ->getBookingNumber($user->getId());
        $cities =  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:City') ->findAll();
        $solde =  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Income') ->getStatus($this->getUser()->getId());

        return $this->render('NBMainBundle::dashboard.html.twig', array(
            'cities' => $cities,
            'latest_reservation' => $latest_reservation,
            'sold' => $sold,
            'solde' => $solde
        ));
    }

    public function searchAction(Request $request){
        $from = $request->get('from');
        $to = $request->get('to');

        $dateJ = date("Y-m-d", strtotime($request->get('dateJ')));

       // dump($dateJ); exit;

        $travel = $this->get('doctrine.orm.entity_manager')
            ->getRepository('NBMainBundle:Travel')
            ->getTravelByRoute($from, $to, date("d-m-Y", strtotime($dateJ)));
        // dump($travel); exit;

        return $this->render('NBMainBundle::search.html.twig', array(
            'travel' => $travel,
            'dateJ' => $dateJ,
            'from' =>  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:City') ->find($from),
            'to' =>  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:City') ->find($to)

        ));

    }

    public function rechargeAction(Request $request){

        $montant = $request->get('amount');
        $user = $this->getUser();
        $mobile = $user->getMob();

        $income = new Income();
        $em = $this->getDoctrine()->getManager();

        $OMRequest = [
            'endUserId' => 'tel:+'.$user->getMob(),
            'transactionOperationStatus' => 'Charged',
            'chargingInformation' => [
                'description' => 'Reservation de billet via nextBus',
                'amount' => (int) $montant,
                'currency' => 'XOF',
            ],
            'chargingMetaData' => [
                'serviceID' => 'SeatSeller recharge',
                'productID' => 'SEATSELLER #'.$user->getId(),
            ],
            'referenceCode' => 'nextBus R#'.uniqid(),
            'clientCorrelator' => 'NextBus #'.uniqid()
        ];

        $headers = array('Accept' => 'application/json', 'Authorization' => 'Bearer fc8ef78b9a13da650c2bcfa1b865737', 'Content-Type' => 'application/json');
        $body = Unirest\Request\Body::json($OMRequest);
        $no_encode = urlencode('tel:+'.$mobile);



        $response = Unirest\Request::post("https://api.sdp.orange.com/payment/v1/".$no_encode."/transactions/amount", $headers, $body);

        //return $response;
        if($response->code == '201'){

            $income->setMontant($montant);
            $income->setUsers($user);
            $income->setDateRecharge(new \datetime);
            $income->setCreatedAt(new \datetime);

            $em->persist($income);
            $em->flush();

            return new JsonResponse([
                'success' => true,
                'message' => 'votre Compte a été bien été crédité.'
            ]);

        }elseif($response->code == '500'){
            return new JsonResponse([
                'success' => false,
                'message' => 'Il y a eu une erreur lors de la transaction.',
                'code' => $response->code
            ]);

        }elseif($response->code == '403'){
            return new JsonResponse([
                'success' => false,
                'message' => 'Montant maximum autorisé est dépassé.',
                'code' => $response->code

            ]);
        }else{
            return new JsonResponse([
                'success' => false,
                'message' => 'Il y a eu une erreur lors de la transaction.',
                'code' => $response->body
            ]);

        }
    }


    function generator($previous)
    {

        $generator = pow(13,11);
        $modulus = pow(7,19); //int might be too small
        $possibleChars = "ACEFHJKMNPRTUVWXY49";

        $previous = ($previous + $generator) % $modulus;
        $output='';
        $temp = $previous;

        for($i = 0; $i < 6; $i++) {
            $output += $possibleChars[$temp % 19];
            $temp = $temp / 19;
        }

        return $output;
    }


    public function custInfoAction($travel, $dateJ, Request $request){
        $em = $this->getDoctrine()->getManager();

        $travel_obj =  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Travel') ->find($travel);

        if($request->isXmlHttpRequest()){

            $reservation = new Reservation();
            $ticket = new Ticket();
            $outcome = new Outcome();
            $nom_passager = $request->get('nom');
            $sexe = $request->get('gender');
            $age = $request->get('age');
            $mobile = $request->get('mobile');
            $email = $request->get('email');


            $solde =  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Income') ->getStatus($this->getUser()->getId());
            $booked = $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Reservation') ->getBookedSeats($travel, $dateJ);

            if($solde < $travel_obj->getPrice() ){

                return new JsonResponse([
                    'success' => false,
                    'message' => 'Votre solde est insuffisent pour la transaction demandée. Merci de recharger votre compte',
                ]);
            }elseif($travel_obj->getBus()->getCapacity() <= $booked){
                return new JsonResponse([
                    'success' => false,
                    'message' => 'Il n\'y a plus de places dans ce bus',
                ]);

            }else{
                $deducted =  ($travel_obj->getPrice() - (($travel_obj->getPrice() * 5)/100));

                $reservation->setDoj(new \datetime($dateJ));
                $reservation->setTravel($travel_obj);
                $reservation->setChannel('seatseller');
                $reservation->setChannelId($this->getUser()->getId());
                $reservation->setSeats('1');
                $reservation->setConfirmed(false);
                $reservation->setDateAdd(new \datetime);
                $reservation->setDateUpd(new \datetime);

                $em->persist($reservation);
                $ticketNo = strtr(strtoupper(base_convert(mt_rand(100000000,999999999), 15, 36)), "O01IS5", "ABCXYZ");

                $ticket->setNom($nom_passager);
                $ticket->setAge($age);
                $ticket->setGender($sexe);
                $ticket->setTelephone($mobile);
                $ticket->setEmail($email);
                $ticket->setTicketNo(date('d').date('m').$reservation->getId().$ticketNo);

                $reservation->setTickets($ticket);

                $em->persist($reservation);
                $em->flush();

                $outcome->setMontant($deducted);
                $outcome->setReservation($reservation);
                $outcome->setDatePaiement(new \Datetime);
                $outcome->setSeatseller($this->getUser());
                $outcome->setCreatedAt(new \datetime);

                $em->persist($outcome);
                $em->flush();

                return new JsonResponse([
                    'success' => true,
                    'message' => 'Votre reservation a éffectué avec succès.',
                    'booking' => $reservation->getId()
                ]);

            }

        }


        return $this->render('NBMainBundle::custInfo.html.twig', array(
            'travel' => $travel_obj,
            'dateJ' => $dateJ
        ));

    }


    public function confirmedAction($id, Request $request)
    {

        $reservation = $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Reservation')->find($id);
        // $ticket = $reservation->getTickets();

        return $this->render('NBMainBundle::confirmed.html.twig', array(
            'reservation' => $reservation,
            // 'ticket' => $ticket

        ));
    }

    public function printAction(Request $request){

        if($request->isXmlHttpRequest()){
            $id = $request->get('ticketno');
            $reservation =  $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Reservation') ->getTicket($id);

            if($reservation == null ){
                return new JsonResponse([
                    'success' => false,
                    'Numero du ticket est invalide.'
                ]);
            }else{
                return new JsonResponse([
                    'success' => true,
                    'reservation' => $reservation->getId(),
                    'message' => 'Impression'
                ]);
            }
        }
    }

    public function mybookingsAction(){


        return $this->render('NBMainBundle::mybookings.html.twig');
    }

    public function historyAction(Request $request){
        $user = $this->getUser();

        //  $cities = Unirest\Request::get('http://localhost/nextapi/web/app_dev.php/cities/name')->body;
        //   dump(array($cities)); exit;

        $history = $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Income') ->getHistory($user->getId());

        if($request->getMethod() == 'GET'){
            $from = date("Y-m-d", strtotime($request->get('start')));
            $to = date("Y-m-d", strtotime($request->get('end')));

            $history = $this->get('doctrine.orm.entity_manager')->getRepository('NBMainBundle:Income') ->getHistory($user->getId(), $from, $to);

        }

        return $this->render('NBMainBundle::history.html.twig', array(
            'history' => $history
        ));

    }




}