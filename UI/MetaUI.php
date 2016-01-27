<?php
namespace BruyereFreelance\SeoExtensionBundle\UI;

class MetaUI {

    private $contentId;
    private $contentName;
    private $title;
    private $metaDescription;

    /**
     * @return mixed
     */
    public function getContentId()
    {
        return $this->contentId;
    }

    /**
     * @param mixed $contentId
     */
    public function setContentId($contentId)
    {
        $this->contentId = $contentId;
    }

    /**
     * @return mixed
     */
    public function getContentName()
    {
        return $this->contentName;
    }

    /**
     * @param mixed $contentName
     */
    public function setContentName($contentName)
    {
        $this->contentName = $contentName;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * @param mixed $metaDescription
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;
    }

}