<?php
use SIMONKOEHLER\Slug\Controller;

/*
 * This file was created by Simon Köhler
 * https://simon-koehler.com
 */

return [
    'savePageSlug' => [
        'path' => '/slug/savePageSlug',
        'target' => Controller\AjaxController::class . '::savePageSlug'
    ],
    'slugExists' => [
        'path' => '/slug/slugExists',
        'target' => Controller\AjaxController::class . '::slugExists'
    ],
    'generatePageSlug' => [
        'path' => '/slug/generatePageSlug',
        'target' => Controller\AjaxController::class . '::generatePageSlug'
    ],
    'getPageInfo' => [
        'path' => '/slug/getPageInfo',
        'target' => Controller\AjaxController::class . '::getPageInfo'
    ],
    'saveRecordSlug' => [
        'path' => '/slug/saveRecordSlug',
        'target' => Controller\AjaxController::class . '::saveRecordSlug'
    ],
    'generateRecordSlug' => [
        'path' => '/slug/generateRecordSlug',
        'target' => Controller\AjaxController::class . '::generateRecordSlug'
    ],
    'loadTreeItemSlugs' => [
        'path' => '/slug/loadTreeItemSlugs',
        'target' => Controller\AjaxController::class . '::loadTreeItemSlugs'
    ]
];
