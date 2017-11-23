<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @ORM\ManyToMany(targetEntity="Subcategory", inversedBy="category")
     * @ORM\JoinColumn(name="subcategory_id", referencedColumnName="id")
     */
    private $subcategory;

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
     * @ORM\Column(name="image_name", type="string", length=50)
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
     * @return Category
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
     * @return Category
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
     * Constructor
     */
    public function __construct()
    {
        $this->subcategory = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add subcategory
     *
     * @param \AppBundle\Entity\Subcategory $subcategory
     *
     * @return Category
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
