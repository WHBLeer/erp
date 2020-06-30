<?php
namespace ERP\ErpManagementNotify\ViewHelpers;
class PagenateViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{
	
	/**
     * Arguments initialization
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
		$this->registerArgument('page', 'int', '当前页面');
		$this->registerArgument('total', 'int', '数据总量');
		$this->registerArgument('arguments', 'array', '参数');
		$this->registerArgument('action', 'string', 'action');
		$this->registerArgument('controller', 'string', 'controller');
		$this->registerArgument('extensionName', 'string', 'extensionName');
		$this->registerArgument('pluginName', 'string', 'pluginName');
    }
	
	/**
	 * 分页器
	 * 
	 * @return string 
	 */
	public function render() 
	{
		$pageitem = 25;
		$page = $this->arguments['page'];
		$total = $this->arguments['total'];
		$arguments = $this->arguments['arguments'];
		$action = $this->arguments['action'];
		$controller = $this->arguments['controller'];
		$extensionName = $this->arguments['extensionName'];
		$pluginName = $this->arguments['pluginName'];
		
		$totalpage = ceil($total / $pageitem);
		$start = max($page - 3, 1);
		$end = min($totalpage, $page + 3 + 1);
	
		if($totalpage < 2){
			return;
		}
		
		$html = '<div class="page">';
		// $html .= '<a href="javascript:void(0);">第 '.$page.' 页， 共 '.$totalpage.' 页</a>';
		$html .= '<a href="javascript:void(0);" class="a-ye">第 '.$page.' 页</a>';
		
		for($i=$start; $i<=$end; $i++){
			$class = ($i == $page) ? 'page-active' : '';
			$arguments['page'] = $i;
			$html .= '<a class="'.$class.'" href="'.$this->pagenate($action, $arguments, $controller, $extensionName, $pluginName).'">'.$i.'</a>';
		}
		
		
		if($page < $totalpage) {
			$arguments['page'] = $page + 1;
			$html .= '
				<a href="'.$this->pagenate($action, $arguments, $controller, $extensionName, $pluginName).'" class="a-ye">下一页</a>
			</div>';
		}
		
		return $html;
	}
	
	/**
	 * 链接构成
	 * 
	 * @param string $action
	 * @param array $arguments
	 * @param string $controller
	 * @param string $extensionName
	 * @param string $pluginName
	 *
	 * @return string
	 */
	 
	protected function pagenate($action, $arguments, $controller, $extensionName, $pluginName)
	{
		$uriBuilder = $this->controllerContext->getUriBuilder();
        $url = $uriBuilder
            ->reset()
            ->uriFor($action, $arguments, $controller, $extensionName, $pluginName);
		return $url;
	}
}

?>