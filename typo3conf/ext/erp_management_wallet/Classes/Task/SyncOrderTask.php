<?php
namespace ERP\ErpManagementOrder\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use ERP\ErpManagementOrder\Utility\OrderResource;
use ERP\ErpManagementOrder\Domain\Repository\OrderRepository;

class SyncOrderTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistenceManager;
	
	/**
	 * orderRepository
	 */
	protected $orderRepository;
	
	/**
	 * 存储位置
	 */
	protected $pid = 237;
	
	/**
	 * 同步时间
	 */
	protected $syncdate = 20190601;//19700101;
	
	/**
	 * 执行
	 */
    public function execute() 
	{
		//Extension Konfiguration auslesen.
		$objectManager = GeneralUtility::makeInstance(ObjectManager::class);
		$this->persistenceManager = $objectManager->get(PersistenceManagerInterface::class);
		$this->orderRepository = $objectManager->get(DepartmentRepository::class);

		return $this->doPull();
    }
	
	/**
	 * 数据同步
	 *
	 * @return boolean
	 */
	protected function doPull()
	{
		$params = array(
            'pageNo' 	=> 1,
			'pageSize'	=> 100,
			'accountId'	=> '11cac887243b45f1aee986ac7e04c171',
        );
        
	    $orders = OrderResource::getOrder($params);
		if($orders['errCode'] == '000' && !empty($d['data']))
	    $this->writelog("=========================================over=========================");
		return true;
	}
	
	/**
	 * 获取远程数据
	 *
	 * @return fixed
	 */
	protected function getOrderData()
	{
		$maxid = '';
		$sync = $this->syncRepository->findByFunAndDate($zyhFun, $this->syncdate);
		if($sync){
			$maxid = $sync->getMaxid();
		}
		//2019-10-23  rows参数缺少 我已经添加
		$d = OrderResource::getData($zyhFun, ['time' => $this->syncdate, 'maxid' => $maxid,'rows'=>80]);
		if($d['errCode'] == '000' && !empty($d['data']))
		{
			if($sync){
				$sync->setMaxid($d['maxid']);
				$this->syncRepository->update($sync);
				$this->persistenceManager->persistAll();
			}else{
				$sync = new \TaoJiang\MfwcZyh\Domain\Model\Sync;
				$sync->setFun($zyhFun);
				$sync->setSyncDate($this->syncdate);
				$sync->setMaxid($d['maxid']);
				$sync->setPid($this->pid);
				
				$this->syncRepository->add($sync);
				$this->persistenceManager->persistAll();
			}
			return $d['data'];
		}
		return false;
	}
	
	/**
	 * 写日志
	 *
	 * @param [type] $content
	 * @return void
	 * @author wanghongbin
	 * tstamp: 2020-06-08
	 */
	protected function writelog($content){
	    /** @var $logger \TYPO3\CMS\Core\Log\Logger */
	    $logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
	    $logger->warning("[".date("Y-m-d H:i:s")."]_订单数据定时同步:".$content);
	}
}