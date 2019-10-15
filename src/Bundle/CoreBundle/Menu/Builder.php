<?php

declare(strict_types=1);

namespace Bundle\CoreBundle\Menu;

use Bundle\CategoryBundle\Entity\Category;
use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Bundle\ProfileBundle\Entity\Profile;
use Bundle\RoleBundle\Entity\Role;
use Bundle\UserBundle\Entity\User;
use Bundle\PointofsaleBundle\Entity\Pointofsale;
use Bundle\TicketBundle\Entity\Ticket;

class Builder implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    private $_route;

    const CIRCLE_1 = 'fa-circle-o text-yellow';
    const CIRCLE_2 = 'fa-circle-o text-aqua';
    const CIRCLE_3 = 'fa-circle-o text-blue';
    const CIRCLE_4 = 'fa-circle-o text-teal';
    const CIRCLE_5 = 'fa-circle-o text-red';
    const CIRCLE_6 = 'fa-circle-o text-purple';
    const CIRCLE_7 = 'fa-circle-o text-maroon';
    const CIRCLE_8 = 'fa-circle-o text-green';
    const CIRCLE_9 = 'fa-circle-o text-orange';

    function __construct() {

    }

    public function mainMenu(FactoryInterface $factory, array $options)
    {

        $request = $this->container->get('request_stack')->getCurrentRequest();
        $this->_route = $request->attributes->get('_route');

        $menu = $factory->createItem('root', [
            'childrenAttributes' => [
                'class' => 'sidebar-menu tree',
                'data-widget' => 'tree',
            ],
        ])
        ;
        
	    
        /**
         * DASHBOARD
         */
        $menu->addChild('Dashboard', [
            'route' => 'backend_dashboard_index',
            'extras' => ['safe_label' => true],
            'childrenAttributes' => [
                'class' => 'treeview-menu',
            ],
        ])
        ->setAttribute('class', 'treeview')
        ->setAttribute('icon', 'fa-fw fa-tv')
        ->setAttribute('class', $this->activeRoute('backend_dashboard_index'))
        ->setDisplay(true)
        ;
        /**
         * DASHBOARD
         */
	
	
	
	
	    /**
	     * ACCOUNTS
	     */
	    $isGranted = $this->isGranted([
		    User::ROLE_USER_VIEW
	    ]);
	    $menu->addChild('Cotización', [
		    'route' => 'backend_cotizacion_cotizacion',
		    'extras' => ['safe_label' => true],
		    'childrenAttributes' => [
			    'class' => 'treeview-menu',
		    ],
	    ])
		    ->setAttribute('class', 'treeview')
		    ->setAttribute('class', $this->activeRoute([
			    'backend_cotizacion_cotizacion',
		    ]))
		    ->setAttribute('icon', 'fa-fw fa-money')
		    ->setDisplay($isGranted)
	    ;
	    /**
	     * ACCOUNTS
	     */


        return $menu;
    }

    protected function getUser()
    {
        if (!$this->container->has('security.token_storage')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        if (null === $token = $this->container->get('security.token_storage')->getToken()) {
            return;
        }

        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return;
        }

        return $user;
    }

    protected function isGranted($attributes, $object = null)
    {
        if (!$this->container->has('security.authorization_checker')) {
            throw new \LogicException('The SecurityBundle is not registered in your application.');
        }

        return $this->container->get('security.authorization_checker')->isGranted($attributes, $object);
    }

    protected function activeRoute($routes): string
    {
        if(is_array($routes)){
            foreach ($routes as $key => $route){
                if($this->_route === $route){
                    return 'active';
                }
            }
        }

        if($this->_route === $routes){
            return 'active';
        }

        return '';
    }

}