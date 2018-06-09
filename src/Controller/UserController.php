<?php

// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Entity\User;
use App\Entity\User2source;

class UserController extends Controller
{
    public function login()
    {
        $login      = "";
        $password   = "";
        $session    = new Session();
        $result     =  "";


        if (isset($_POST['login']) && isset($_POST['password']) && $_POST['login'] != "" && $_POST['password'] != "") {

            $login      = $_POST['login'];
            $password   = $_POST['password'];
            $repo       = $this->getDoctrine()->getRepository(User::class);

            $user    = $repo->findOneBy([
                'login'     => $login,
                'password'  => $password,
            ]);
            if ($user) {
                $session->set('user_id', $user->getId());
                return $this->redirect('/');

            } else {
                $result = "Login lub haslo nie poprawne";
            }
        }

        return $this->render('forms/login.html.twig', array(
            'result' => $result
        ));
    }
    public function logout()
    {
        $session    = new Session();
        $session->set('user_id', 0);
        return $this->redirect('/');
    }
    public function register()
    {

        $login      = isset($_POST['login']) ? $_POST['login'] : "";
        $password   = (isset($_POST['password'])) ? $_POST['password'] : "";
        $email      = (isset($_POST['email'])) ? $_POST['email'] : "";
        $username   = (isset($_POST['username'])) ? $_POST['username'] : "";
        $result     = "";

        if ($login && $password && $email && $username) {
            $repo       = $this->getDoctrine()->getRepository(User::class);
            $user    = $repo->findOneBy([
                'login'     => $login
            ]);

            if (!$user) {
                $startTime  = date("Y-m-d H:i:s");

                // Dodaj uzytkownika
                $new_user    = new User();
                $new_user->setLogin($login);
                $new_user->setPassword($password);
                $new_user->setUsername($username);
                $new_user->setEmail($email);
                $new_user->setDate(\DateTime::createFromFormat('Y-m-d H:i:s', $startTime));
                
                $entityManager  = $this->getDoctrine()->getManager();
                $entityManager->persist($new_user);
                $entityManager->flush();

                $repo       = $this->getDoctrine()->getRepository(User::class);
                $user    = $repo->findOneBy([
                    'login'     => $login
                ]);

                // // Dodaj uzytkownika
                $u2s    = new User2source();
                $u2s->setUser($user);
                $u2s->setWood("888");
                $u2s->setGold("888");
                $u2s->setStone("888");
                $entityManager->persist($u2s);
                $entityManager->flush();

                $result = "Zostałeś zarejestrowany";
            } else {
                echo '4 lipa';

                $result = "Podany login juz istnieje";
            }
        }

        return $this->render('forms/register.html.twig', array(
            'result' => $result
        ));

    }
}