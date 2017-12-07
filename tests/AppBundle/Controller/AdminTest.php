<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\AdminController;
use AppBundle\Entity\Category;
use AppBundle\Entity\Frame;
use AppBundle\Entity\Subcategory;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class AdminTest
 * Unit test of the AdminController
 * @package Tests\AppBundle\Controller
 */
class AdminTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test create action of category
     */
    public function testCreateCategoryAction()
    {
        $category = new Category();
        $category->setName('test');
        $category->setImageName('test.png');

        // Now, mock the repository so it returns the mock of the employee
        $categoryRepository = $this->createMock(ObjectRepository::class);
        // use getMock() on PHPUnit 5.3 or below
        // $employeeRepository = $this->getMock(ObjectRepository::class);
        $categoryRepository->expects($this->any())
            ->method('find')
            ->willReturn($category);

        // Last, mock the EntityManager to return the mock of the repository
        $objectManager = $this->createMock(ObjectManager::class);
        // use getMock() on PHPUnit 5.3 or below
        // $objectManager = $this->getMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($categoryRepository);

        $this->assertEquals('test', $category->getName());

    }

    /**
     * Test create action of subcategory
     */
    public function testCreateSubcategoryAction()
    {
        $subcategory = new Subcategory();
        $subcategory->setName('test');
        $subcategory->setImageName('test.png');

        // Now, mock the repository so it returns the mock of the employee
        $subcategoryRepository = $this->createMock(ObjectRepository::class);
        // use getMock() on PHPUnit 5.3 or below
        // $employeeRepository = $this->getMock(ObjectRepository::class);
        $subcategoryRepository->expects($this->any())
            ->method('find')
            ->willReturn($subcategory);

        // Last, mock the EntityManager to return the mock of the repository
        $objectManager = $this->createMock(ObjectManager::class);
        // use getMock() on PHPUnit 5.3 or below
        // $objectManager = $this->getMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($subcategoryRepository);

        $this->assertEquals('test', $subcategory->getName());

    }

    /**
     * Test create action of frame
     */
    public function testNewFrameAction()
    {
        $frame = new Frame();
        $frame->setName('test');
        $frame->setImageName('test.png');

        // Now, mock the repository so it returns the mock of the employee
        $frameRepository = $this->createMock(ObjectRepository::class);
        // use getMock() on PHPUnit 5.3 or below
        // $employeeRepository = $this->getMock(ObjectRepository::class);
        $frameRepository->expects($this->any())
            ->method('find')
            ->willReturn($frame);

        // Last, mock the EntityManager to return the mock of the repository
        $objectManager = $this->createMock(ObjectManager::class);
        // use getMock() on PHPUnit 5.3 or below
        // $objectManager = $this->getMock(ObjectManager::class);
        $objectManager->expects($this->any())
            ->method('getRepository')
            ->willReturn($frameRepository);

        $this->assertEquals('test', $frame->getName());

    }
}
