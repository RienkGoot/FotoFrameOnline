<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Frame
 *
 * @ORM\Table(name="frame")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FrameRepository")
 */
class Frame
{
    /**
     * @ORM\ManyToMany(targetEntity="Subcategory", mappedBy="frame")
     */
    private $subcategory;

    public function __construct()
    {
        $this->subcategory = new ArrayCollection();
    }

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="image_name", type="string", length=50)
     */
    private $imageName;

    /**
     * @var string
     *
     * @ORM\Column(name="image_width", type="string", length=50)
     */
    private $imageWidth;

    /**
     * @return string
     */
    public function getImageWidth()
    {
        return $this->imageWidth;
    }

    /**
     * @param string $imageWidth
     */
    public function setImageWidth($imageWidth)
    {
        $this->imageWidth = $imageWidth;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="image_height", type="string", length=50)
     */
    private $imageHeight;

    /**
     * @return string
     */
    public function getImageHeight()
    {
        return $this->imageHeight;
    }

    /**
     * @param string $imageHeight
     */
    public function setImageHeight($imageHeight)
    {
        $this->imageHeight = $imageHeight;
    }

    /**
     * @var int
     *
     * @ORM\Column(name="download", type="integer", length=11)
     */
    private $download;

    /**
     * @return int
     */
    public function getDownload()
    {
        return $this->download;
    }

    /**
     * @param int $download
     */
    public function setDownload($download)
    {
        $this->download = $download;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Frame
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set imageName
     *
     * @param string $imageName
     *
     * @return Frame
     */
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get imageName
     *
     * @return string
     */
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Add subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     *
     * @return Subcategory
     */
    public function addSubcategory(\AppBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategory[] = $subcategory;

        return $this;
    }

    /**
     * Remove subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     */
    public function removeSubcategory(\AppBundle\Entity\Subcategory $subcategory)
    {
        $this->subcategory->removeElement($subcategory);
    }

    /**
     * Get subcategory
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }
}
