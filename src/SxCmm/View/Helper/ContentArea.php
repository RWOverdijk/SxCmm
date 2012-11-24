<?php

namespace SxCmm\View\Helper;

use Zend\View\Helper\AbstractHelper;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Locale;

class ContentArea extends AbstractHelper implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator;

    /**
     * @var string The page identifier
     */
    protected $pageIdentifier;

    /**
     * @var string The area identifier
     */
    protected $areaIdentifier;

    /**
     * @var SxCmm\Service\ContentManager
     */
    protected $contentManager;


    /**
     * Invoke the contentarea view helper.
     *
     * @param   string  $areaIdentifier
     * @param   string  $pageIdentifier
     *
     * @return  ContentArea
     * @todo    This may not be the perfect way to call this method.
     *          I can imagine that passing along the page ID every single time
     *          is not optimal use. Perhaps we some initializing.
     */
    public function __invoke($areaIdentifier, $pageIdentifier)
    {
        $this->setAreaIdentifier($areaIdentifier);
        $this->setPageIdentifier($pageIdentifier);

        return $this;
    }

    /**
     * Get the output for this area.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     * Set locale to use instead of the default.
     *
     * @param  string $locale
     *
     * @return ContentArea
     */
    public function setlocale($locale)
    {
        $this->getContentManager()->setLocale($locale);

        return $this;
    }

    /**
     * Get the locale to use.
     *
     * @return string|null
     */
    public function getlocale()
    {
        $this->getContentManager()->getLocale();
    }

    /**
     * Render the output for this area.
     *
     * @return string
     */
    public function render()
    {
        $contentManager = $this->getContentManager();
        $content        = $contentManager->getContent($this->getAreaIdentifier(), $this->getPageIdentifier());

        return $this->getView()->render($content);
    }

    /**
     * Get the content manager
     *
     * @return SxCmm\Service\ContentManager
     */
    protected function getContentManager()
    {
        if (null === $this->contentManager) {
            $this->contentManager = $this->getServiceLocator()->getServiceLocator()->get('SxCmm\Service\ContentManager');
        }

        return $this->contentManager;
    }

    /**
     * Set the area identifier.
     *
     * @param string $areaIdentifier
     */
    public function setAreaIdentifier($areaIdentifier)
    {
        $this->areaIdentifier = $areaIdentifier;
    }

    /**
     * Get the area identifier.
     *
     * @return string
     */
    public function getAreaIdentifier()
    {
        return $this->areaIdentifier;
    }

    /**
     * Set the page identifier.
     *
     * @param string $pageIdentifier
     */
    public function setPageIdentifier($pageIdentifier)
    {
        $this->pageIdentifier = $pageIdentifier;
    }

    /**
     * Get the page identifier.
     *
     * @return string
     */
    public function getPageIdentifier()
    {
        return $this->pageIdentifier;
    }

    /**
     * Get the service locator.
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * Set the service locator.
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }
}
