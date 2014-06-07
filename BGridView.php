<?php
Yii::import('zii.widgets.grid.CGridView');
/**
 * 对 grid view 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-4-3
 */
class BGridView extends CGridView
{
	/**
	 * 条纹表格
	 * @var unknown
	 */
	const TABLE_TYPE_STRIPED = 'striped';
	/**
	 * 带边框表格
	 * @var unknown
	 */
	const TABLE_TYPE_BORDERED = 'bordered';
	/**
	 * 鼠标悬停 表格
	 * @var unknown
	 */
	const TABLE_TYPE_HOVER = 'hover';
	/**
	 * 紧缩表格
	 * @var unknown
	 */
	const TABLE_TYPE_CONDENSED = 'condensed';
	public $tableType;
	/**
	 * 关闭对于YII 原始css样式的引用
	 * @var unknown
	 */
	public $cssFile = false;
	/**
	 * 使用bootstrap 的分页样式class
	 * @var unknown
	 */
	public $pagerCssClass = 'pagination-box clearfix';
	/**
	 * 指定使用bootstrap样式的翻页
	 */
	public $pager = array('class'=>'BLinkPager');
	/**
	 * items 使用Bootstrap样式
	 * @var unknown
	 */
	public $itemsCssClass = 'table';
	/**
	 * 初始化样式数据
	 * (non-PHPdoc)
	 * @see CGridView::init()
	 */
	public function init()
	{
		parent::init();
		if (!isset($this->pager['class']))
		{
			$this->pager['class'] = 'BLinkPager';
		}
		BHtml::mergeClass($this->htmlOptions, array('table-responsive'));
		$tableTypeArray = array(self::TABLE_TYPE_BORDERED,self::TABLE_TYPE_CONDENSED,self::TABLE_TYPE_HOVER,self::TABLE_TYPE_STRIPED);
		if (in_array($this->tableType, $tableTypeArray))
		{
			$this->itemsCssClass .= ' table-'.$this->tableType;
		}
	}
}