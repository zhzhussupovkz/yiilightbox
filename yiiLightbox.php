<?php

class yiiLightbox extends CWidget
{
	//id tag for plugin
	public $id = 'gallery a';

	//path and the name of the loading icon
	protected $img_load;

	//path and the name of the prev button image
	protected $img_prev;

	//path and the name of the next button image
	protected $img_next;

	//path and the name of the close button image
	protected $img_close;

	//path and the name of a blank image (one pixel)
	protected $img_blank;

	public function run()
	{
		$this->registerAllScripts();
		$script = "$(function(){
			$('#".$this->id."').lightBox({
				imageLoading : '".$this->img_load."',
				imageBtnPrev : '".$this->img_prev."',
				imageBtnNext : '".$this->img_next."',
				imageBtnClose : '".$this->img_close."',
				imageBlank : '".$this->img_blank."',
			});
		});";
		Yii::app()->clientScript->registerScript('yiiLightbox', $script, CClientScript::POS_END);
	}

	//access Lightbox
	protected function registerAllScripts()
	{
		$assets=dirname(__FILE__).DIRECTORY_SEPARATOR.'assets';
		$baseUrl=Yii::app()->assetManager->publish($assets);
		if(is_dir($assets))
		{
			Yii::app()->clientScript->registerCoreScript('jquery');
			Yii::app()->clientScript->registerScriptFile($baseUrl.'/jquery.lightbox-0.5.pack.js');
			Yii::app()->clientScript->registerCssFile($baseUrl.'/jquery.lightbox-0.5.css');
			Yii::app()->clientScript->registerCssFile($baseUrl.'/gallery.css');
			$this->img_load = $baseUrl.'/images/lightbox-ico-loading.gif';
			$this->img_prev = $baseUrl.'/images/lightbox-btn-prev.gif';
			$this->img_next = $baseUrl.'/images/lightbox-btn-next.gif';
			$this->img_close = $baseUrl.'/images/lightbox-btn-close.gif';
			$this->img_blank = $baseUrl.'/images/lightbox-blank.gif';
		}
		else
		{
			throw new Exception('Error in yiiLightbox widget! Cannot access assets folder');
		}
	}
}