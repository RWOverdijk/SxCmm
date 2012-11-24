<?php

namespace SxCmm;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ServiceManager\Config as ServiceManagerConfig;
use SxCmm\Service\ComponentManager;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__,
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }

    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'SxCmm\Mapper\Component' => function($sl) {
                    $mapper = new Mapper\Component;
                    $mapper->setEntityManager($sl->get('Doctrine\ORM\EntityManager'));

                    return $mapper;
                },
                'SxCmm\Service\ContentManager' => function($sl) {
                    $config               = $sl->get('Config');
                    $contentManagerConfig = !empty($config['content_manager']) ? $config['content_manager'] : array();
                    $contentManager       = new Service\ContentManager($contentManagerConfig);

                    $contentManager->setComponentManager($sl->get('component_manager'));

                    return $contentManager;
                },
                'component_manager' => function ($sl) {
                    $config                 = $sl->get('config');
                    $componentManagerConfig = new ServiceManagerConfig($config['component_manager']);

                    return new ComponentManager($componentManagerConfig);
                },
            ),
        );
    }
}
