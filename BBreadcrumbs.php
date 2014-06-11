<?php
Yii::import('zii.widgets.CBreadcrumbs');
/**
 * 对 面包屑导航 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-6-11
 */
class BBreadcrumbs extends CBreadcrumbs
{
	/**
	 * 默认使用bootstrap的样式
	 * @var unknown
	 */
	public $htmlOptions=array('class'=>'breadcrumb');
	/**
	 * 移除分隔符，bootstrap3 的分隔符使用CSS写入的
	 * @var unknown
	 */
	public $separator='';
	public $tagName='ol';
	public $activeLinkTemplate='<li><a href="{url}">{label}</a></li>';
	public $inactiveLinkTemplate='<li class="active">{label}</li>';
	/**
	 * 重写以适应新的样式
	 * (non-PHPdoc)
	 * @see CBreadcrumbs::run()
	 */
	public function run()
	{
		if(empty($this->links))
			return;
	
		echo CHtml::openTag($this->tagName,$this->htmlOptions)."\n";
		$links=array();
		if($this->homeLink===null)
		{
			$this->homeLink = CHtml::link(Yii::t('zii','Home'),Yii::app()->homeUrl);
		}
		if ($this->homeLink!==false)
		{
			$links[] = 	'<li>'.$this->homeLink.'</li>';
		}
		foreach($this->links as $label=>$url)
		{
			if(is_string($label) || is_array($url))
				$links[]=strtr($this->activeLinkTemplate,array(
						'{url}'=>CHtml::normalizeUrl($url),
						'{label}'=>$this->encodeLabel ? CHtml::encode($label) : $label,
				));
			else
				$links[]=str_replace('{label}',$this->encodeLabel ? CHtml::encode($url) : $url,$this->inactiveLinkTemplate);
		}
		echo implode($this->separator,$links);
		echo CHtml::closeTag($this->tagName);
	}
}