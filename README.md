yii-bootstrap3
==============

Bootstrap3 for the Yii PHP framework.  

***YII Version 1.1.12***

----
github 上现在也有其他的yii的bootstrap的扩展。但是基本都是基于Bootstrap2的。其次，写的使用方法上比较复杂，有一定的学习成本。也就是说在原本YII的HTML组件的基础上改变了很多使用方法，学习成本上升。  

本插件除了基于Bootstrap3之外，最多的改变就是尽量保持不增加新的语法，与之前YII的语法保持一致，几乎0成本。

##已经完成的部分

-------
1.`BActiveForm` > `CActiveForm`  

2.`BGridView` > `CGridView`

3.`BHtml` > `CHtml` (部分)  

4.`BLinkPager` > `CLinkPager`

5.`Bootstrap` (用于引入JS和CSS)  

6.`BButtonColumn` > `CButtonColumn`  

7.`BMenu` > `CMenu`

	所有的扩展类都以大写字母B开头，新增了一些方法和属性（但是原有的方法和属性都没有变化）。具体查看每个文件来了解新增的方法和属性。
	例如：
	BGridView 增加的控制表格样式的属性：tableType，在该属性的上面有四个静态属性，用于指定表格样式，等等。

##如何使用这些类
---------
根据YII的自动加载机制，你可以在你的main配置文件中配置。`import` 属性。像这样：  

```
'import'=>array(
			'application.components.bootstrap.*',
		)
```
当然，这是我使用时候的路径，你需要把前面的路径别名换成你自己环境中的路径。
	
##关于CSS和JS的引入

-------
  
我们已经考虑好了关于引入JS和CSS的问题，如果你使用默认配置，你可以直接在 模板/主题 的主布局文件的头部加上这句引入代码就完成了。  
`<?php Bootstrap::register();?>`  
这会引入所用的的Bootrap的JS和CSS，同时也会引入YII自带的核心JS中的jquery类库。  
如果你不想这样全部引入，或者你有自己的关于类库的打算，那么请具体查看 `Bootstrap` 这个类中，因为这里对于每个JS和CSS引入都有单独的封装，你可以分别引入你所需要的。非常灵活。

##BActiveForm新增的方法和属性
--------
1. 对所有的`input`输入框的元素（text/email/password等）新增带有Group后缀的方法，例如 `textFieldGroup`,会生成 带icon的`input`输入框  


##BGridView新增的方法和属性
-----------------------
1.增加public属性 `tableType` 改属性的值是指定的静态属性之一，分别对应Bootstrap中的四中表格样式。  

```
	/**
	 * 条纹表格
	 */
	const TABLE_TYPE_STRIPED = 'striped';
	/**
	 * 带边框表格
	 */
	const TABLE_TYPE_BORDERED = 'bordered';
	/**
	 * 鼠标悬停 表格
	 */
	const TABLE_TYPE_HOVER = 'hover';
	/**
	 * 紧缩表格
	 */
	const TABLE_TYPE_CONDENSED = 'condensed';
```  
2.Grid的翻页默认使用`BLinkPager`替换掉YII的`CLinkPager`.  

##BHtml新增的方法和属性
-----------------
1.新增静态方法`mergeClass` 用于组件内部合并用户添加的CSS Class 和 Bootstrap样式的CSS Class  

##BLinkPager新增的方法和属性
-------------
1.新增`type`属性，属性值由以下两个常量属性指定，用于确定翻页的尺寸样式。  

```
	/**
	 * 翻页的大小尺寸样式 
	 */
	const PAGE_LARGE = 'lg';
	const PAGE_SMALL = 'sm';
```  
2.新增`site`属性，属性值有以下两个常量确定，用于确定翻页的位置。  

```
	/**
	 * 翻页的位置 默认右边
	 */
	const PAGE_LEFT="left";
	const PAGE_RIGHT='right';
```  
3.新增`displayFirstAndLast`属性，bool，用于确定是否显示首页和尾页的翻页按钮。  

##BButtonColumn新增的方法和属性
-----
1.`renderButton` 方法重写，让Button可以支持Bootstrap3的 Glyphicons 图标。  
使用举例：  
view查看按钮，属性`viewButtonImageUrl` 的默认值是 `glyphicon-eye-open` 也就是 glyphicon 图标中的眼睛图标。是的，我们只要给对应按钮的 `{$id}ButtonImageUrl`属性赋值一个可用的 glyphicon 图标的Class就可以使用该图标了。当然也可以像以前YII的使用方法一样，指定一个图片的URL，来作为按钮的图标。判断的标准是：如果属性的值中含有 `glyphicon-` 这个前缀，就是用 glyphicon 图标，否则使用哪个YII的默认的图片地址方式。  
##BMenu新增的方法和属性
-----
1.新增`typeStyle`属性，属性值由以下两个常量指定，用于确定导航的样式。  默认值：`TYPE_STYLE_PILL`

```
	/*
	 * 定义导航的样式，tab式
	 */
	const TYPE_STYLE_TAB = 'tabs';
	/*
	 * 定义导航样式，胶囊式
	 */
	const TYPE_STYLE_PILL = 'pills';
```
2.新增`typeSite`属性，属性由以下两个常量指定，用于确定导航的排列方式。  默认值：`NULL`

```
	/*
	 * 定义导航的排列方式 竖直排列
	 */
	const TYPE_SITE_STACK = 'stacked';
	/*
	 * 定义导航的排列方式 两端对齐填充排列
	 */
	const TYPE_SITE_JUSTIFY = 'justified';
```
3.调用示例：   

```
    $this->widget('BMenu',array(
		'items'=>array(
			array('label'=>'Home', 'url'=>array('javascript:;')),
			array('label'=>'Help', 'url'=>array('javascript:;')),
			array('label'=>'DropDown', 'url'=> array('javascript:;'),'items'=>array(
				array('label'=>'link1','url'=>array('javascript:;')),
				array('label'=>'','itemOptions'=>array('class'=>'divider')),
				array('label'=>'link2','url'=>array('javascript:;')),
			)),
		),
    	'typeStyle'=>BMenu::TYPE_STYLE_PILL,
    	//'typeSite'=>BMenu::TYPE_SITE_STACK
	));
```