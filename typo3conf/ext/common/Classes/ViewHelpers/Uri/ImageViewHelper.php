<?php
namespace Sll\Common\ViewHelpers\Uri;

/*                                                                        *
 * This script is part of the TYPO3 project - inspiring people to share!  *
 *                                                                        *
 * TYPO3 is free software; you can redistribute it and/or modify it under *
 * the terms of the GNU General Public License version 2 as published by  *
 * the Free Software Foundation.                                          *
 *                                                                        *
 * This script is distributed in the hope that it will be useful, but     *
 * WITHOUT ANY WARRANTY; without even the implied warranty of MERCHAN-    *
 * TABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General      *
 * Public License for more details.                                       *
 *                                                                        */

use TYPO3\CMS\Core\Resource\FileInterface;
use TYPO3\CMS\Core\Resource\FileReference;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Domain\Model\AbstractFileFolder;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Service\ImageService;
use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3\CMS\Fluid\Core\Rendering\RenderingContextInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\Facets\CompilableInterface;
use TYPO3\CMS\Fluid\Core\ViewHelper\Exception;


/**
 * Resizes a given image (if required) and returns its relative path.
 *
 * = Examples =
 *
 * <code title="Default">
 * <f:uri.image src="EXT:myext/Resources/Public/typo3_logo.png" />
 * </code>
 * <output>
 * typo3conf/ext/myext/Resources/Public/typo3_logo.png
 * or (in BE mode):
 * ../typo3conf/ext/myext/Resources/Public/typo3_logo.png
 * </output>
 *
 * <code title="Image Object">
 * <f:uri.image image="{imageObject}" />
 * </code>
 * <output>
 * fileadmin/images/image.png
 * or (in BE mode):
 * fileadmin/images/image.png
 * </output>
 *
 * <code title="Inline notation">
 * {f:uri.image(src: 'EXT:myext/Resources/Public/typo3_logo.png', minWidth: 30, maxWidth: 40)}
 * </code>
 * <output>
 * typo3temp/pics/[b4c0e7ed5c].png
 * (depending on your TYPO3s encryption key)
 * </output>
 *
 * <code title="non existing image">
 * <f:uri.image src="NonExistingImage.png" />
 * </code>
 * <output>
 * Could not get image resource for "NonExistingImage.png".
 * </output>
 */
class ImageViewHelper extends AbstractViewHelper  implements CompilableInterface
{
    /**
     * Resizes the image (if required) and returns its path. If the image was not resized, the path will be equal to $src
     *
     * @see https://docs.typo3.org/typo3cms/TyposcriptReference/ContentObjects/ImgResource/
     * @param string $src
     * @param FileInterface|AbstractFileFolder $image
     * @param string $width width of the image. This can be a numeric value representing the fixed width of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param string $height height of the image. This can be a numeric value representing the fixed height of the image in pixels. But you can also perform simple calculations by adding "m" or "c" to the value. See imgResource.width for possible options.
     * @param int $minWidth minimum width of the image
     * @param int $minHeight minimum height of the image
     * @param int $maxWidth maximum width of the image
     * @param int $maxHeight maximum height of the image
     * @param bool $treatIdAsReference given src argument is a sys_file_reference record
     * @param string|bool $crop overrule cropping of image (setting to FALSE disables the cropping set in FileReference)
     * @param bool $absolute Force absolute URL
     * @param int $mobileWidth
     * @param int $mobileHeight
     * @param int $mobileMaxWidth
     * @param int $mobileMaxHeight
     * @throws Exception
     * @return string path to the image
     */
    public function initializeArguments()
    {
        $this->registerArgument('src', 'string', 'src', true);
        $this->registerArgument('image', 'FileInterface', 'image', false);
        $this->registerArgument('width', 'string', 'width of the image', false);
        $this->registerArgument('height', 'string', 'height of the image', false);
        $this->registerArgument('minWidth', 'int', 'minimum width of the image', false);
        $this->registerArgument('minHeight', 'int', 'minimum height of the image', false);
        $this->registerArgument('maxWidth', 'int', 'maximum width of the image', false);
        $this->registerArgument('maxHeight', 'int', 'maximum height of the image', false);
        $this->registerArgument('treatIdAsReference', 'bool', 'maximum height of the image', false,false);
        $this->registerArgument('crop', 'bool', 'Force absolute URL', false);
        $this->registerArgument('absolute', 'bool', 'content', false,false);
        $this->registerArgument('mobileWidth', 'int', 'mobileWidth', false);
        $this->registerArgument('mobileHeight', 'int', 'mobileHeight', false);
        $this->registerArgument('mobileMaxWidth', 'int', 'mobileMaxWidth', false);
        $this->registerArgument('mobileMaxHeight', 'int', 'mobileMaxHeight', false);
    }
    
