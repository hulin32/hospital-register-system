<?php

class BaseController extends Controller {

	protected $data;

	protected $template;

	protected $return_type;

	protected $error_code;

	protected $error_messages;

	protected $postprocess_functions;

	protected $preprocess_functions;

	protected static $default_return_type = 'html';

	protected function get_return_format(){

		if ( Request::wantsJson() ){
			return 'json';
		}

		return self::$default_return_type;
	}

	public function __construct(){
		$this->data = array();
		$this->error_code = 0;
		$this->error_messages = array( 0 => 'ok' );

		$this->postprocess_functions = array();
		$this->preprocess_functions = array();

		$this->template = '';
		$this->return_type = $this->get_return_format(); 
	}

	public function is_status_ok(){
		return !$this->error_code;
	}

	public function set_data( $data ){
		$this->data = $data;
	}

	public function get_data(){
		return $this->data;
	}

	public function set_return_type( $return_type ){
		$this->return_type = $return_type;
	}

	public function get_return_type(){
		return $this->return_type;
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

	public function set_error_message( $code, $message ){
		$this->error_messages[ $code ] = $message;
	}

	public function get_error_message( $code ){
		return $this->error_messages[ $code ];
	}

	public function set_error_code_and_message( $code, $message ){
		$this->error_code = $code;
		$this->error_messages[ $code ] = $message;
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

	/**
	 * Call preprocess function 
	 *
	 * @var 	$type 	string
	 * @var 	$data   arary
	 * @return  array
	 */
	protected function call_preprocess_function( $type, $data ){
	
		if ( array_key_exists( $type, $this->preprocess_functions ) ){
			$func = $this->preprocess_functions[ $type ];
			
			if ( is_callable( $func ) ){
				return $func( $data );	
			}
		}

		return $data;
	}

	/**
	 * Call post process function 
	 *
	 * @var 	$type 	string
	 * @var 	$data   arary
	 * @return  array
	 */
	protected function call_postprocess_function( $type, $data ){
		
		if ( array_key_exists( $type, $this->postprocess_functions ) ){
			$func = $this->postprocess_functions[ $type ];
			
			if ( is_callable( $func ) ){
				return $func( $data, $this->is_status_ok() );	
			}
		}

		return $data;
	}

	/**
	 * Create response with data
	 *
	 * @var 	$data array
	 * @return  mix
	 */
	public function response( ){

		$data = $this->data;
		
		/**
		 * For json response
		 * 
		 */
		if ( $this->return_type == 'json' ){

			$data = $this->call_preprocess_function( $this->return_type, $data );

			if ( $this->is_status_ok() ){
				$data['error_code'] = $this->error_code;
				$result = $data;
			}else{
				$result = array(
					'error_code' => $this->error_code,
					'message' 	 => $this->error_messages[ $this->error_code ]
				);
			}

			return Response::json( $this->call_postprocess_function( $this->return_type, $result ) );
		}

		/**
		 * For html response
		 * Not any procedure. Just call preprocess and post process functions.
		 */
		else if ( $this->return_type == 'html' ){

			$data = $this->call_preprocess_function( $this->return_type, $data );

			//$result = $this->is_status_ok() ? $data : $this->error_messages[ $this->error_code ];

			return View::make( $this->template, $this->call_postprocess_function( $this->return_type, $data ) );
		}

		return $data;
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
