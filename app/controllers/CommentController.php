<?php

class CommentController extends BaseController{

    public function get_user_comments(){
        // disgusting
        // 怎么改进
        $comments = Comment::select( 'comments.id', 'comments.content', 'comments.created_at', 'register_records.doctor_id' )
                           ->join( 'register_records', 'comments.record_id', '=', 'register_records.id' )
                           ->join( 'register_accounts', 'register_records.account_id', '=', 'register_accounts.id' )
                           ->join( 'users', 'register_accounts.user_id', '=', 'users.id' )
                           ->where( 'users.id', Session::get( 'user.id' ) )->get();

        if ( !isset( $comments ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '无评价记录' ));
        }

        foreach ( $comments as $comment ){
            $doctor = Doctor::find( $comment['doctor_id'] );

            $comment['doctor'] = array(
                'id'            => $doctor->id,
                'name'          => $doctor->name,
                'photo'         => $doctor->photo,
                'title'         => $doctor->title->name,
                'department'    => $doctor->department->name,
                'hospital'      => $doctor->department->hospital->name
            );

            unset( $comment['doctor_id'] );
        }

        return Response::json(array( 'error_code' => 0, 'total' => $comments->count(), 'comments' => $comments ));
    }

    public function get_doctor_comments(){

    }

    public function add_comment(){

    }

    public function modify_comment(){

    }

    public function delete_comment(){

    }
}
/*

*/