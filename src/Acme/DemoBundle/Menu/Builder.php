<?php
// src/Acme/DemoBundle/Menu/Builder.php
namespace Acme\DemoBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $menu = $factory->createItem('root');

        $menu->addChild('Demo', array('route' => '_demo'));
        $menu->addChild('About Jerram', array(
            'route' => '_demo_hello',
            'routeParameters' => array('name' => 'Jerram')
        ));
        // ... add more children

        return $menu;
    }
}
