<?php

class HospitalInformationController extends HospitalBasedController{

    public function __construct(){
        parent::__construct();
    }

    public function preview(){
        $news_per_page = (int)( Input::get( 'news_per_page', 5 ) );
        $news = HospitalInformation::select('id', 'title', 'image', 'is_new', 'created_at')
                                     ->where( 'hospital_id', $this->hospital_id )
                                     ->paginate( $news_per_page );

        if ( $news->getTotal() ){
            $page = (int)Input::get( 'page' );

            if ( $page < 1 ){
                return Response::json(array( 'error_code' => 2, 'message' => '页码从1开始' ));
            }

            if ( $news->getTotal() < $page ){
                return Response::json(array( 'error_code' => 3, 'message' => '页码超过最后一页' ));
            }

            return  Response::json(array( 
                        'error_code' => 0,
                        'total' => $news->getTotal(),
                        'news_list' => $news->getItems()
                    ));
        }

        return Response::json(array( 'error_code' => 1, 'message' => '无资讯' ));
    }

    public function detail(){
        $news_id = Input::get( 'news_id' );
        $news = HospitalInformation::find( $news_id );

        if ( $news ){
            return Response::json(array( 
                'error_code' => 0, 
                'news' => $news->select( 'title', 'image', 'is_new', 'created_at', 'content' )->first() ));
        }

        return Response::json(array( 'error_code' => 1, 'message' => 'Not found' ));
    }
}