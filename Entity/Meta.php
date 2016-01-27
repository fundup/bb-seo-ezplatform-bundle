<?php

namespace BruyereFreelance\SeoExtensionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meta
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="BruyereFreelance\SeoExtensionBundle\Entity\Repository\MetaRepository")
 */
class Meta
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="contentId", type="integer", unique=true)
     */
    private $contentId;

    /**
     * @var string
     */
    private $contentName;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="metaDescription", type="text", nullable=true)
     */
    private $metaDescription;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contentId
     *
     * @param integer $contentId
     *
     * @return Meta
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;

        return $this;
    }

    /**
     * Get contentId
     *
     * @return integer
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * @return string
     */
    public function getContentName()
    {
        return $this->contentName;
    }

    /**
     * @param string $contentName
     */
    public function setContentName($contentName)
    {
        $this->contentName = $contentName;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Meta
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     *
     * @return Meta
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }
}

