<?php
namespace TaoJiang\MfwcZyh\Task;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Object\ObjectManager;
use TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface;
use TaoJiang\MfwcZyh\Utility\ZyhResource;
use TaoJiang\MfwcZyh\Domain\Repository\DepartmentRepository;
use TaoJiang\MfwcZyh\Domain\Repository\DurationRepository;
use TaoJiang\MfwcZyh\Domain\Repository\HisdurationRepository;
use TaoJiang\MfwcZyh\Domain\Repository\VolunteerRepository;
use TaoJiang\MfwcZyh\Domain\Repository\SyncRepository;

class SyncTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

	/**
     * @var \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface
     * @inject
     */
    protected $persistenceManager;
	
	/**
	 * departmentRepository
	 */
	protected $departmentRepository;
	
	/**
	 * durationRepository
	 */
	protected $durationRepository;
	
	/**
	 * hisdurationRepository
	 */
	protected $hisdurationRepository;
	
	/**
	 * volunteerRepository
	 */
	protected $volunteerRepository;
	
	/**
	 * syncRepository
	 */
	protected $syncRepository;
	
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
		$this->departmentRepository = $objectManager->get(DepartmentRepository::class);
		$this->durationRepository = $objectManager->get(DurationRepository::class);
		$this->hisdurationRepository = $objectManager->get(HisdurationRepository::class);
		$this->volunteerRepository = $objectManager->get(VolunteerRepository::class);
		$this->syncRepository = $objectManager->get(SyncRepository::class);
	       
		return $this->doSync();
    }
	
	/**
	 * 数据同步
	 *
	 * @return boolean
	 */
	protected function doSync()
	{
		//if(time() > strtotime('20190802')) $this->syncdate = date('Ymd');
	    if(time() > strtotime('20191114235959')) $this->syncdate = date('Ymd');
	    
	    //这种写法太消耗资源，而且接口调用频繁，数据同步频率太高  2019-11-14
// 		if($this->departmentSync()) return true;
// 		if($this->volunteerSync()) return true;
// 		if($this->durationSync()) return true;
// 		$this->hisdurationSync();
        
	    //修改为每天定时同步一次，一次将所有的数据都同步过来同步时间每天23:30分
 	    while(true){
	        if($this->departmentSync()){
	            usleep(500000);//延时500毫秒
	            continue;
	        }else if($this->volunteerSync()){
	            usleep(500000);//延时500毫秒
	            continue;
	        }else if($this->durationSync()){
	            usleep(500000);//延时500毫秒
	            continue;
	        }else if($this->hisdurationSync()){
	            usleep(500000);//延时500毫秒
	            continue;
	        }else{
	            break;
	        }
	    }
	    $this->writelog("=========================================over=========================");
		return true;
	}
	
	/**
	 * 获取远程数据
	 *
	 * @param string $zyhFun
	 * @return fixed
	 */
	protected function getZyhData($zyhFun)
	{
		$maxid = '';
		$sync = $this->syncRepository->findByFunAndDate($zyhFun, $this->syncdate);
		if($sync){
			$maxid = $sync->getMaxid();
		}
		//2019-10-23  rows参数缺少 我已经添加
		$d = ZyhResource::getData($zyhFun, ['time' => $this->syncdate, 'maxid' => $maxid,'rows'=>80]);
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
	 * 部门数据同步
	 *
	 * @return boolean
	 */
	protected function departmentSync()
	{
		$data = $this->getZyhData('department');
		if(!empty($data))
		{
			foreach($data as $d){
				$department = $this->departmentRepository->findByCode($d['code'])->getFirst();
				if(!$department){
				    $department = new \TaoJiang\MfwcZyh\Domain\Model\Department;
    				$department->setName($d['name']);
    				$department->setCode($d['code']);
    				$department->setParentCode($d['parentCode']);
    				$department->setPid($this->pid);
    				
    				if(!empty($d['admin'])){
    					foreach($d['admin'] as $da){
    						$departmentAdmin = new \TaoJiang\MfwcZyh\Domain\Model\DepartmentAdmin;
    						$departmentAdmin->setName($da['name']);
    						$departmentAdmin->setIdcard($da['idcard']);
    						$departmentAdmin->setMphone($da['mphone']);
    						$departmentAdmin->setPid($this->pid);
    						$department->addAdmin($departmentAdmin);
    					}
    				}
    				$this->departmentRepository->add($department);
    				$this->persistenceManager->persistAll();
				}
			}
			return true;
		}
		return false;
	}
	
	/**
	 * 志愿者数据同步
	 *
	 * @return boolean
	 */
	protected function volunteerSync()
	{
		$data = $this->getZyhData('volunteer');
		if(!empty($data))
		{
		    //$this->writelog("volunteer=".json_encode($data,JSON_UNESCAPED_UNICODE));
			foreach($data as $d){
				$volunteer = $this->volunteerRepository->findByIdcard($d['idcard'])->getFirst();
				if(!$volunteer){
				    $volunteer = new \TaoJiang\MfwcZyh\Domain\Model\Volunteer;
    				$volunteer->setVcode($d['vcode']);
    				$volunteer->setName($d['name']);
    				$volunteer->setIdcardtype($d['idcardtype']);
    				$volunteer->setIdcard($d['idcard']);
    				$volunteer->setMphone($d['mphone']);
    				$volunteer->setEmail($d['email']);
    				$volunteer->setEducation($d['education']);
    				$volunteer->setJob($d['job']);
    				$volunteer->setPolitical($d['political']);
    				$volunteer->setAddress($d['address']);
    				$volunteer->setPid($this->pid);
    				$this->volunteerRepository->add($volunteer);
    				$this->persistenceManager->persistAll();
				}
			}
			return true;
		}
		return false;
	}
	
	/**
	 * 签到信息数据同步
	 *
	 * @return boolean
	 */
	protected function durationSync()
	{
	    $data = $this->getZyhData('duration');
		if(!empty($data))
		{
		    //$this->writelog("duration=".json_encode($data,JSON_UNESCAPED_UNICODE));
			foreach($data as $d){
				//$duration = $this->durationRepository->findByIdcardAndActivity($d['idcard'], $d['activity'])->getFirst();
				//if(!$duration) 
			    $duration = new \TaoJiang\MfwcZyh\Domain\Model\Duration;
				
				$duration->setName($d['name']);
				$duration->setIdcard($d['idcard']);
				$duration->setActivity($d['activity']);
				$duration->setAddress($d['address']);
				$duration->setValue($d['value']);
				$duration->setSignInTime(new \DateTime($d['signInTime']));
				$duration->setSignOutTime(new \DateTime($d['signOutTime']));
				$duration->setPid($this->pid);
				$this->durationRepository->add($duration);
				$this->persistenceManager->persistAll();
			}
			return true;
		}
		return false;
	}
	
	/**
	 * 荣誉时数数据同步
	 *
	 * @return boolean
	 */
	protected function hisdurationSync()
	{
	    $data = $this->getZyhData('hisduration');
		if(!empty($data))
		{
		    //$this->writelog("hisduration=".json_encode($data,JSON_UNESCAPED_UNICODE));
			foreach($data as $d){
			    
			    //$hisduration = $this->hisdurationRepository->findByIdcardAndActivity($d['idcard'], $d['activity'])->getFirst();
				//if(!$hisduration) 
				$hisduration = new \TaoJiang\MfwcZyh\Domain\Model\Hisduration;
				
				$hisduration->setName($d['name']);
				$hisduration->setIdcard($d['idcard']);
				$hisduration->setActivity($d['activity']);
				$hisduration->setAddress($d['address']);
				$hisduration->setValue($d['value']);
				$hisduration->setSignInTime(new \DateTime($d['signInTime']));
				$hisduration->setPid($this->pid);
				$this->hisdurationRepository->add($hisduration);
				$this->persistenceManager->persistAll();
			}
			return true;
		}
		return false;
	}
	
	protected function writelog($content){
	    /** @var $logger \TYPO3\CMS\Core\Log\Logger */
	    $logger = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Core\Log\LogManager')->getLogger(__CLASS__);
	    $logger->warning("[".date("Y-m-d H:i:s")."]_志愿汇数据定时同步:".$content);
	}
}