<?php

namespace AppBundle\Entity;

use DateTime as DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as JMS;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class ShortUrl.
 *
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ShortUrlRepository")
 * @ORM\Table(name="short_url", indexes={@ORM\Index(name="idx", columns={"id", "url"})})
 */
class ShortUrl implements ShortUrlInterface
{
    use TraitTimestampable;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * @JMS\Expose()
     */
    protected $id;

    /**
     * @var string
     * @Assert\NotBlank(message="The code should not be blank")
     * @ORM\Column(name="code", type="string", unique=true, nullable=true, options={"collation":"utf8_bin"})
     * @JMS\Expose()
     */
    protected $code;

    /**
     * @var string
     * @Assert\NotBlank(message="The url should not be blank")
     * @Assert\Length(
     *   max = 255,
     *   maxMessage = "The url cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(name="url", type="string", length=255)
     * @JMS\Expose()
     */
    protected $url;

    /**
     * @var int
     *
     * @ORM\Column(name="count", type="integer", nullable=true)
     * @JMS\Expose()
     */
    protected $count;

    /**
     * ShortUrl constructor.
     */
    public function __construct()
    {
        $this->created = new DateTime();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * {@inheritdoc}
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * {@inheritdoc}
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getCount()
    {
        return null === $this->count ? 0 : $this->count;
    }

    /**
     * {@inheritdoc}
     */
    public function addIterationCount()
    {
        $this->count = $this->getCount() + 1;

        return $this;
    }
}
