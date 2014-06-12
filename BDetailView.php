<?php
Yii::import('zii.widgets.CDetailView');
/**
 * 对 DetailView 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-6-11
 */
class BDetailView extends CDetailView
{
	/**
	 * 关闭YII默认的样式
	 * @var unknown
	 */
	public $cssFile = false;
	/**
	 * 设置bootstrap默认的表格class
	 * @var unknown
	 */
	public $htmlOptions=array('class'=>'table');
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
	/**
	 * 设置表格样式,默认条纹样式
	 * @var unknown
	 */
	public $tableType = self::TABLE_TYPE_STRIPED;
	/**
	 * 初始化应用样式
	 * (non-PHPdoc)
	 * @see CDetailView::init()
	 */
	public function init()
	{
		if (!empty($this->tableType) && in_array($this->tableType, array(self::TABLE_TYPE_BORDERED,self::TABLE_TYPE_CONDENSED,self::TABLE_TYPE_HOVER,self::TABLE_TYPE_STRIPED))) 
		{
			BHtml::mergeClass($this->htmlOptions, array('table-'.$this->tableType));
		}
		parent::init();
	}
}