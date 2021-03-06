<?php

namespace NB\MainBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * TravelRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TravelRepository extends EntityRepository
{
    public function getTravelByRoute($from, $to, $doj)
    {
        $queryBuilder = $this
            ->createQueryBuilder('t')
            ->innerJoin('t.route', 'route')
            ->leftJoin('t.bus', 'bus')
            //    ->leftJoin('t.frequency', 'frequency')
            ->where('route.source = :fc')
            ->andWhere('route.destination = :tc')
            ->andWhere('t.active = :active')
            //->andWhere('(:gd) in f')
            //->andWhere('(:gd) in f')
            ->setParameters(array('fc' => $from, 'tc' => $to, 'active' => true ))
        ;
        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        // On retourne ces résultats
        $travel = array();
        //var_dump($results[0]->getFrequency()); exit;

        if($results == null){
            return $results;
        }else{
            foreach($results as $key=>$val){
                $frequency = "";

                foreach($val->getFrequency() as $k=>$v){
                    $frequency = $frequency.",".$v->getValue();
                }
                $travel[] = array(
                    'id' => $val->getId(),
                    'boardingTime' => $val->getBoardingTime(),
                    'arrivalTime' => $val->getArrivalTime(),
                    'price' => $val->getPrice(),
                    'busRegno' => $val->getBus()->getRegno(),
                    'busType' => $val->getBus()->getType(),
                    'busCompany' => $val->getBus()->getCompany()->getNom(),
                    'busCapacity' => $val->getBus()->getCapacity(),
                    'frequency' => $frequency,
                    'bookedSeat' => $val->setBookedSeats($this->_em->getRepository('NBMainBundle:Reservation')->getBookedSeats($val->getBus()->getId(), $doj))
                );




                //var_dump($val->getBus()->getId()); exit;
            }

        }

        // echo "<pre>";
        // var_dump($travel); exit;

        // var_dump($results); exit;
        return $travel;
    }

    public function getTravelById($id){
        $queryBuilder = $this
            ->createQueryBuilder('t')
            ->where('t.id = :id')
            ->setParameter('id', $id)
        ;

        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        // On retourne ces résultats


        return $results[0];
    }
    public function getCompanyDistinctBoardingTime($company){
        $query = "select distinct(t.bordingTime) from travel t
            left join bus b on b.id = t.bus_id
            where b.company_id = $company;";

        $total = $this->_em->getConnection()->prepare($query);
        $total->execute();
        $results = $total->fetchAll();
        // echo $date; exit;
        return $results;
    }
}
