<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Subcategory
 *
 * @ORM\Table(name="subcategory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubcategoryRepository")
 */
class Subcategory
{
    /**
     * @ORM\ManyToMany(targetEntity="Category", mappedBy="subcategory")
     */
    private $category;

    public function __construct()
    {
        $this->category = new ArrayCollection();
    }

    /**
     * @ORM\ManyToMany(targetEntity="Frame", inversedBy="subcategory")
     * @ORM\JoinColumn(name="frame_id", referencedColumnName="id")
     */
    private $frame;


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
     * @Assert\File(
     *      mimeTypesMessage = "U kunt alleen .png, .jpeg, .jpg en .gif uploaden.",
     *      mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif"
     *      }
     * )
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
     * @return Subcategory
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
     * @return Subcategory
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
     * Add category
     *
     * @param \AppBundle\Entity\Category $category
     *
     * @return Subcategory
     */
    public function addCategory(\AppBundle\Entity\Category $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \AppBundle\Entity\Category $category
     */
    public function removeCategory(\AppBundle\Entity\Category $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add frame
     *
     * @param \AppBundle\Entity\Frame $frame
     *
     * @return Subcategory
     */
    public function addFrame(\AppBundle\Entity\Frame $frame)
    {
        $this->frame[] = $frame;

        return $this;
    }

    /**
     * Remove frame
     *
     * @param \AppBundle\Entity\Frame $frame
     */
    public function removeFrame(\AppBundle\Entity\Frame $frame)
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
