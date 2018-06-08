<?php

namespace AppBundle\Entity;

/**
 * Interface ShortUrlInterface.
 */
interface ShortUrlInterface
{
    /**
     * @return int
     */
    public function getId();

    /**
     * @return string
     */
    public function getCode();

    /**
     * @param string $code
     *
     * @return ShortUrlInterface
     */
    public function setCode($code);

    /**
     * @return string
     */
    public function getUrl();

    /**
     * @param string $url
     *
     * @return ShortUrlInterface
     */
    public function setUrl($url);

    /**
     * Set count.
     *
     * @param int $count
     *
     * @return ShortUrl
     */
    public function setCount($count);

    /**
     * Get count.
     *
     * @return int
     */
    public function getCount();

    /**
     * @return $this
     */
    public function addIterationCount();
}
