<?php

namespace Sll\Common\ViewHelpers\Widget;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Extbase\Persistence\QueryResultInterface;

/**
 * This ViewHelper renders a Pagination of objects.
 *
 * = Examples =
 *
 * <code title="required arguments">
 * <sll:widget.paginateFe objects="{blogs}" as="paginatedBlogs">
 *   // use {paginatedBlogs} as you used {blogs} before, most certainly inside
 *   // a <f:for> loop.
 * </sll:widget.paginateFe>
 * </code>
 *
 */
class PaginateFeViewHelper extends \TYPO3\CMS\Fluid\Core\Widget\AbstractWidgetViewHelper
{

    /**
     * @var \Sll\Common\ViewHelpers\Widget\Controller\PaginateFeController
     */
    protected $controller;

    /**
     * Inject controller
     *
     * @param \Sll\Common\ViewHelpers\Widget\Controller\PaginateFeController $controller
     */
    public function injectController(\Sll\Common\ViewHelpers\Widget\Controller\PaginateFeController $controller)
    {
        $this->controller = $controller;
    }

    /**
     * Initialize arguments
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
        $this->registerArgument('objects', QueryResultInterface::class, 'Objects to auto-complete', true);
        $this->registerArgument('as', 'string', 'Property to fill', true);
        $this->registerArgument('configuration', 'array', 'Configuration', false, ['itemsPerPage' => 10, 'insertAbove' => false, 'insertBelow' => true]);
        $this->registerArgument('initial', 'array', 'Initial configuration', false, []);
    }

    /**
     * Render everything
     *
     * @param \TYPO3\CMS\Extbase\Persistence\QueryResultInterface $objects
     * @param string $as
     * @param mixed $configuration
     * @param array $initial
     * @internal param array $initial
     * @return string
     */
    public function render()
    {
        return $this->initiateSubRequest();
    }
}
