<?php
Yii::import('zii.widgets.CMenu');
/**
 * 对 CMenu 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-6-11
 */
class BMenu extends CMenu
{
	/*
	 * 定义导航的样式，tab式
	 * @var unknown
	 */
	const TYPE_STYLE_TAB = 'tabs';
	/*
	 * 定义导航样式，胶囊式
	 * @var unknown
	 */
	const TYPE_STYLE_PILL = 'pills';
	/*
	 * 设置导航样式，默认胶囊式 
	 */
	public $typeStyle = self::TYPE_STYLE_PILL;
	/*
	 * 定义导航的排列方式 竖直排列
	 */
	const TYPE_SITE_STACK = 'stacked';
	/*
	 * 定义导航的排列方式 两端对齐填充排列
	 */
	const TYPE_SITE_JUSTIFY = 'justified';
	/*
	 * 设置导航排列方式，默认无设置
	 */
	public $typeSite;
	/**
	 * 初始化Menu，设置Bootstrap样式
	 * (non-PHPdoc)
	 * @see CMenu::init()
	 */
	public function init()
	{
		parent::init();
		$classes = array('nav');
		if (in_array($this->typeStyle, array(self::TYPE_STYLE_TAB,self::TYPE_STYLE_PILL))) 
		{
			$classes[] = 'nav-'.$this->typeStyle;
		}
		if (in_array($this->typeSite, array(self::TYPE_SITE_STACK,self::TYPE_SITE_JUSTIFY)))
		{
			$classes[] = 'nav-'.$this->typeSite;
		}
		BHtml::mergeClass($this->htmlOptions, $classes);
	}
	/**
	 * 重构，将带有下拉项的菜单使用bootstrap的dropdown替换
	 * (non-PHPdoc)
	 * @see CMenu::renderMenuRecursive()
	 */
	protected function renderMenuRecursive($items)
	{
		$count=0;
		$n=count($items);
		foreach($items as $item)
		{
			$count++;
			$options=isset($item['itemOptions']) ? $item['itemOptions'] : array();
			$class=array();
			if($item['active'] && $this->activeCssClass!='')
				$class[]=$this->activeCssClass;
			if($count===1 && $this->firstItemCssClass!==null)
				$class[]=$this->firstItemCssClass;
			if($count===$n && $this->lastItemCssClass!==null)
				$class[]=$this->lastItemCssClass;
			if($this->itemCssClass!==null)
				$class[]=$this->itemCssClass;
			if (isset($item['items'])) 
			{
				$class[] = 'dropdown';
			}
			BHtml::mergeClass($options, $class);

			echo CHtml::openTag('li', $options);
	
			$menu=$this->renderMenuItem($item);
			if(isset($this->itemTemplate) || isset($item['template']))
			{
				$template=isset($item['template']) ? $item['template'] : $this->itemTemplate;
				echo strtr($template,array('{menu}'=>$menu));
			}
			else
				echo $menu;
	
			if(isset($item['items']) && count($item['items']))
			{
				$subMenuOptions = isset($item['submenuOptions']) ? $item['submenuOptions'] : $this->submenuHtmlOptions;
				BHtml::mergeClass($subMenuOptions, array('dropdown-menu'));
				$subMenuOptions['role'] = 'menu';
				echo "\n".CHtml::openTag('ul',$subMenuOptions)."\n";
				$this->renderMenuRecursive($item['items']);
				echo CHtml::closeTag('ul')."\n";
			}
	
			echo CHtml::closeTag('li')."\n";
		}
	}
	/**
	 * 重构，将带有下拉项的菜单使用bootstrap的dropdown替换
	 * (non-PHPdoc)
	 * @see CMenu::renderMenuItem()
	 */
	protected function renderMenuItem($item)
	{
		if (!isset($item['linkOptions']))
		{
			$item['linkOptions'] = array();
		}
		if (isset($item['items']) && !empty($item['items'])) 
		{
			$item['url'] = 'javascript:;';
			$item['label'] .= '<span class="caret"></span>';
			BHtml::mergeClass($item['linkOptions'], array('dropdown-toggle'));
			$item['linkOptions']['data-toggle'] = 'dropdown';
		}
		
		if(isset($item['url']))
		{
			$label=$this->linkLabelWrapper===null ? $item['label'] : '<'.$this->linkLabelWrapper.'>'.$item['label'].'</'.$this->linkLabelWrapper.'>';
			return CHtml::link($label,$item['url'],$item['linkOptions']);
			
		}else{
			
			return CHtml::tag('span',$item['linkOptions'], $item['label']);
		}
	}
}