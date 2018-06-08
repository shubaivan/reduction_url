<?php

namespace AppBundle\Controller;

use AppBundle\Exception\InvalidCodeException;
use AppBundle\Service\RedirectService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectController extends Controller
{
    /**
     * @param string $code
     *
     * @throws InvalidCodeException
     *
     * @return RedirectResponse
     */
    public function indexAction($code)
    {
        /** @var RedirectService $redirectService */
        $redirectService = $this->get('reduction_url.service.redirect');

        $response = $redirectService->getRedirectResponse($code);
        if (null === $response) {
            throw new InvalidCodeException();
        }

        return $response;
    }
}
