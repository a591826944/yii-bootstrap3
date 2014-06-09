yii-bootstrap3
==============

Bootstrap3 for the Yii PHP framework.

----
github 上现在也有其他的yii的bootstrap的扩展。但是基本都是基于Bootstrap2的。其次，写的使用方法上比较复杂，有一定的学习成本。也就是说在原本YII的HTML组件的基础上改变了很多使用方法，学习成本上升。  

本插件除了基于Bootstrap之外，最多的改变就是尽量保持不增加新的语法，与之前YII的语法保持一致，几乎0成本。

##已经完成的部分

-------
1.`BActiveForm` > `CActiveForm`  

2.`BGridView` > `CGridView`

3.`BHtml` > `CHtml` (部分)  

4.`BLinkPager` > `CLinkPager`

5.`Bootstrap` (用于引入JS和CSS)

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
未完待续