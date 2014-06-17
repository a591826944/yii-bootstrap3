<?php
/**
 * 重写 CActiveForm 类 使表单元素应用 bootstrap3样式
 * @author wwpeng < 591826944@qq.com >
 * @version 2013-11-14
 */
class BActiveForm extends CActiveForm
{
	/**
	 * 使用bootstrap3样式渲染activeform的input text元素
	 * @link BHtml::activeTextField
	 * (non-PHPdoc)
	 * @see CActiveForm::textField()
	 */
	public function textField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activeTextField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input url元素
	 * (non-PHPdoc)
	 * @see CActiveForm::urlField()
	 */
	public function urlField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activeUrlField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input email元素
	 * (non-PHPdoc)
	 * @see CActiveForm::urlField()
	 */
	public function emailField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activeEmailField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input number元素
	 * (non-PHPdoc)
	 * @see CActiveForm::urlField()
	 */
	public function numberField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activeNumberField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input range元素
	 * (non-PHPdoc)
	 * @see CActiveForm::urlField()
	 */
	public function rangeField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activeRangeField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input date元素
	 * (non-PHPdoc)
	 * @see CActiveForm::urlField()
	 */
	public function dateField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activeDateField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的input password元素
	 * @link BHtml::activePasswordField
	 * (non-PHPdoc)
	 * @see CActiveForm::passwordField()
	 */
	public function passwordField($model,$attribute,$htmlOptions=array())
	{
		return BHtml::activePasswordField($model,$attribute,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的submitButton元素
	 * @link BHtml::submitButton
	 * @param array $htmlOptions
	 * @return string
	 */
	public function submitButton($label='submit',$style = BHtml::BUTTON_DEFAULT, $htmlOptions = array())
	{
		return BHtml::submitButton($label,$style,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的 errorSummary block
	 * (non-PHPdoc)
	 * @see CActiveForm::errorSummary()
	 */
	public function errorSummary($models,$header=null,$footer=null,$htmlOptions=array())
	{
		if(!$this->enableAjaxValidation && !$this->enableClientValidation)
			return BHtml::errorSummary($models,$header,$footer,$htmlOptions);
	
		if(!isset($htmlOptions['id']))
			$htmlOptions['id']=$this->id.'_es_';
		$html = BHtml::errorSummary($models,$header,$footer,$htmlOptions);
		if($html==='')
		{
			if($header===null)
				$header='<p>'.Yii::t('yii','Please fix the following input errors:').'</p>';
			if(!isset($htmlOptions['class']))
				$htmlOptions['class'] = BHtml::$errorSummaryCss;
			//添加警告框关闭按钮
			$header .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
			$htmlOptions['style']=isset($htmlOptions['style']) ? rtrim($htmlOptions['style'],';').';display:none' : 'display:none';
			$html = BHtml::tag('div',$htmlOptions,$header."\n<ul><li>dummy</li></ul>".$footer);
		}
	
		$this->summaryID=$htmlOptions['id'];
		return $html;
	}
	/**
	 * 快速构建 Bootstrap3 的 input group 组合输入框
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $icon 如果icon 中含有 glyphicon-，则加载一个glyphicons图标，否则icon直接输出字符串
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public function textFieldGroup($model,$attribute,$icon,$htmlOptions=array())
	{
        $input = $this->textField($model, $attribute, $htmlOptions);
		return $this->inputGroup($input, $icon);
	}
	/**
	 * 快速构建 Bootstrap3 的 密码输入组合框
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $icon 如果icon 中含有 glyphicon-，则加载一个glyphicons图标，否则icon直接输出字符串
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public function passwordFieldGroup($model,$attribute,$icon,$htmlOptions=array())
	{
		$input = $this->passwordField($model, $attribute, $htmlOptions);
		return $this->inputGroup($input, $icon);
	}
	/**
	 * 快速构建 Bootstrap3 的 url输入组合框
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $icon url默认glyphicon glyphicon-link
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public function urlFieldGroup($model,$attribute,$htmlOptions=array(),$icon = 'glyphicon-link')
	{
		$input = $this->urlField($model, $attribute, $htmlOptions);
		return $this->inputGroup($input, $icon);
	}
	/**
	 * 快速构建 Bootstrap3 的 邮箱输入组合框
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $icon 邮箱默认glyphicon glyphicon-envelope
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public function emailFieldGroup($model,$attribute,$htmlOptions=array(),$icon = 'glyphicon-envelope')
	{
		$input = $this->emailField($model, $attribute, $htmlOptions);
		return $this->inputGroup($input, $icon);
	}
	/**
	 * 快速构建 Bootstrap3 的 数字输入组合框
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $icon 数字默认@
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public function numberFieldGroup($model,$attribute,$htmlOptions=array(),$icon = '@')
	{
		$input = $this->numberField($model, $attribute, $htmlOptions);
		return $this->inputGroup($input, $icon);
	}
	/**
	 * 快速构建 Bootstrap3 的 日期输入组合框
	 * @param unknown $model
	 * @param unknown $attribute
	 * @param unknown $icon 日期默认图标是glyphicon glyphicon-calendar
	 * @param unknown $htmlOptions
	 * @return string
	 */
	public function dateFieldGroup($model,$attribute,$htmlOptions=array(),$icon = 'glyphicon-calendar')
	{
		$input = $this->dateField($model, $attribute, $htmlOptions);
		return $this->inputGroup($input, $icon);
	}
	/**
	 * 公用的构建组合输入框的样式
	 * @param unknown $input 已经渲染出来的 输入框的html
	 * @param unknown $icon 如果icon 中含有 glyphicon-，则加载一个glyphicons图标，否则icon直接输出字符串
	 * @return string
	 */
	private function inputGroup($input,$icon)
	{
		if (stristr($icon, 'glyphicon-'))
		{
			$icon = '<i class="glyphicon '.$icon.'"></i>';
		}
		$html = '<div class="input-group"><span class="input-group-addon">'.$icon.'</span>'.$input.'</div>';
		return $html;
	}
	/**
	 * 使用bootstrap3样式渲染activeform的 radio list元素
	 * (non-PHPdoc)
	 * @see CActiveForm::radioButtonList()
	 */
	public function radioButtonList($model,$attribute,$data,$htmlOptions=array())
	{
		return BHtml::activeRadioButtonList($model,$attribute,$data,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的 select 元素
	 * (non-PHPdoc)
	 * @see CActiveForm::dropDownList()
	 */
	public function dropDownList($model,$attribute,$data,$htmlOptions=array())
	{
		return BHtml::activeDropDownList($model,$attribute,$data,$htmlOptions);
	}
	/**
	 * 使用bootstrap3样式渲染activeform的 select 元素
	 * (non-PHPdoc)
	 * @see CActiveForm::listBox()
	 */
	public function listBox($model,$attribute,$data,$htmlOptions=array())
	{
		return BHtml::activeListBox($model,$attribute,$data,$htmlOptions);
	}
}