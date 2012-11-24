<?php

namespace SxCmm\Component;

use Zend\View\Model\ViewModel;

class Html extends AbstractComponent
{
    /**
     * Assemble the html component.
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function assemble()
    {
        $viewModel = new ViewModel(array(
            'html' => $this->getSetting('html')
        ));

        $viewModel->setTemplate('component/html');

        return $viewModel;
    }
}
