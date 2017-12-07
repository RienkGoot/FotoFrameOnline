<?php

namespace Tests\AppBundle\Controller;

use AppBundle\Controller\SecurityController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

/**
 * Class SecurityTest
 * Unit test the security controller
 * @package Tests\AppBundle\Controller
 */
class SecurityTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the login action
     */
    public function testLoginAction()
    {
        $session = $this->client->getContainer()->get('session');

        // the firewall context defaults to the firewall name
        $firewallContext = 'main';

        $token = new UsernamePasswordToken('admin', null, $firewallContext, array('ROLE_ADMIN'));
        $session->set('_security_'.$firewallContext, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);

    }

}
