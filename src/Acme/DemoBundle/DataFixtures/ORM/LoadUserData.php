<?php
// src/Acme/DemoBundle/DataFixtures/ORM/LoadUserData.php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Hautelook\AliceBundle\Alice\DataFixtureLoader;
use Nelmio\Alice\Fixtures;
use Acme\DemoBundle\Entity\User;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $objectManager)
    {
        $loader = new \Nelmio\Alice\Loader\Yaml();
        $objects = $loader->load(__DIR__.'/test.yml');

        foreach($objects as $object){

            $userManager = $this->container->get('fos_user.user_manager');
            $userAdmin = $userManager->createUser();
            $userAdmin->setUsername($object->getUsername());
            $userAdmin->setEmail($object->getEmail());
            $userAdmin->setPlainPassword('test');
            $userAdmin->setEnabled(true);

            $userManager->updateUser($userAdmin, true);
        }
    }
}
