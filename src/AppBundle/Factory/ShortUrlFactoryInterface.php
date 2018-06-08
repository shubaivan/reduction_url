<?php

namespace AppBundle\Factory;

use AppBundle\Entity\ShortUrlInterface;

/**
 * Interface ShortUrlFactoryInterface.
 */
interface ShortUrlFactoryInterface
{
    /**
     * @see http://stackoverflow.com/questions/7003416/validating-a-url-in-php
     *
     * @param string $url
     *
     * @return ShortUrlInterface
     */
    public function create($url);
}
