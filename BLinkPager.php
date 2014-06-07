<?php
/**
 * 对 翻页 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-4-3
 */
class BLinkPager extends CLinkPager
{
	/**
	 * 使用bootstrap3设置禁用和选中样式
	 * @var unknown
	 */
	const CSS_HIDDEN_PAGE='disabled';
	const CSS_SELECTED_PAGE='active';
	public $hiddenPageCssClass=self::CSS_HIDDEN_PAGE;
	public $selectedPageCssClass=self::CSS_SELECTED_PAGE;
	/**
	 * 翻页的大小尺寸样式 
	 */
	const PAGE_LARGE = 'lg';
	const PAGE_SMALL = 'sm';
	/**
	 * type = 'lg' or type = 'sm'
	 * @var unknown
	 */
	public $type;
	/**
	 * 翻页的位置 默认右边
	 */
	const PAGE_LEFT="left";
	const PAGE_RIGHT='right';
	public $site = self::PAGE_RIGHT;
	/**
	 * 移除原分页的css样式
	 * @var unknown
	 */
	public $cssFile = false;
	/**
	 * 设置默认label
	 * @var unknown
	 */
	public $nextPageLabel = '&raquo;';
	public $prevPageLabel = '&laquo;';
	public $firstPageLabel= '|&laquo;';
	public $lastPageLabel = '&raquo;|';
	/**
	 * 移除header
	 * @var unknown
	 */
	public $header = false;
	/**
	 * 是否显示首页和尾页按钮，默认不显示
	 * @var unknown
	 */
	public $displayFirstAndLast = false;
	/**
	 * 初始化分页的Bootstrap 样式
	 * (non-PHPdoc)
	 * @see CLinkPager::init()
	 */
	public function init()
	{
		BHtml::mergeClass($this->htmlOptions, array('pagination'));
		$pageType = array(self::PAGE_LARGE,self::PAGE_SMALL);
		if (in_array($this->type, $pageType)) 
		{
			BHtml::mergeClass($this->htmlOptions, array('pagination-'.$this->type));
		}
		$pageSite = array(self::PAGE_LEFT,self::PAGE_RIGHT);
		if (in_array($this->site, $pageSite)) 
		{
			BHtml::mergeClass($this->htmlOptions, array('pull-'.$this->site));
		}
		parent::init();
	}
	/**
	 * 改写生成的翻页，增加控制是否显示 首页和尾页的开关
	 * (non-PHPdoc)
	 * @see CLinkPager::createPageButtons()
	 */
	protected function createPageButtons()
	{
		if(($pageCount=$this->getPageCount())<=1)
			return array();
	
		list($beginPage,$endPage)=$this->getPageRange();
		$currentPage=$this->getCurrentPage(false); // currentPage is calculated in getPageRange()
		$buttons=array();
	
		// first page
		if ($this->displayFirstAndLast) 
		{
			$buttons[]=$this->createPageButton($this->firstPageLabel,0,$this->firstPageCssClass,$currentPage<=0,false);
		}
	
		// prev page
		if(($page=$currentPage-1)<0)
			$page=0;
		$buttons[]=$this->createPageButton($this->prevPageLabel,$page,$this->previousPageCssClass,$currentPage<=0,false);
	
		// internal pages
		for($i=$beginPage;$i<=$endPage;++$i)
			$buttons[]=$this->createPageButton($i+1,$i,$this->internalPageCssClass,false,$i==$currentPage);
	
		// next page
		if(($page=$currentPage+1)>=$pageCount-1)
			$page=$pageCount-1;
		$buttons[]=$this->createPageButton($this->nextPageLabel,$page,$this->nextPageCssClass,$currentPage>=$pageCount-1,false);
	
		// last page
		if ($this->displayFirstAndLast) 
		{
			$buttons[]=$this->createPageButton($this->lastPageLabel,$pageCount-1,$this->lastPageCssClass,$currentPage>=$pageCount-1,false);
		}
	
		return $buttons;
	}
	/**
	 * 移除被选中分页的点击功能
	 * (non-PHPdoc)
	 * @see CLinkPager::createPageButton()
	 */
	protected function createPageButton($label,$page,$class,$hidden,$selected)
	{
		if($hidden || $selected)
			$class.=' '.($hidden ? $this->hiddenPageCssClass : $this->selectedPageCssClass);
		if ($selected) 
		{
			return '<li class="'.$class.'"><span>'.$label.' <span class="sr-only">(current)</span></span>'.'</li>';
		}
		return '<li class="'.$class.'">'.CHtml::link($label,$this->createPageUrl($page)).'</li>';
	}
}