<?php
namespace ERP\ErpManagementProduct\Controller;


/***
 *
 * This file is part of the "产品管理" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * VariantsController
 */
class VariantsController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * variantsRepository
     * 
     * @var \ERP\ErpManagementProduct\Domain\Repository\VariantsRepository
     * @inject
     */
    protected $variantsRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {
        $variants = $this->variantsRepository->findAll();
        $this->view->assign('variants', $variants);
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $variants
     * @return void
     */
    public function showAction(\ERP\ErpManagementProduct\Domain\Model\Variants $variants)
    {
        $this->view->assign('variants', $variants);
    }

    /**
     * action new
     * 
     * @return void
     */
    public function newAction()
    {
    }

    /**
     * action create
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $newVariants
     * @return void
     */
    public function createAction(\ERP\ErpManagementProduct\Domain\Model\Variants $newVariants)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->variantsRepository->add($newVariants);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $variants
     * @ignorevalidation $variants
     * @return void
     */
    public function editAction(\ERP\ErpManagementProduct\Domain\Model\Variants $variants)
    {
        $this->view->assign('variants', $variants);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $variants
     * @return void
     */
    public function updateAction(\ERP\ErpManagementProduct\Domain\Model\Variants $variants)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->variantsRepository->update($variants);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementProduct\Domain\Model\Variants $variants
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementProduct\Domain\Model\Variants $variants)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->variantsRepository->remove($variants);
        $this->redirect('list');
    }
}
