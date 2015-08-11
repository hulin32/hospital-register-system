<?php

class RegisterRecordController extends BaseController{

    protected $possible_status;

    protected $possible_period;

    public function __construct(){
        parent::__construct();
        $this->possible_status = array( '未就诊', '已就诊', '需复诊' );
        $this->possible_period = array( '上午', '下午' );
    }

    public function get_records(){

        $register_accounts = User::find( Session::get( 'user.id' ) )
                                   ->register_accounts()
                                   ->with( 'records' )->get();

        if ( !isset( $register_accounts ) ){
            $this->set_error_code( 1 );
            $this->set_error_message( 1, '无记录' );
        }

        $this->set_postprocess_function( 'json', function( $result, $status ) use ( $register_accounts ) {
            
            $data = array();

            foreach( $register_accounts as $register_account ){
                $origin_records = $register_account->records;

                foreach ( $origin_records as $record ){
                    $doctor     = RegisterRecord::find( $record->id )->doctor()->first();
                    $department = $doctor->department()->first();
                    $result_records[]  = array(
                        'id'            =>  $record->id,
                        'status'        =>  $this->possible_status[ $record->status ],
                        'advice'        =>  $record->advice,
                        'date'          =>  $record->date,
                        'start'         =>  $record->start,
                        'end'           =>  $record->end,
                        'period'        =>  $this->possible_period[ $record->period ],
                        'return_date'   =>  $record->return_date,
                        'department'    =>  $department->name,
                        'doctor'        =>  array( 'id' => $doctor->id, 
                                                   'name' => $doctor->name, 
                                                   'title' => $doctor->title()->first()->name 
                                            )
                    );
                }

                $data[] = array(
                    'id' => $register_account->id,
                    'name' => $register_account->name,
                    'records' => $result_records
                );
            }

            $result[ 'register_accounts' ] = $data;

            return $result;
        });

        $this->set_template( 'user.record' );
        $this->set_postprocess_function( 'html', function( $result, $status ) use ( $register_accounts ) {

            $data = array( 'records' => array() );

            foreach( $register_accounts as $register_account ){

                $origin_records = $register_account->records;

                foreach ( $origin_records as $record ){
                    $doctor     = RegisterRecord::find( $record->id )->doctor()->first();
                    $department = $doctor->department()->first();
                    $data['records'][] = array(
                        'id'                =>  $record->id,
                        'status'            =>  $this->possible_status[ $record->status ],
                        'can_be_canceled'   =>  $record->status == 0,
                        'date'              =>  $record->date,
                        'start'             =>  date( 'H:i', strtotime( $record->start ) ),
                        'end'               =>  date( 'H:i', strtotime( $record->end ) ),
                        'period'            =>  $this->possible_period[ $record->period ],
                        'department'        =>  $department->name,
                        'doctor'            =>  array( 'id' => $doctor->id, 
                                                       'name' => $doctor->name, 
                                                       'title' => $doctor->title()->first()->name )
                    );
                }
            }

            return $data;
        });

        return $this->response();
    }

    public function add_record(){

        $account_id     = Input::get( 'account_id' );
        $period_id      = Input::get( 'period_id' );
        $period         = Period::find( $period_id );
        $schedule       = $period->schedule;

        if ( !isset( $period ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '无该时间段，请重新选择' ));
        }

        $user_id = Session::get( 'user.id' );
        
        if ( Input::has( 'account_id' ) ){
            $account_id = Input::get( 'account_id' );
            $account    = RegisterAccount::find( $account_id )->where( 'user_id', $user_id )->first();

            if ( !isset( $account ) ){
                return Response::json(array( 'error_code' => 3, 'message' => '不存在该挂号账户' ));
            }
        }
        
        // 无 account_id 参数，则选择该用户默认挂号账户
        else{
            $accounts = User::find( $user_id )->register_accounts();

            if ( !isset( $accounts ) ){
                return Response::json(array( 'error_code' => 4, 'message' => '请先申请挂号账户' ));
            }
            
            $account_id = $accounts->first()->id;
        }

        try{
            RegisterRecord::create(array(
                'status'        => 0,
                'date'          => $schedule->date,
                'start'         => $period->start,
                'end'           => $period->end,
                'period'        => $schedule->period,
                'doctor_id'     => $schedule->doctor_id,
                'account_id'    => $account_id
            ));
        }catch( Exception $e ){
            return Response::json(array( 'error_code' => 1, 'message' => '添加失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '添加成功' ));
    }

    public function cancel(){

        $record_id = Input::get( 'record_id' );
        $record    = RegisterRecord::find( $record_id );

        // 是否存在该记录
        if ( !isset( $record ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '不存在该挂号' ));
        }

        $register_account = RegisterAccount::find( $record->account_id );

        // 检查该就诊记录是否该用户的
        if ( $register_account->user_id != Session::get( 'user.id' ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '无法取消该挂号' ));
        }

        // 检查就诊状态
        if ( $record->status ){
            return Response::json(array( 'error_code' => 4, 'message' => '已就诊无法取消' ));
        }

        // 取消
        if ( !RegisterRecord::destroy( $record_id ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '取消失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '取消成功' ));
    }

    public function modify_status(){

        $record_id = Input::get( 'record_id' );
        $record    = RegisterRecord::find( $record_id );

        // 是否存在该记录
        if ( !isset( $record ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '不存在该挂号' ));
        }

        $register_account = RegisterAccount::find( $record->account_id );

        // 检查该就诊记录是否该用户的
        if ( $register_account->user_id != Session::get( 'user.id' ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '无法修改该挂号' ));
        }

        $status = (int)Input::get( 'status' );
        if ( $status > 2 || $status < 0 ){
            return Response::json(array( 'error_code' => 4, 'message' => '参数错误' ));
        }

        $record->status = $status;
        if ( !$record->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '修改失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '修改成功' ));
    }

    public function add_return_date(){

        $record = RegisterRecord::find( Input::get( 'record_id' ) );

        // 是否存在该记录
        if ( !isset( $record ) ){
            return Response::json(array( 'error_code' => 2, 'message' => '不存在该挂号记录' ));
        }

        $register_account = RegisterAccount::find( $record->account_id );

        // 检查该就诊记录是否该用户的
        if ( $register_account->user_id != Session::get( 'user.id' ) ){
            return Response::json(array( 'error_code' => 3, 'message' => '无法修改该挂号' ));
        }

        // 检查就诊状态
        /*
        if ( !(int)($record->status) ){
            return Response::json(array( 'error_code' => 4, 'message' => '尚未就诊' ));
        }
        */

        $record->return_date = Input::get( 'date' );

        if ( !$record->save() ){
            return Response::json(array( 'error_code' => 1, 'message' => '设置失败' ));
        }

        return Response::json(array( 'error_code' => 0, 'message' => '设置成功' ));
    }
}
