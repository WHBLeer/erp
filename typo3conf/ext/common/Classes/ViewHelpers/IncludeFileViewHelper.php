<?php

namespace Sll\Common\ViewHelpers;

/**
 * This file is part of the "news" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 */
use TYPO3\CMS\Core\Page\PageRenderer;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3Fluid\Fluid\Core\ViewHelper\Traits\CompileWithRenderStatic;

/**
 * ViewHelper to include a css/js file
 *
 * # Example: Basic example
 * <code>
 * <sll:includeFile path="https://cdn.staticfile.org/highlight.js/9.15.6/styles/atom-one-dark-reasonable.min.css" />
 * </code>
 * <output>
 * This will include the file provided by {settings} in the header
 * </output>
 * 
 */
class IncludeFileViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper implements CompilableInterface
{
    use CompileWithRenderStatic;

    /**
     */
    public function initializeArguments()
    {
        $this->registerArgument('path', 'string', 'Path to the CSS/JS file which should be included', true);
        $this->registerArgument('compress', 'bool', 'Define if file should be compressed', false, false);
    }

    /**
     * @param array $arguments
     * @param \Closure $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     */
    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $paths =  explode(',',$arguments['path']);
        // dump($paths);
        $compress = (bool)$arguments['compress'];
        $pageRenderer = GeneralUtility::makeInstance(PageRenderer::class);

        for ($i=0; $i < count($paths); $i++) { 
            // JS
            if (strtolower(substr($paths[$i], -3)) === '.js') {
                $a = $pageRenderer->addJsFile($paths[$i], null, $compress, false, '', true);
            } 

            // CSS
            if (strtolower(substr($paths[$i], -4)) === '.css') {
                $b = $pageRenderer->addCssFile($paths[$i], 'stylesheet', 'all', '', $compress, false, '', true);
            }
        }
    }
}
