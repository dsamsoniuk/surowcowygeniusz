<?php

// src/Controller/LuckyController.php
namespace App\Controller\ajax;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\Build;
use App\Entity\User;
use App\Entity\User2build;
use App\Entity\User2source;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\HttpFoundation\Session\Session;


class BuildController extends Controller
{

    public function create($id)
    {

        $session    = new Session();
        $user_id    = $session->get('user_id');

        if (!$user_id) {
            return new JsonResponse( array("result" => "fail", "res"=> $user_id, "info" => "Musisz byc zalogowany") );
        }

        $repository = $this->getDoctrine()->getRepository(Build::class);
        $build      = $repository->find($id);
        $repository = $this->getDoctrine()->getRepository(User::class);
        $user       = $repository->find($user_id);

        if ($build == NULL) {
            return new JsonResponse( array("result" => "fail", "info" => "brak budynku") );
        }

        // Sprawdz czy uzytkownik ma wystarczajaco ilosc surowcow
        // $repository = $this->getDoctrine()->getRepository(User2source::class);
        $entityManager = $this->getDoctrine()->getManager();
        $u2s = $entityManager->getRepository(User2source::class)->findOneBy(["user"=>$user]);

        // $u2s        = $repository->find($user_id);

        if ( $u2s->getWood() < $build->getWood() ) {
            return new JsonResponse( array("result" => "fail", "info" => "brak drewna") );
        }
        if ( $u2s->getStone() < $build->getStone() ) {
            return new JsonResponse( array("result" => "fail", "info" => "brak kamienia") );
        }
        if ( $u2s->getGold() < $build->getGold() ) {
            return new JsonResponse( array("result" => "fail", "info" => "brak złota") );
        }

        // Zaktualizuj ilosc dostepnych surowcow
        $u2s->setWood($u2s->getWood() - $build->getWood() );
        $u2s->setStone($u2s->getStone() - $build->getStone() );
        $u2s->setGold($u2s->getGold() - $build->getGold() );
        $entityManager->flush();
                
        $startTime  = date("Y-m-d H:i:s");
        $enTime     = date('Y-m-d H:i:s',strtotime('+'.$build->getTime().' second',strtotime($startTime)));
        $data       = array(
            "build_time" => $build->getTime(), 
            "name" => $build->getName(),
            "user_data" => array(
                "stone" => $u2s->getStone(),
                "wood" => $u2s->getWood(),
                "gold" => $u2s->getGold(),
            )
        );
        // Dodaj budynke do budowy
        $product    = new user2build();
        $product->setUser($user);
        $product->setBuild($build);
        $product->setState(array('in_progress'));
        $product->setDatetimeStart(\DateTime::createFromFormat('Y-m-d H:i:s', $startTime));
        $product->setDatetimeEnd(\DateTime::createFromFormat('Y-m-d H:i:s', $enTime));
        
        $entityManager  = $this->getDoctrine()->getManager();
        $entityManager->persist($product);
        $entityManager->flush();

        return new JsonResponse( array("result" => "success", "info" => "budynek dodany", "data" => $data) );
    }

    public function check()
    {

        $session    = new Session();
        $user_id    = $session->get('user_id');
        if (!$user_id) {
            return new JsonResponse( array("result" => "fail", "res"=> $user_id, "info" => "Musisz byc zalogowany") );
        }

        $repository = $this->getDoctrine()->getRepository(User::class);
        $user       = $repository->find($user_id);


        $repository     = $this->getDoctrine()->getRepository(User2build::class);
        $build_list     = $repository->findBy(["user"=> $user]);
        $time           = date("Y-m-d H:i:s");
        $date1          = \DateTime::createFromFormat('Y-m-d H:i:s', $time);

        foreach ($build_list as $build) {
            $build->setState(array('active'));
            $date2  = $build->getDatetimeEnd();
            if ($date1->getTimestamp() > $date2->getTimestamp()){
                // TODO: do zmiany tak normalnie nie moze byc
                $entityManager  = $this->getDoctrine()->getManager();
                $entityManager->persist($build);
                $entityManager->flush();
            }
        }
        return new JsonResponse( array("result" => "success") );
    }
}