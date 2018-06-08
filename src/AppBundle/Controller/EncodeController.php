<?php

namespace AppBundle\Controller;

use AppBundle\Factory\ShortUrlFactory;
use AppBundle\Service\EncodeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class EncodeController extends Controller
{
    /**
     * @param Request $request
     *
     * @return JsonResponse|string
     */
    public function indexAction(Request $request)
    {
        try {
            /** @var ShortUrlFactory $shortUrlFactory */
            $shortUrlFactory = $this->get('reduction_url.factory.short_url');

            /** @var EncodeService $encodeService */
            $encodeService = $this->get('reduction_url.service.encode');

            $url = $request->request->get('url');

            // validate and sanitize
            if (false === filter_var($url, FILTER_VALIDATE_URL)) {
                throw new \Exception('invalid url');
            }
            $url = rtrim($url, '/');

            $shortUrl = $shortUrlFactory->create($url);
            $shortUrl = $encodeService->process($shortUrl);

            return $this->render(
                'Main/_part_url.html.twig',
                [
                    'url' => $shortUrl,
                ]
            );
        } catch (\Exception $exception) {
            return new JsonResponse(['msg' => $exception->getMessage()], 400);
        }
    }
}
