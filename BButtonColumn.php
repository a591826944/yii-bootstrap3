<?php
Yii::import('zii.widgets.grid.CButtonColumn');
/**
 * 对 grid view 中操作行的动作按钮 应用 Bootstrap3样式
 * @author wwpeng
 * @version 2014-6-9
 */
class BButtonColumn extends CButtonColumn
{
	public $viewButtonImageUrl = 'glyphicon-eye-open';
	
	public $updateButtonImageUrl = 'glyphicon-pencil';
	
	public $deleteButtonImageUrl = 'glyphicon-trash';
	/**
	 * 使用Bootstrap 图标样式的按钮
	 * (non-PHPdoc)
	 * @see CButtonColumn::renderButton()
	 */
	protected function renderButton($id,$button,$row,$data)
	{
		if (isset($button['visible']) && !$this->evaluateExpression($button['visible'],array('row'=>$row,'data'=>$data)))
			return;
		$label=isset($button['label']) ? $button['label'] : $id;
		$url=isset($button['url']) ? $this->evaluateExpression($button['url'],array('data'=>$data,'row'=>$row)) : '#';
		$options=isset($button['options']) ? $button['options'] : array();
		if(!isset($options['title']))
			$options['title']=$label;
		if(isset($button['imageUrl']) && is_string($button['imageUrl']))
		{
			if(stristr($button['imageUrl'], 'glyphicon-'))
			{
				echo CHtml::link('<i class="glyphicon '.$button['imageUrl'].'"></i>',$url,$options);
				
			}else{
				
				echo CHtml::link(CHtml::image($button['imageUrl'],$label),$url,$options);
			}
			
		}else{
			
			echo CHtml::link($label,$url,$options);
		}
	}
}