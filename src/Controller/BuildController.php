<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Build;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\User2source;
use App\Entity\User2build;
use App\Entity\User;


class BuildController extends Controller
{
    public function index()
    {
        $session        = new Session();
        $user_id        = $session->get('user_id');
        $list           = array();
        $data           = array();
        $progres_list   = array();

        if ($user_id) {
            $repository     = $this->getDoctrine()->getRepository(User::class);
            $user           = $repository->find($user_id);

            $entityManager  = $this->getDoctrine()->getManager();
            $u2s            = $entityManager->getRepository(User2source::class)->findOneBy(["user"=>$user]);
    
            $repo           = $this->getDoctrine()->getRepository(User2build::class);
            $builds_prog    = $repo->findBy(["user" => $user]);

            $repository     = $this->getDoctrine()->getRepository(Build::class);
            $build_list     = $repository->findAll();
        
            if ($build_list) {
                $list = $build_list;
            }

            if ($builds_prog) {
                foreach ($builds_prog as $build) {
                    if (in_array("in_progress",$build->getState())  ) {
                        $progres_list[] = $build;
                    }
                }
            }
            if ($u2s) {
                $data = array(
                    "wood"      => $u2s->getWood(),
                    "stone"     => $u2s->getStone(),
                    "gold"      => $u2s->getGold(),
                );
            }
        }
        return $this->render('build.html.twig', array(
            'build_list'         => $list,
            'builds_in_progress' => $progres_list,
            'user_data'          => $data
        ));
    }
}