<?php
namespace ERP\ErpManagementDict\Controller;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/***
 *
 * This file is part of the "数据字典" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2020 王宏彬 <wanghongbin816@gmail.com>
 *
 ***/
/**
 * CategoryController
 */
class CategoryController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
     * @inject
     */
    protected $persistenceManager = null;

    /**
     * categoryRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\CategoryRepository
     * @inject
     */
    protected $categoryRepository = null;

    /**
     * dictitemRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\DictitemRepository
     * @inject
     */
    protected $dictitemRepository = null;

    /**
     * dicttypeRepository
     * 
     * @var \ERP\ErpManagementDict\Domain\Repository\DicttypeRepository
     * @inject
     */
    protected $dicttypeRepository = null;

    /**
     * action list
     * 
     * @return void
     */
    public function listAction()
    {

        /*
        $id = $_GET['cat'];
        $jsonstr = file_get_contents("cat/listJsonSize.json");
        $jsonarr = json_decode($jsonstr, true);
        dump($jsonarr);
        // if ($id == 0) {
            $this->addDictitem($jsonarr,'5');
        // } else {
        //     for ($i = 0; $i < count($jsonarr); $i++) {
        //         $this->addCategory($jsonarr['data' . $i]);
        //     }
        // }
        exit;

        */
        $keyword = $this->request->hasArgument('keyword') ? $this->request->getArgument('keyword') : '';
        if ($_GET["tx_erpmanagementdict_pi1"]["@widget_0"]["currentPage"]) {
            $page = $_GET["tx_erpmanagementdict_pi1"]["@widget_0"]["currentPage"];
        } else {
            $page = 1;
        }
        $this->view->assign('page', $page);
        $this->view->assign('keyword', $keyword);
        $categories = $this->categoryRepository->findFirstParent();
        $this->view->assign('categories', $categories);

        // dump($categories);
    }

    /**
     * @param $data
     */
    public function addDictitem($data = [],$typeid)
    {
        $dicttype = $this->dicttypeRepository->findByUid($typeid);
        for ($i = 0; $i < count($data); $i++) {
            $dictitem = new \ERP\ErpManagementDict\Domain\Model\Dictitem();
            $dictitem->setName($data[$i]['vatypeZwname']);
            $dictitem->setCode($data[$i]['vatypeYwname']);
            $dictitem->setDicttype($dicttype);
            // dump($dictitem);
            // exit;
            $this->dictitemRepository->add($dictitem);
            $this->persistenceManager->persistAll();
        }
        // return $category;
    }

    /**
     * @param $data
     */
    public function addCategory($data = [])
    {
        for ($i = 0; $i < count($data); $i++) {
            $category = new \ERP\ErpManagementDict\Domain\Model\Category();
            $name = explode('  ', trim($data[$i]['text']));
            $category->setName(trim($name[0]));
            $category->setNameEn(trim($name[1]));
            $category->setCode($data[$i]['id']);
            $category->setParentId($data[$i]['parentId']);
            if ($data[$i]['parentId'] != '' && $data[$i]['parentId'] != 0) {
                $parent = $this->categoryRepository->findByCode($data[$i]['parentId'])->getFirst();

                // dump($parent);
                $category->setParent($parent);
            }

            // $category->setClose(1); //默认0
            // dump($category);exit;
            $this->categoryRepository->add($category);
            $this->persistenceManager->persistAll();
        }
        return $category;
    }

    /**
     * action show
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Category $category
     * @return void
     */
    public function showAction(\ERP\ErpManagementDict\Domain\Model\Category $category)
    {
        $this->view->assign('category', $category);
        $trees = $this->categoryRepository->getChildren($category->getUid());

        // for ($i=0; $i < count($trees); $i++) {
        //     $trees
        // }
        dump($trees);
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
     * @param \ERP\ErpManagementDict\Domain\Model\Category $newCategory
     * @return void
     */
    public function createAction(\ERP\ErpManagementDict\Domain\Model\Category $newCategory)
    {
        $this->addFlashMessage('The object was created. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->categoryRepository->add($newCategory);
        $this->redirect('list');
    }

    /**
     * action edit
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Category $category
     * @ignorevalidation $category
     * @return void
     */
    public function editAction(\ERP\ErpManagementDict\Domain\Model\Category $category)
    {
        $this->view->assign('category', $category);
    }

    /**
     * action update
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Category $category
     * @return void
     */
    public function updateAction(\ERP\ErpManagementDict\Domain\Model\Category $category)
    {
        $this->addFlashMessage('The object was updated. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->categoryRepository->update($category);
        $this->redirect('list');
    }

    /**
     * action delete
     * 
     * @param \ERP\ErpManagementDict\Domain\Model\Category $category
     * @return void
     */
    public function deleteAction(\ERP\ErpManagementDict\Domain\Model\Category $category)
    {
        $this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See https://docs.typo3.org/typo3cms/extensions/extension_builder/User/Index.html', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::WARNING);
        $this->categoryRepository->remove($category);
        $this->redirect('list');
    }

    /**
     * action batch
     * 
     * @return void
     */
    public function batchAction()
    {
    }

    /**
     * action ajax
     * 
     * @return void
     */
    public function ajaxAction()
    {
        $cmd = GeneralUtility::_GP('cmd');
        if ($cmd == 'getCategory') {
            $categories = $this->categoryRepository->findCategory();
            JSON($categories);
        } elseif ($cmd == 'getColor') {
            $categories = $this->categoryRepository->findCategory();
            JSON($categories);
        } else {
            $pid = GeneralUtility::_GP('pid');
            $children = $this->categoryRepository->findCategory($pid);
            JSON($children);
        }
    }
    public function getCategoryAction()
    {
    }
    public function getCategory()
    {
        return $this->categoryRepository->findCategory();
    }

    /**
     * @param $id
     */
    public function getCategoryById($id)
    {
        return $this->categoryRepository->getCategoryById($id);
    }

    /**
     * @param $parentid
     */
    public function getChildren($parentid)
    {
        return $this->categoryRepository->getChildren($parentid);
    }
}
