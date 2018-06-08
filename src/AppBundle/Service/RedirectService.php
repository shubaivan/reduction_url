<?php

namespace AppBundle\Service;

use AppBundle\Event\ShortUrlEvent;
use AppBundle\Event\ShortUrlRedirectedEvent;
use AppBundle\Exception\InvalidCodeException;
use AppBundle\Repository\ShortUrlRepositoryInterface;
use Hashids\Hashids;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Class RedirectService.
 */
class RedirectService
{
    /** @var Hashids */
    private $hashids;

    /** @var ShortUrlRepositoryInterface $repository */
    private $shortUrlRepository;

    /** @var EventDispatcherInterface $dispatcher */
    private $dispatcher;

    /**
     * ProcessShortUrlService constructor.
     *
     * @param Hashids                     $hashids
     * @param ShortUrlRepositoryInterface $shortUrlRepository
     * @param EventDispatcherInterface    $dispatcher
     */
    public function __construct($hashids, $shortUrlRepository, $dispatcher)
    {
        $this->hashids = $hashids;
        $this->shortUrlRepository = $shortUrlRepository;
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param string $code
     *
     * @throws InvalidCodeException
     *
     * @return null|RedirectResponse
     */
    public function getRedirectResponse($code)
    {
        $ids = $this->hashids->decode($code);
        if (!isset($ids[0]) || !is_numeric($ids[0])) {
            throw new InvalidCodeException();
        }
        $id = $ids[0];

        $shortUrl = $this->shortUrlRepository->findOneById($id);
        if (!$shortUrl) {
            return null;
        }
        $event = new ShortUrlRedirectedEvent($shortUrl);
        $this->dispatcher->dispatch(ShortUrlEvent::SHORT_URL_REDIRECTED, $event);

        return new RedirectResponse($shortUrl->getUrl());
    }
}
