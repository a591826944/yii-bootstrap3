<?php
Yii::import('zii.widgets.CListView');
/**
 * 对 DetailView 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-6-11
 */
class BListView extends CListView
{
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
	 * 关闭YII的默认样式
	 * @var unknown
	 */
	public $cssFile = false;
}