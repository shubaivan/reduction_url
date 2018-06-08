<?php

namespace AppBundle\Event;

use AppBundle\Entity\ShortUrlInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ShortUrlRedirectedEvent.
 */
class ShortUrlRedirectedEvent extends Event
{
    /** @var ShortUrlInterface */
    private $shortUrl;

    /**
     * ShortUrlRedirectedEvent constructor.
     *
     * @param ShortUrlInterface $shortUrl
     */
    public function __construct(ShortUrlInterface $shortUrl)
    {
        $this->shortUrl = $shortUrl;
    }

    /**
     * @return ShortUrlInterface
     */
    public function getShortUrl()
    {
        return $this->shortUrl;
    }
}
