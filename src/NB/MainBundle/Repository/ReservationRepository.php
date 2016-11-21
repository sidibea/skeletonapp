<?php

namespace NB\MainBundle\Repository;

/**
 * ReservationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ReservationRepository extends \Doctrine\ORM\EntityRepository
{
    public function getBookedSeats($bus, $doj)
    {
        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->leftJoin('r.travel', 't')
            ->select('SUM(r.seats) As booked')
            ->where('t.bus =:bus')
            ->andWhere('r.doj = :doj')
            ->setParameters(array('bus' => $bus, 'doj' => $doj));
        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        $results = $results[0];


      // var_dump($results['booked']); exit;
        return $results['booked'];

    }

    public function getTicket($TID){
        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->innerJoin('r.tickets', 't')
            ->where('t.ticketNo =:TID')
            ->setParameter('TID', $TID);
        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        //$results = $results;


        // var_dump($results['booked']); exit;
        return $results[0];
    }

    public function findReservationByTicketId($id){

        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->innerJoin('r.tickets', 't')
            ->where('t.id =:TID')
            ->setParameter('TID', $id);
        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        //$results = $results;


        // var_dump($results['booked']); exit;
        return $results;

    }

    public function getLatests($user){

        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->where('r.channel_id = :user')
            ->setParameter('user', $user)
            ->setMaxResults(8)
        ;
        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        //$results = $results;


        // var_dump($results['booked']); exit;
        return $results;

    }

    public function getBookingNumber($user){

        $queryBuilder = $this
            ->createQueryBuilder('r')
            ->where('r.channel_id = :user')
            ->setParameter('user', $user)
        ;
        // On récupère la Query à partir du QueryBuilder
        $query = $queryBuilder->getQuery();
        // On récupère les résultats à partir de la Query
        $results = $query->getResult();
        //$results = $results;


        // var_dump($results['booked']); exit;
        return $results;

    }
}






