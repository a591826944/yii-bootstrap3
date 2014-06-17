<?php 

/**
 * 重写 CHtml 类 使表单元素应用 bootstrap3样式
 * 
 * @author wwpeng < 591826944@qq.com >
 * @version 2013-11-14
 */
class BHtml extends CHtml 
{
	/**
	 * 定义bootstrap中的按钮样式
	 * @var unknown
	 */
	const BUTTON_DEFAULT = 'default';
	const BUTTON_PRIMARY = 'primary';
	const BUTTON_SUCCESS = 'success';
	const BUTTON_INFO = 'info';
	const BUTTON_WARNING = 'warning';
	const BUTTON_DANGER = 'danger';
	const BUTTON_LINK = 'link';
	
	/**
	 * 默认的errorSummary block样式
	 * @var string  the CSS class for displaying error summaries (see {@link errorSummary}).
	 */
	public static $errorSummaryCss='errorSummary alert alert-danger alert-dismissable';
	/**
	 * 合并用户输入的class(通过htmlOptions属性设置)和默认的bootstrap样式 class
	 * @param array $option Classes to modify
	 * @param array $add Classes to add
	 */
	public static function mergeClass(array &$option, array $add)
	{
		if (isset($option['class']) && (!empty($option['class'])))
		{
			$option['class'] .= ' '.implode(' ', $add);
			
		}else{
			
			$option['class'] = implode(' ', $add);
		}
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input text元素
	 * @param object $model
	 * @param array $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function activeTextField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeTextField($model, $attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input password元素
	 * @param object $model
	 * @param array $attribute
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function activePasswordField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activePasswordField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input url元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeUrlField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeUrlField($model, $attribute, $htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input email元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeEmailField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeEmailField($model, $attribute, $htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input number元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeNumberField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeNumberField($model, $attribute, $htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input range元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeRangeField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeRangeField($model, $attribute, $htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input data元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeDateField($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeDateField($model, $attribute, $htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的textArea元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeTextArea($model,$attribute,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeTextArea($model, $attribute, $htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的select元素
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeDropDownList($model,$attribute,$data,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('form-control'));
		return parent::activeDropDownList($model, $attribute, $data, $htmlOptions);
	}
	/**
	 * 覆盖父类activeRadioButtonList 方法 为了 调用 新的 radioButtonList 方法
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $data
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function activeRadioButtonList($model,$attribute,$data,$htmlOptions=array())
	{
		self::resolveNameID($model,$attribute,$htmlOptions);
		$selection=self::resolveValue($model,$attribute);
		if($model->hasErrors($attribute))
			self::addErrorCss($htmlOptions);
		$name=$htmlOptions['name'];
		unset($htmlOptions['name']);
		
		if(array_key_exists('uncheckValue',$htmlOptions))
		{
			$uncheck=$htmlOptions['uncheckValue'];
			unset($htmlOptions['uncheckValue']);
		}
		else
			$uncheck='';
		
		$hiddenOptions=isset($htmlOptions['id']) ? array('id'=>self::ID_PREFIX.$htmlOptions['id']) : array('id'=>false);
		$hidden=$uncheck!==null ? self::hiddenField($name,$uncheck,$hiddenOptions) : '';
		
		return $hidden . self::radioButtonList($name,$selection,$data,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染 radio group 
	 * @param unknown $name
	 * @param unknown $select
	 * @param unknown $data
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function radioButtonList($name,$select,$data,$htmlOptions=array())
	{
		$template=isset($htmlOptions['template'])?$htmlOptions['template']:'<label class="radio-inline">{input}{label}</label>';
		$separator=isset($htmlOptions['separator'])?$htmlOptions['separator']:"";
		$container=isset($htmlOptions['container'])?$htmlOptions['container']:'span';
		unset($htmlOptions['template'],$htmlOptions['separator'],$htmlOptions['container']);
	
		$labelOptions=isset($htmlOptions['labelOptions'])?$htmlOptions['labelOptions']:array();
		unset($htmlOptions['labelOptions']);
	
		$items=array();
		$baseID=self::getIdByName($name);
		$id=0;
		foreach($data as $value=>$label)
		{
			$checked=!strcmp($value,$select);
			$htmlOptions['value']=$value;
			$htmlOptions['id']=$baseID.'_'.$id++;
			$option=self::radioButton($name,$checked,$htmlOptions);
			$items[]=strtr($template,array('{input}'=>$option,'{label}'=>$label));
		}
		if(empty($container))
			return implode($separator,$items);
		else
			return self::tag($container,array('id'=>$baseID),implode($separator,$items));
	}
	
	/**
	 * 使用bootstrap3样式渲染activeform的submitButton元素
	 * @param string $label
	 * @param unknown $style
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function submitButton($label = 'submit',$style = self::BUTTON_DEFAULT,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('btn','btn-'.constant('self::'.'BUTTON_'.strtoupper($style))));
		return parent::submitButton($label,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的 errorSummary block
	 * @param object $model
	 * @param string $header
	 * @param string $footer
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function errorSummary($model,$header=null,$footer=null,$htmlOptions=array())
	{
		$content='';
		if(!is_array($model))
			$model=array($model);
		if(isset($htmlOptions['firstError']))
		{
			$firstError=$htmlOptions['firstError'];
			unset($htmlOptions['firstError']);
		}
		else
			$firstError=false;
		foreach($model as $m)
		{
			foreach($m->getErrors() as $errors)
			{
				foreach($errors as $error)
				{
					if($error!='')
						$content.="<li>$error</li>\n";
					if($firstError)
						break;
				}
			}
		}
		if($content!=='')
		{
			if($header===null)
				$header='<p>'.Yii::t('yii','Please fix the following input errors:').'</p>';
			if(!isset($htmlOptions['class']))
				$htmlOptions['class'] = self::$errorSummaryCss;
			//添加警告框关闭按钮
			$header .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			return self::tag('div',$htmlOptions,$header."\n<ul>\n$content</ul>".$footer);
		}
		else
			return '';
	}
	/**
	 * 使用bootstrap3样式渲染 img标签使img标签具有响应式
	 * @param string $src
	 * @param string $alt
	 * @param array $htmlOptions
	 * @return string
	 */
	public static function image($src,$alt='',$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('img-responsive'));
		return parent::image($src,$alt,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染 button按钮
	 * @param string $label
	 * @param unknown $style
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public static function htmlButton($label='button',$style=self::BUTTON_DEFAULT,$htmlOptions=array())
	{
		self::mergeClass($htmlOptions, array('btn','btn-'.constant('self::'.'BUTTON_'.strtoupper($style))));
		return parent::htmlButton($label,$htmlOptions);
	}
}