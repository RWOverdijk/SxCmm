<?php

namespace SxCmm\Component;

use Zend\View\Model\ViewModel;

class Text extends AbstractComponent
{
    /**
     * Assemble the text component.
     *
     * @return \Zend\View\Model\ViewModel
     */
    public function assemble()
    {
        $viewModel = new ViewModel(array(
            'text' => $this->getSetting('text')
        ));

        $viewModel->setTemplate('component/text');

        return $viewModel;
    }
}
