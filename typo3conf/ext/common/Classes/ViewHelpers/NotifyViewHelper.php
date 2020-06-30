<?php
namespace Sll\Common\ViewHelpers;

use TYPO3\CMS\Core\Utility\GeneralUtility;
/**
 * 通知展示
 *
 * @author wanghongbin
 * tstamp: 2020-06-08
 */
class NotifyViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{
	/**
     * receiveRepository
     * 
     * @var \ERP\ErpManagementNotify\Domain\Repository\ReceiveRepository
     * @inject
     */
	protected $receiveRepository = null;
	
	/**
     * Arguments initialization
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
		$this->registerArgument('receiver', 'int', '当前登录用户');
    }
	
	/**
	 * 下拉通知
	 * 
	 * @return string 
	 */
	public function render() 
	{
		$receiver = $this->arguments['receiver'];
		$messages = $this->receiveRepository->findByUser($receiver,0);
		$count = $messages->count();

		$html ="<li class=\"dropdown notification-list list-inline-item\">";
		$html .="	<a class=\"nav-link dropdown-toggle arrow-none waves-effect\" data-toggle=\"dropdown\" href=\"#\" role=\"button\" aria-haspopup=\"false\" aria-expanded=\"false\">";
		$html .="		<i class=\"mdi mdi-bell-outline noti-icon\"></i>";
		$html .="		<span class=\"badge badge-pill badge-danger noti-icon-badge\">$count</span>";
		$html .="	</a>";
		$html .="	<div class=\"dropdown-menu dropdown-menu-right dropdown-menu-lg\">";
		$html .="		<div class=\"slimscroll notification-item-list\" style=\"height: 100%;\">";
		if ($messages->count()>0) {
			$i = 5;
			foreach ($messages as $message) {
				if ($i===0) break; //仅显示前5条数据
				$title = $message->getTitle();
				$detail = $message->getBodyText();
				//公告
				if ($message->getMsgType()==1) {
					$bg ="bg-success"; $icon ="fas fa-bullhorn";
				}
				//提醒
				if ($message->getMsgType()==2) {
					$html .="<div class=\"notify-icon bg-success\"><i class=\"mdi mdi-bell-ring\"></i></div>";
					$bg ="bg-warning"; $icon ="mdi mdi-bell-ring";
				}
				//站内信
				if ($message->getMsgType()==3) {
					$bg ="bg-primary"; $icon ="ti-comments";
				}

				$html .="<a href=\"javascript:void(0);\" class=\"dropdown-item notify-item\">";
				$html .="	<div class=\"notify-icon $bg\"><i class=\"$icon\"></i></div>";
				$html .="	<p class=\"notify-details\">$title<span class=\"text-muted\">$detail</span></p>";
				$html .="</a>";
				$i--;
			}
		} else {
			$html .="<a href=\"javascript:void(0);\" class=\"dropdown-item notify-item\">";
			$html .="	<div class=\"notify-icon bg-info\"><i class=\"mdi mdi-information-variant\"></i></div>";
			$html .="	<p class=\"notify-details\"><span class=\"text-muted\">当前没有未读提醒。您可以到消息管理中心查看所有提醒</span></p>";
			$html .="</a>";
		}
		
		$html .="		</div>";
		$html .="		<a href=\"/erp/helper/notice\" target=\"_blank\" class=\"dropdown-item text-center text-primary\">";
		$html .="				显示全部 <i class=\"fi-arrow-right\"></i>";
		$html .="			</a>";
		$html .="	</div>";
		$html .="</li>";
		return $html;
	}
}

?>