<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Configuration
 *
 * @ORM\Table(name="configuration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConfigurationRepository")
 */
class Configuration
{
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
     * @ORM\Column(name="logo", type="string", length=50)
     */
    private $logo;

    /**
     * @var string
     *
     * @ORM\Column(name="background_color", type="string", length=7)
     */
    private $backgroundColor;

    /**
     * @var string
     *
     * @ORM\Column(name="menu_color", type="string", length=7)
     */
    private $menuColor;

    /**
     * @var string
     *
     * @ORM\Column(name="menu_font_color", type="string", length=7)
     */
    private $menuFontColor;

    /**
     * @var string
     *
     * @ORM\Column(name="panel_color", type="string", length=7)
     */
    private $panelColor;

    /**
     * @var string
     *
     * @ORM\Column(name="panel_font_color", type="string", length=7)
     */
    private $panelFontColor;


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
     * Set logo
     *
     * @param string $logo
     *
     * @return Configuration
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set backgroundColor
     *
     * @param string $backgroundColor
     *
     * @return Configuration
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    /**
     * Get backgroundColor
     *
     * @return string
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * Set menuColor
     *
     * @param string $menuColor
     *
     * @return Configuration
     */
    public function setMenuColor($menuColor)
    {
        $this->menuColor = $menuColor;

        return $this;
    }

    /**
     * Get menuColor
     *
     * @return string
     */
    public function getMenuColor()
    {
        return $this->menuColor;
    }

    /**
     * Set menuFontColor
     *
     * @param string $menuFontColor
     *
     * @return Configuration
     */
    public function setMenuFontColor($menuFontColor)
    {
        $this->menuFontColor = $menuFontColor;

        return $this;
    }

    /**
     * Get menuFontColor
     *
     * @return string
     */
    public function getMenuFontColor()
    {
        return $this->menuFontColor;
    }

    /**
     * Set panelColor
     *
     * @param string $panelColor
     *
     * @return Configuration
     */
    public function setPanelColor($panelColor)
    {
        $this->panelColor = $panelColor;

        return $this;
    }

    /**
     * Get panelColor
     *
     * @return string
     */
    public function getPanelColor()
    {
        return $this->panelColor;
    }

    /**
     * Set panelFontColor
     *
     * @param string $panelFontColor
     *
     * @return Configuration
     */
    public function setPanelFontColor($panelFontColor)
    {
        $this->panelFontColor = $panelFontColor;

        return $this;
    }

    /**
     * Get panelFontColor
     *
     * @return string
     */
    public function getPanelFontColor()
    {
        return $this->panelFontColor;
    }
}

