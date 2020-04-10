<?php

namespace SGalinski\Lfeditor\ViewHelpers\Be\Menus;

/**
 *
 * Copyright notice
 *
 * (c) sgalinski Internet Services (https://www.sgalinski.de)
 *
 * All rights reserved
 *
 * This script is part of the TYPO3 project. The TYPO3 project is
 * free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * The GNU General Public License can be found at
 * http://www.gnu.org/copyleft/gpl.html.
 *
 * This script is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This copyright notice MUST APPEAR in all copies of the script!
 */

use TYPO3Fluid\Fluid\Core\Compiler\TemplateCompiler;
use TYPO3Fluid\Fluid\Core\Parser\SyntaxTree\ViewHelperNode;
use TYPO3Fluid\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper;

/**
 * View helper which returns a select box, that can be used to switch between
 * multiple actions and controllers and looks similar to TYPO3s funcMenu.
 * Note: This view helper is experimental!
 *
 * = Examples =
 *
 * <code title="Simple">
 * <f:be.menus.actionMenu>
 * <f:be.menus.actionMenuItem label="Overview" controller="Blog" action="index" />
 * <f:be.menus.actionMenuItem label="Create new Blog" controller="Blog" action="new" />
 * <f:be.menus.actionMenuItem label="List Posts" controller="Post" action="index" arguments="{blog: blog}" />
 * </f:be.menus.actionMenu>
 * </code>
 * <output>
 * Selectbox with the options "Overview", "Create new Blog" and "List Posts"
 * </output>
 *
 * <code title="Localized">
 * <f:be.menus.actionMenu>
 * <f:be.menus.actionMenuItem label="{f:translate(key:'overview')}" controller="Blog" action="index" />
 * <f:be.menus.actionMenuItem label="{f:translate(key:'create_blog')}" controller="Blog" action="new" />
 * </f:be.menus.actionMenu>
 * </code>
 * <output>
 * localized selectbox
 * <output>
 */
class ActionMenuViewHelper extends AbstractTagBasedViewHelper {
	/**
	 * @var string
	 */
	protected $tagName = 'select';

	/**
	 * An array of \TYPO3\CMS\Fluid\Core\Parser\SyntaxTree\AbstractNode
	 *
	 * @var array
	 */
	protected $childNodes = [];

	/**
	 * Initialize arguments.
	 *
	 * @throws \TYPO3Fluid\Fluid\Core\ViewHelper\Exception
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerArgument('defaultController', 'string', 'defaultController');
	}

	/**
	 * Render FunctionMenu
	 *
	 * @return string
	 */
	public function render() {
		$this->tag->addAttribute('onchange', 'jumpToUrl(this.options[this.selectedIndex].value, this);');
		$options = '';
		foreach ($this->childNodes as $childNode) {
			$options .= $childNode->evaluate($this->renderingContext);
		}
		$this->tag->setContent($options);
		return $this->tag->render();
	}

	/**
	 * @param string $argumentsName
	 * @param string $closureName
	 * @param string $initializationPhpCode
	 * @param ViewHelperNode $node
	 * @param TemplateCompiler $compiler
	 * @return null
	 */
	public function compile(
		$argumentsName, $closureName, &$initializationPhpCode, ViewHelperNode $node, TemplateCompiler $compiler
	) {
		// @TODO: replace with a true compiling method to make compilable!
		$compiler->disable();
		return NULL;
	}
}
