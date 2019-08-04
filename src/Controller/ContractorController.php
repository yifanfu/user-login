<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ContractorController extends AbstractController
{
    /**
     * @Route("/contract", name="contractor")
     */
    public function index()
    {
        return $this->render('contractor/index.html.twig');
    }
}
