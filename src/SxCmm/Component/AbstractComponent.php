<?php

namespace SxCmm\Component;

use Zend\ServiceManager\ServiceManagerAwareInterface;
use Zend\ServiceManager\ServiceManager;
use SxCmm\Entity\Component as ComponentEntity;

/**
 * The abstract class to be extended by all components.
 */
abstract class AbstractComponent implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var SxCmm\Mapper\ComponentMapper
     */
    protected $componentMapper;

    /**
     * @var ComponentEntity
     */
    protected $componentEntity;

    /**
     * All components must implement this method, so the component can be assembled.
     *
     * @return \Zend\View\Model\ViewModel
     */
    abstract public function assemble();

    /**
     * Get a setting for the component.
     *
     * @param   string  $key        The key for the setting required.
     *
     * @return  string  The value
     */
    protected function getSetting($key)
    {
        return $this->getComponentEntity()->getSetting($key);
    }

    /**
     * Get the component mapper
     *
     * @return \SxCmm\Mapper\Component
     */
    protected function getComponentMapper()
    {
        if (null === $this->componentMapper) {
            $this->componentMapper = $this->getServiceLocator()->getServiceLocator()->get('SxCmm\Mapper\Component');
        }

        return $this->componentMapper;
    }

    /**
     * Set the component entity. The entity is used as a reference to the actual
     *  entity. All alterations will be applied to the entity.
     *
     * @param \SxCmm\Entity\Component $entity
     */
    public function setComponentEntity(ComponentEntity $entity)
    {
        $this->componentEntity = $entity;
    }

    /**
     * @return \SxCmm\Entity\Component $entity
     */
    protected function getComponentEntity()
    {
        return $this->componentEntity;
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
    public function setServiceManager(ServiceManager $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
