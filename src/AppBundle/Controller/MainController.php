<?php

namespace AppBundle\Controller;

use AppBundle\Form\UrlType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MainController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request)
    {
        return $this->render('Main/index.html.twig', [
            'urls' => $this->get('reduction_url.repository.short_url')->findAll(),
            'form' => $this->createForm(
                UrlType::class,
                null,
                [
                    'action' => '#',
                ]
            )->createView(),
        ]);
    }
}
