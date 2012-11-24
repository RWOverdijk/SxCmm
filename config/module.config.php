<?php

namespace SxCmm;

return array(
    'doctrine' => array(
        'driver' => array(
            strtolower(__NAMESPACE__) => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'paths' => array(__DIR__ . '/../src/'.__NAMESPACE__.'/Entity'),
            ),
            'orm_default' => array(
                'drivers' => array(
                    __NAMESPACE__.'\Entity' => strtolower(__NAMESPACE__),
                ),
            ),
        ),
    ),
    'view_helpers' => array(
        'invokables' => array(
            'contentarea' => __NAMESPACE__ . '\View\Helper\ContentArea',
        ),
    ),
    'view_manager' => array(
        'template_map' => array(
            'component/area' => __DIR__ . '/../view/sxcmm/component/area.phtml',
            'component/text' => __DIR__ . '/../view/sxcmm/component/text.phtml',
            'component/html' => __DIR__ . '/../view/sxcmm/component/html.phtml',
        ),
    ),
    'component_manager' => array(
        'invokables' => array(
            'html' => __NAMESPACE__ . '\Component\Html',
            'text' => __NAMESPACE__ . '\Component\Text',
        ),
    ),
);
