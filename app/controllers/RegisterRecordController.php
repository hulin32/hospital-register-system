<?php

class RegisterRecordController extends BaseController{

    public function get_records(){
        $this->set_template( 'user.record' );

        $register_accounts = User::find( Sentry::getUser()->id )
                                   ->register_accounts()
                                   ->with( 'records' )->get();

        $data = array( 'register_accounts' => array() );

        foreach( $register_accounts as $register_account ){
            $origin_records = $register_account->records;
            $result_records = array();

            foreach ( $origin_records as $record ){
                $doctor     = RegisterRecord::find( $record->id )->doctor()->first();
                $department = $doctor->department()->first();
                $result_records[]  = array(
                    'id'            =>  $record->id,
                    'status'        =>  $record->status,
                    'advice'        =>  $record->advice,
                    'date'          =>  $record->date,
                    'start'         =>  $record->start_time,
                    'end'           =>  $record->end_time,
                    'period'        =>  $record->period ? '下午' : '上午',
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

        $this->set_postprocess_function( 'html', function( $result, $status ){

        });

        return $this->response();
    }

    public function add_record(){

    }

    public function cancel(){
        
    }

    public function add_return_time(){

    }
}