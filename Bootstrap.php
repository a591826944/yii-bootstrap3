<?php 
class Bootstrap
{
	/**
	 * 加载bootstrap的核心CSS文件
	 */
	public static function registerCoreCss()
	{
		$cssFile = dirname(__FILE__).'/css/bootstrap'.(YII_DEBUG ? '' : '.min').'.css';
		$cssFile = Yii::app()->getAssetManager()->publish($cssFile);
		//加载图标字体
		foreach (array('eot','svg','ttf','woff') as $ext)
		{
			Yii::app()->getAssetManager()->publish(dirname(__FILE__).'/css/glyphicons-halflings-regular.'.$ext);
		}
		Yii::app()->clientScript->registerCssFile($cssFile);
	}
	/**
	 * 加载bootstrap的主题Css文件
	 */
	public static function registerThemeCss()
	{
		$themeFile = dirname(__FILE__).'/css/bootstrap-theme'.(YII_DEBUG ? '' : '.min').'.css';
		$themeFile = Yii::app()->getAssetManager()->publish($themeFile);
		Yii::app()->clientScript->registerCssFile($themeFile);
	}
	/**
	 * 已入所有的Css文件，包括核心文件和主题文件
	 */
	public static function registerAllCss()
	{
		self::registerCoreCss();
		self::registerThemeCss();
	}
	/**
	 * 注册YII自带的jquery
	 */
	public static function registerYiiJquery()
	{
		Yii::app()->getClientScript()->registerCoreScript('jquery');
	}
	/**
	 * 注册bootstrap的核心JS文件
	 * @param string $jquery
	 */
	public static function registerCoreJs($position = CClientScript::POS_HEAD)
	{
		$jsFile = dirname(__FILE__).'/js/bootstrap'.(YII_DEBUG ? '' : '.min').'.js';
		$jsFile = Yii::app()->getAssetManager()->publish($jsFile);
		Yii::app()->clientScript->registerCssFile($jsFile,$position);
	}
	/**
	 * 注册所有的JS文件
	 * @param unknown $position
	 */
	public static function registerAllJs($position = CClientScript::POS_HEAD)
	{
		self::registerYiiJquery();
		self::registerCoreJs($position);
	} 
	/**
	 * 注册所有的JS和CSS，如果使用默认配置的话，直接用着一个方法引入就可以了
	 */
	public static function register()
	{
		self::registerAllCss();
		self::registerAllJs();
	}
	/**
	 * 返回当前使用的 Bootstrap 的版本号
	 * @return string
	 */
	public static function getVersion()
	{
		return 'Bootstrap v3.0.2';
	}
}