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

	所有的扩展类都以大写字母B开头，新增了一些方法和属性（但是原有的方法和属性都没有变化）。具体查看每个文件来了解新增的方法和属性。
	例如：
	BGridView 增加的控制表格样式的属性：tableType，在该属性的上面有四个静态属性，用于指定表格样式，等等。
	
##关于CSS和JS的自动引入

-------
虽然扩展会支持，自动加载所需的CSS和JS。  
例如：当使用 `BActiveForm` 来创建表单的时候，会自动载入所需的Bootstrap3的JS和CSS。  
但是，如果你的应用全部使用bootstrap风格，而且有很多的组件混用。我们强烈建议您关闭自动引入。  
而是在 模板/主题 的主布局文件的头部，直接引入这些JS和CSS，从而确保每个页面都有而且不会重复引用。

##BActiveForm新增的方法和属性
--------
未完待续