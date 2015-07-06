<?php defined('SYSPATH') OR die('No direct script access.');

class ORM extends Kohana_ORM {
	
	public function as_json() {
        return json_encode($this->as_array(), array());
    }
	
}
