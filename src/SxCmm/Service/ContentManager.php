<?php

namespace SxCmm\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\View\Model\ViewModel;

/**
 * @todo allow for components to be services
 */
class ContentManager implements ServiceLocatorAwareInterface
{
    /**
     * @var array The configuration
     */
    protected $config;

    /**
     * @var array An array of components
     */
    protected $components;

    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var SxCmm\Mapper\ComponentMapper
     */
    protected $componentMapper;

    /**
     * @var ComponentManager
     */
    protected $componentManager;

    /**
     * Construct the ContentManager
     *
     * @param array $config
     */
    public function __construct($config)
    {
        $this->setConfig($config);
    }

    /**
     * Set the config
     *
     * @param array $config
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * Get the content for area $area on page $page
     *
     * @param   string  $area
     * @param   string  $page
     *
     * @return ViewModel
     */
    public function getContent($area, $page)
    {
        $viewModel            = new ViewModel;
        $viewModel->areaName  = $area;

        $viewModel->setTemplate('component/area');

        $components = $this->getComponentMapper()->findByAreaAndPage($area, $page);

        if (empty($components)) {
            return $viewModel;
        }

        $this->assembleComponents($components, $viewModel);

        return $viewModel;
    }

    /**
     * Assemble the components in $components
     *
     * @param   array       $components
     * @param   ViewModel   $viewModel
     */
    protected function assembleComponents($components, $viewModel)
    {
        $assembledComponents = array();

        foreach ($components as $component) {
            /* @var $component \SxCmm\Entity\Component */

            $componentInstance = $this->getComponentManager()->get($component->getType());

            $componentInstance->setComponentEntity($component);

            $assembledComponents[] = $componentInstance->assemble();
        }

        $viewModel->components = $assembledComponents;
    }

    /**
     * Get the component mapper
     *
     * @return SxCmm\Mapper\Component
     */
    protected function getComponentMapper()
    {
        if (null === $this->componentMapper) {
            $this->componentMapper = $this->getServiceLocator()->get('SxCmm\Mapper\Component');
        }

        return $this->componentMapper;
    }

    /**
     * Get the component manager
     *
     * @return \SxCmm\Service\ComponentManager
     */
    protected function getComponentManager()
    {
        return $this->componentManager;
    }

    /**
     * Set the component manager
     * 
     * @param \SxCmm\Service\ComponentManager $componentManager
     */
    public function setComponentManager(ComponentManager $componentManager)
    {
        $this->componentManager = $componentManager;
    }

    /**
     * {@inheritDoc}
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * {@inheritDoc}
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
