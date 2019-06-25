<?php

namespace App\Services;

use App\Entity\Acl;
use App\Security\Voter\AclVoter;
use Knp\Menu\FactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Security\Core\Security;

class MenuBuilder
{
    /**
     * Factory
     *
     * @var FactoryInterface
     */
    private $factory;

    /**
     * Security
     *
     * @var Security
     */
    private $security;

    /**
     * Request
     *
     * @var RequestStack
     */
    private $request;

    /**
     * @param FactoryInterface $factory
     * @param Security $security
     * @param RequestStack $request
     *
     * Add any other dependency you need
     */
    public function __construct(FactoryInterface $factory, Security $security, RequestStack $request)
    {
        $this->factory = $factory;
        $this->security = $security;
        $this->request = $request;
    }

    public function createMainMenu(array $options)
    {
        $currentRoute = $this->request->getCurrentRequest()->get('_route');

        $menu = $this->factory->createItem('root', array(
            'childrenAttributes'    => array(
                'class'             => 'nav nav-main',
            ),
            'display' => false
        ));

        $menu->addChild('Posts', [
            'route' => 'app_admin_posts',
            'labelAttributes' => [
                'icon' => 'gi gi-white-house'
            ]
        ]);
        if ($currentRoute == 'app_admin_posts') {
            $menu->setCurrent(true);
        }

        return $menu;
    }
}