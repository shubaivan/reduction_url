<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ShortUrlInterface;

/**
 * Interface ShortUrlRepositoryInterface.
 */
interface ShortUrlRepositoryInterface
{
    /**
     * @param int $id record id
     *
     * @return null|ShortUrlInterface
     */
    public function findOneById($id);

    /**
     * @param string $url
     *
     * @return null|ShortUrlInterface
     */
    public function findOneByUrl($url);

    /**
     * @param ShortUrlInterface $shortUrl
     *
     * @return ShortUrlInterface
     */
    public function save(ShortUrlInterface $shortUrl);
}
