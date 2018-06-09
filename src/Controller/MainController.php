<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\User;
use App\Entity\User2build;

class MainController extends Controller
{
    public function index()
    {
        $result = "Niezalogowany";
        $number = mt_rand(0, 100);
        $session = new Session();
        $user_id = $session->get('user_id');
        $builds     = [];
        if ($user_id) {
        
            $repository = $this->getDoctrine()->getRepository(User::class);
            // look for a single Product by its primary key (usually "id")
            $user      = $repository->find($user_id);
            if ($user) {
                $result = "Witaj, ".$user->getUsername();
            }
            $repository     = $this->getDoctrine()->getRepository(User::class);
            $user           = $repository->find($user_id);
            $repo           = $this->getDoctrine()->getRepository(User2build::class);
            $builds_prog    = $repo->findBy(["user" => $user]);
            
            $progres_list          = array();
            if ($builds_prog) {
                foreach ($builds_prog as $build) {
                    if (in_array("active",$build->getState())  ) {
                        $builds[] = $build;
                    }
                }
            }
        }

        return $this->render('main.html.twig', array(
            'result' => $result,
            'builds' => $builds
        ));
    }
}