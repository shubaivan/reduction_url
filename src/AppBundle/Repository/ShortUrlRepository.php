<?php

namespace AppBundle\Repository;

use AppBundle\Entity\ShortUrlInterface;
use Doctrine\ORM\EntityRepository;

/**
 * Class ShortUrlRepository.
 */
class ShortUrlRepository extends EntityRepository implements ShortUrlRepositoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function findOneById($id)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.id = :id')
            ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function findOneByUrl($url)
    {
        $qb = $this->createQueryBuilder('s');
        $qb->where('s.url = :url')
            ->setParameter('url', $url);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * {@inheritdoc}
     */
    public function save(ShortUrlInterface $shortUrl)
    {
        $this->_em->persist($shortUrl);
        $this->_em->flush($shortUrl);

        return $shortUrl;
    }
}
