<?php
declare(strict_types = 1);
namespace TYPO3\CMS\Install\ExtensionScanner;

/*
 * This file is part of the TYPO3 CMS project.
 *
 * It is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License, either version 2
 * of the License, or any later version.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 * The TYPO3 project - inspiring people to share!
 */

/**
 * Interface to be implemented by all classes which can search and find code places.
 */
interface CodeScannerInterface
{
    /**
     * Each match is an array with detail information
     *
     * @return array
     */
    public function getMatches(): array;
}
