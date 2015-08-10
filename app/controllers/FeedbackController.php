<?php

class FeedbackController extends BaseController{

    public function index(){

        return View::make( 'user.feedback.index' );
    }

    public function add_feedback(){

        if ( !Input::has( 'title' ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '请输入标题' ));
        }

        if ( !Input::has( 'content' ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '请输入反馈内容' ));
        }

        $feedback = new Feedback();
        $feedback->title = Input::get( 'title' );
        $feedback->content = Input::get( 'content' );

        if ( !$feedback->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '反馈失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '反馈成功' ));        
    }

    public function modify_feeback(){
        
    }

    public function delete_feedback(){

    }

    public function success(){

        return View::make( 'user.feedback.success' );
    }
}
