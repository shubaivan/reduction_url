<?php

namespace AppBundle\Service;

use AppBundle\Entity\ShortUrlInterface;
use AppBundle\Event\ShortUrlCreatedEvent;
use AppBundle\Event\ShortUrlEvent;
use AppBundle\Repository\ShortUrlRepositoryInterface;
use Hashids\Hashids;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class EncodeService.
 */
class EncodeService
{
    /** @var Hashids */
    private $hashids;

    /** @var ShortUrlRepositoryInterface */
    private $shortUrlRepository;

    /** @var EventDispatcherInterface */
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
     * @param ShortUrlInterface $shortUrl
     *
     * @throws \Exception
     *
     * @return ShortUrlInterface
     */
    public function process(ShortUrlInterface $shortUrl)
    {
        $existentShortUrl = $this->shortUrlRepository->findOneByUrl($shortUrl->getUrl());
        if ($existentShortUrl) {
            throw new \Exception('exist url');
        }
        $this->shortUrlRepository->save($shortUrl);

        $shortUrlId = $shortUrl->getId();
        $code = $this->hashids->encode($shortUrlId);

        $shortUrl->setCode($code);
        $shortUrl = $this->shortUrlRepository->save($shortUrl);

        $event = new ShortUrlCreatedEvent($shortUrl);
        $this->dispatcher->dispatch(ShortUrlEvent::SHORT_URL_CREATED, $event);

        return $shortUrl;
    }
}
