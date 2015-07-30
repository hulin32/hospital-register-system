<?php

class BaseController extends Controller {

	protected $error_code;

	protected $template;

	protected $return_type;

	protected $error_messages;

	protected $postprocess_functions;

	protected $preprocess_functions;

	protected static $default_return_type = 'html';

	public function __construct(){
		$this->error_code = 0;
		$this->error_messages = array( 0 => 'ok' );

		$this->postprocess_functions = array();
		$this->preprocess_functions = array();

		$this->template = '';
		$this->return_type = Input::get( 'return_type', self::$default_return_type );
	}

	public function is_status_ok(){
		return !$this->error_code;
	}

	public function set_error_message( $index, $message ){
		$this->error_messages[ $index ] = $message;
	}

	public function get_error_message( $index ){
		return $this->error_messages[ $index ];
	}

	public function set_template( $template ){
		$this->template = $template;
	}

	public function get_template(){
		return $this->template;
	}

	public function set_error_code( $error_code ){
		$this->error_code = $error_code;
	}

	public function get_error_code( ){
		return $this->error_code;
	}

	public function set_postprocess_function( $type, $func ){
		$this->postprocess_functions[ $type ] = $func;
	}

	public function get_postprocess_function( $type ){
		return $this->postprocess_functions[ $type ];
	}

	public function set_preprocess_function( $type, $func ){
		$this->preprocess_functions[ $type ] = $func;
	}

	public function get_preprocess_function( $type ){
		return $this->preprocess_functions[ $type ];
	}

	protected function call_preprocess_function( $type, $data ){
	
		if ( array_key_exists( $type, $this->preprocess_functions ) ){
			$func = $this->preprocess_functions[ $type ];
			
			if ( is_callable( $func ) ){
				return $func( $data, $this->is_status_ok() );	
			}
		}

		return $data;
	}

	protected function call_postprocess_function( $type, $data ){
		
		if ( array_key_exists( $type, $this->preprocess_functions ) ){
			$func = $this->preprocess_functions[ $type ];
			
			if ( is_callable( $func ) ){
				return $func( $data, $this->is_status_ok() );	
			}
		}

		return $data;
	}

	/**
	 * Create response with parameter 'data'
	 *
	 * @return json or html
	 */
	public function response( $data ){
		
		/**
		 * For json response
		 * 
		 */
		if ( $this->return_type == 'json' ){
			$result = array( 'error_code' => $this->error_code );

			$data = $this->call_preprocess_function( 'json', $data );

			if ( $this->is_status_ok() ){
				$data['error_code'] = $this->error_code;
				$result = $data;
			}else{
				$result['message'] = $this->error_messages[ $this->error_code ];
			}

			return Response::json( $this->call_postprocess_function( 'json', $result ) );
		}

		/**
		 * For html response
		 * Not any procedure. Just call preprocess and post process functions.
		 */
		else if ( $this->return_type = 'html' ){
			$this->call_preprocess_function( 'html', $data );

			//$result = $this->is_status_ok() ? $data : $this->error_messages[ $this->error_code ];

			return View::make( $this->template, $this->call_postprocess_function( 'html', $data ) );
		}
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
