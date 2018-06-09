<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function index()
    {
        $number = mt_rand(0, 100);

        return $this->render('main.html.twig', array(
            'template'  => 'contact',
            'data'      => array("number" => $number)
        ));
    }
}