<?php
namespace TaoJiang\MfwcZyh\ViewHelpers;
class NameViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper 
{
	
	/**
     * Arguments initialization
     */
    public function initializeArguments()
    {
        parent::initializeArguments();
		$this->registerArgument('name', 'string', '姓名');
    }
	
	/**
	 * 分页器
	 * 
	 * @return string 
	 */
	public function render() 
	{
		$name = $this->arguments['name'];
		$rpkey = mb_substr($name , 1 , 1, 'utf-8');
		return str_replace($rpkey, '*', $name);
	}
}

?>