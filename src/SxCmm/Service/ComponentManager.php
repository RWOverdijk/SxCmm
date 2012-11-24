<?php

namespace SxCmm\Service;

use Zend\ServiceManager\AbstractPluginManager;
use SxCmm\Component\AbstractComponent;
use SxCmm\Exception;

class ComponentManager extends AbstractPluginManager
{

    /**
     * Validate the plugin
     *
     * Checks that the helper loaded is an instance of Component\AbstractComponent.
     *
     * @param  mixed $plugin
     * @return void
     * @throws Exception\InvalidComponentException if invalid
     */
    public function validatePlugin($plugin)
    {
        if (!$plugin instanceof AbstractComponent) {
            throw new Exception\InvalidComponentException(sprintf(
                'Component must extend SxCmm\Component\AbstractComponent'
            ));
        }
    }
}
