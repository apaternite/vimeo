<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Vimeo extends Controller_Template {

	public $template = 'vimeo';
	
	public function action_index()
	{
		$this->template->message = 'hello, vimeo!';
	}

}
