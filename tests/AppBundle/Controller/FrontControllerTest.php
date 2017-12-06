<?php

namespace Tests\AppBundle\Controller;

use Tests\AppBundle\Controller\FrontController;
use AppBundle\Entity\Category;

class FrontControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testIndexAction()
    {

    }

    public function testCatAction()
    {
        $employee = new Category();
        $employee->setName('hoi');
        $employee->getName();
        $this->assertEquals('hoi', $employee->getName());

    }

    public function testSubAction()
    {

    }

    public function testFrameAction()
    {

    }
}
