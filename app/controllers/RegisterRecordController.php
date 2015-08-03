<?php

class RegisterRecordController extends BaseController{

    protected $possible_status;

    protected $possible_period;

    public function __construct(){
        parent::__construct();
        $this->possible_status = array( '未就诊', '已就诊', '需复诊' );
        $this->possible_period = array( '下午', '上午' );
    }

    public function get_records(){

        $register_accounts = User::find( Session::get( 'user_id' ) )
                                   ->register_accounts()
                                   ->with( 'records' )->get();

        $data = array( 'register_accounts' => array() );

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
                    'start'         =>  $record->start_time,
                    'end'           =>  $record->end_time,
                    'period'        =>  $this->possible_period[ $record->period ],
                    'return_time'   =>  $record->return_time,
                    'department'    =>  $department->name,
                    'doctor'        =>  array( 'name' => $doctor['name'], 'title' => $doctor['title'] )
                );
            }

            $data['register_accounts'][] = array(
                'id' => $register_account->id,
                'name' => $register_account->name,
                'records' => $result_records
            );
        }

        $this->set_data( $data );

        $this->set_postprocess_function( 'json', function( $result, $status ){
            return $result;
        });

        $this->set_template( 'user.record' );
        $this->set_postprocess_function( 'html', function( $result, $status ){

        });

        return $this->response();
    }

    public function add_record(){

        $period_id      = Input::get( 'period_id' );
        $period         = Period::find( $period_id );
        $schedule       = $period->schedule;

        if ( !isset( $period ) ){
            return Response::json(array( 'error_code' => 1, 'message' => '无该时间段，请重新选择' ));
        }
        
        if ( !Input::get( 'account_id' ) ){
            $accounts = User::find( Session::get( 'user.id' ) )->register_accounts();

            if ( !isset( $accounts ) ){
                return Response::json(array( 'error_code' => 2, 'message' => '请先申请挂号账户' ));
            }
            
            $account_id = $accounts->first()->id;
        }

        RegisterRecord::create(array(
            'status'        => 0,
            'date'          => $schedule->date,
            'start'         => $period->start,
            'end'           => $period->end,
            'period'        => $schedule->period,
            'doctor_id'     => $schedule->doctor_id,
            'account_id'    => $account_id
        ));

        return Response::json(array( 'error_code' => 0, 'message' => '添加成功' ));
    }

    public function cancel(){
        
    }

    public function add_return_time(){

    }
}