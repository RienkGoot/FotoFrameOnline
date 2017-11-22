<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

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
    private $frame;

    public function __construct()
    {
        $this->frame = new ArrayCollection();
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
     * @ORM\Column(name="imageName", type="string", length=50)
     */
    private $imageName;


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
     * Add frame
     *
     * @param \AppBundle\Entity\Subcategory $frame
     *
     * @return Frame
     */
    public function addFrame(\AppBundle\Entity\Subcategory $frame)
    {
        $this->frame[] = $frame;

        return $this;
    }

    /**
     * Remove frame
     *
     * @param \AppBundle\Entity\Subcategory $frame
     */
    public function removeFrame(\AppBundle\Entity\Subcategory $frame)
    {
        $this->frame->removeElement($frame);
    }

    /**
     * Get frame
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getFrame()
    {
        return $this->frame;
    }
}