    public function render()
    {
        $src = $this->arguments['src'];
        $image= $this->arguments['image'];
        $width = $this->arguments['width'];
        $height = $this->arguments['height'];
        $minWidth = $this->arguments['minWidth'];
        $minHeight = $this->arguments['minHeight'];
        $maxWidth = $this->arguments['maxWidth'];
        $maxHeight = $this->arguments['maxHeight'];
        $treatIdAsReference= $this->arguments['treatIdAsReference'];
        $crop = $this->arguments['crop'];
        $absolute = $this->arguments['absolute'];
        $mobileWidth = $this->arguments['mobileWidth'];
        $mobileHeight = $this->arguments['mobileHeight'];
        $mobileMaxWidth = $this->arguments['mobileMaxWidth'];
        $mobileMaxHeight = $this->arguments['mobileMaxHeight'];
        
        return self::renderStatic(
            array(
                'src' => $src,
                'image' => $image,
                'width' => $width,
                'height' => $height,
                'minWidth' => $minWidth,
                'minHeight' => $minHeight,
                'maxWidth' => $maxWidth,
                'maxHeight' => $maxHeight,
                'treatIdAsReference' => $treatIdAsReference,
                'crop' => $crop,
                'absolute' => $absolute,
            ),
            $this->buildRenderChildrenClosure(),
            $this->renderingContext
        );
    }

    /**
     * @param array $arguments
     * @param callable $renderChildrenClosure
     * @param RenderingContextInterface $renderingContext
     * @return string
     * @throws Exception
     */
    public static function renderStatic(array $arguments, \Closure $renderChildrenClosure, RenderingContextInterface $renderingContext)
    {
        if(GeneralUtility::_GET('mobile')){
            if($arguments['mobileWidth']){
                $arguments['width'] = $arguments['mobileWidth'];
            }
            if($arguments['mobileHeight']){
                $arguments['height'] = $arguments['mobileHeight'];
            }
            if($arguments['mobileMaxWidth']){
                $arguments['maxWidth'] = $arguments['mobileMaxWidth'];
            }
            if($arguments['mobileMaxHeight']){
                $arguments['maxHeight'] = $arguments['mobileMaxHeight'];
            }
        }

        $src = $arguments['src'];
        $image = $arguments['image'];
        $treatIdAsReference = $arguments['treatIdAsReference'];
        $crop = $arguments['crop'];
        $absolute = $arguments['absolute'];

        if (is_null($src) && is_null($image) || !is_null($src) && !is_null($image)) {
            throw new Exception('You must either specify a string src or a File object.', 1382284105);
        }

        $imageService = self::getImageService();
        $image = $imageService->getImage($src, $image, $treatIdAsReference);

        if ($crop === null) {
            $crop = $image instanceof FileReference ? $image->getProperty('crop') : null;
        }

        $processingInstructions = array(
            'width' => $arguments['width'],
            'height' => $arguments['height'],
            'minWidth' => $arguments['minWidth'],
            'minHeight' => $arguments['minHeight'],
            'maxWidth' => $arguments['maxWidth'],
            'maxHeight' => $arguments['maxHeight'],
            'crop' => $crop,
            'mobile' => GeneralUtility::_GET('mobile')?1:0
        );
        $processedImage = $imageService->applyProcessingInstructions($image, $processingInstructions);
        return $imageService->getImageUri($processedImage, $absolute);
    }

    /**
     * Return an instance of ImageService using object manager
     *
     * @return ImageService
     */
    protected static function getImageService()
    {
        /** @var ObjectManager $objectManager */
        $objectManager = GeneralUtility::makeInstance(ObjectManager::class);
        return $objectManager->get(ImageService::class);
    }
}
