<?php

class RegisterRecordTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'register_records' )->delete();

        RegisterRecord::create(array(
            'date' => '2015-07-02',
            'start_time' => '8:30',
            'end_time' => '9:30',
            'status' => 0,
            'advice' => '',
            'return_date' => '2015-08-02',
            'doctor_id' => 5,
            'account_id' => 1
        ));

        RegisterRecord::create(array(
            'date' => '2015-07-15',
            'start_time' => '14:30',
            'end_time' => '14:50',
            'status' => 1,
            'advice' => '多喝水',
            'return_date' => '2015-07-20',
            'doctor_id' => 6,
            'account_id' => 2
        ));

        RegisterRecord::create(array(
            'date' => '2015-07-20',
            'start_time' => '16:30',
            'end_time' => '18:30',
            'status' => 2,
            'advice' => '多吃药',
            'return_date' => '2015-08-20',
            'doctor_id' => 7,
            'account_id' => 3
        ));

        RegisterRecord::create(array(
            'date' => '2015-07-28',
            'start_time' => '8:00',
            'end_time' => '12:00',
            'status' => 1,
            'advice' => '多运动',
            'return_date' => '2015-08-01',
            'doctor_id' => 8,
            'account_id' => 4
        ));
    }
}