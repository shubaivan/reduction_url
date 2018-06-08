<?php

namespace AppBundle\EventSubscriber;

use AppBundle\Event\ShortUrlRedirectedEvent;
use AppBundle\Repository\ShortUrlRepositoryInterface;

class ReductionEventSubscriber
{
    /** @var ShortUrlRepositoryInterface */
    private $shortUrl;

    /**
     * EventSubscriber constructor.
     *
     * @param ShortUrlRepositoryInterface $shortUrl
     */
    public function __construct(ShortUrlRepositoryInterface $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    public function onRedirected(ShortUrlRedirectedEvent $event)
    {
        $event->getShortUrl()->addIterationCount();
        $this->shortUrl->save($event->getShortUrl());
    }
}
