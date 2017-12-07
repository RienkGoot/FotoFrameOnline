<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\ContactController;
use AppBundle\Form\Type\ContactType;
use Doctrine\Tests\Common\Collections\TestObject;

/**
 * Class ContactTest
 * Unit Test for the ContactController
 * @package Tests\AppBundle\Controller
 */
class ContactTest extends \PHPUnit_Framework_TestCase
{
    public function indexAction()
    {
        $formData = array(
            'test' => 'test',
            'test2' => 'test2',
        );

        $form = $this->factory->create(ContactType::class);

        $object = TestObject::fromArray($formData);

        // submit the data to the form directly
        $form->submit($formData);

        $this->assertTrue($form->isSynchronized());
        $this->assertEquals($object, $form->getData());

        $view = $form->createView();
        $children = $view->children;

        foreach (array_keys($formData) as $key) {
            $this->assertArrayHasKey($key, $children);
        }
    }
}
