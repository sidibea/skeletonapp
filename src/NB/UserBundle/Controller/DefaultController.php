<?php

namespace NB\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('NBUserBundle:Default:index.html.twig');
    }
}
