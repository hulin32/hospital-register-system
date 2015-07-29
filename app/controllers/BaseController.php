<?php

class BaseController extends Controller {

	protected $return_type;

	protected static $default_return_type = 'html';

	public function __construct(){
		$return_type = Input::get( 'return_type', self::$default_return_type );
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( !is_null($this->layout) )
		{
			$this->layout = View::make($this->layout);
		}
	}

}
