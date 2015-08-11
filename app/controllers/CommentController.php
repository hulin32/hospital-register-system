<?php

class CommentController extends BaseController{

    public function get_user_comments(){
        
        // disgusting
        // 怎么改进
        $comments_per_page = Input::get( 'comments_per_page', 10 );

/*
        $records = User::find( Session::get( 'user.id' ) )
                       ->register_accounts()->records()
                       ->with( 'comment' )->with( 'doctor' )->paginate( $comments_per_page );

        $comments = array();
        foreach ( $records as $record ){
            $comment = $record->comment;
            $doctor  = $record->doctor;

            $comments[] = array(
                'id'            => $comment->id,
                'content'       => $comment->content,
                'created_at'    => $comment->created_at,
                'doctor'        => array(
                                    'id'         => $doctor->id,
                                    'name'       => $doctor->name,
                                    'photo'      => $doctor->photo,
                                    'title'      => $doctor->title->name,
                                    'department' => $doctor->department->name,
                                    'hospital'   => $doctor->department->hospital->name )
            );
        }
*/

        $comments = Comment::select( 'comments.id', 'comments.content', 'comments.created_at', 'register_records.doctor_id' )
                           ->join( 'register_records', 'comments.record_id', '=', 'register_records.id' )
                           ->join( 'register_accounts', 'register_records.account_id', '=', 'register_accounts.id' )
                           ->join( 'users', 'register_accounts.user_id', '=', 'users.id' )
                           ->where( 'users.id', Session::get( 'user.id' ) )
                           ->paginate( (int)$comments_per_page );

        if ( !isset( $comments ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '无评价记录' ));
        }

        foreach ( $comments as $comment ){
            $doctor = Doctor::find( $comment['doctor_id'] );

//            $comment['created_at'] = date_timestamp_get( date_create( $comment['created_at'] ) );

            $comment['doctor'] = array(
                'id'            => $doctor->id,
                'name'          => $doctor->name,
                'photo'         => $doctor->photo,
                'title'         => $doctor->title->name,
                'specialty'     => strip_tags( $doctor->specialty ),
                'department'    => $doctor->department->name,
                'hospital'      => $doctor->department->hospital->name
            );

            unset( $comment['doctor_id'] );
        }

        return Response::json(array( 'error_code' => 0, 'total' => $comments->count(), 'comments' => $comments->getItems() ));
    }

    public function get_doctor_comments(){

        $comments_per_page = Input::get( 'comments_per_page', 10 );

        $comments = Comment::select( 'comments.id', 'comments.content', 'comments.created_at', 'users.nickname', 'users.gender', 'users.photo' )
                           ->join( 'register_records', 'comments.record_id', '=', 'register_records.id' )
                           ->join( 'register_accounts', 'register_records.account_id', '=', 'register_accounts.id' )
                           ->join( 'doctors', 'register_records.doctor_id', '=', 'doctors.id' )
                           ->join( 'users', 'register_accounts.user_id', '=', 'users.id' )
                           ->where( 'doctors.id', Input::get( 'doctor_id' ) )
                           ->paginate( (int)$comments_per_page );

        if ( !isset( $comments ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '无评价记录' ));
        }

        return Response::json(array( 'error_code' => 0, 'total' => $comments->count(), 'comments' => $comments->getItems() ));
    }

    public function add_comment(){

        $record = RegisterRecord::find( Input::get( 'record_id' ) );

        if ( !isset( $record ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '无该记录' ));
        }

        $user_id = RegisterAccount::find( $record->account_id )->user_id;

        if ( $user_id != Session::get( 'user.id' ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '无效记录' ));
        }

        if ( !Input::has( 'content' ) ){
            return Response::json(array( 'error_code' => 4, 'message' => '请输入评价' ));
        }

        $comment            = new Comment();
        $comment->record_id = $record->id;
        $comment->content   = Input::get( 'content' );

        if ( !$comment->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '添加失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '添加成功' ));
    }

    public function modify_comment(){

    }

    public function delete_comment(){

    }
}