<?php

class RegisterRecordTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'register_records' )->delete();

        RegisterRecord::create(array(
            'date' => '2015-07-02',
            'start' => '8:30',
            'end' => '9:30',
            'period' => 0,
            'status' => 0,
            'advice' => '',
            'return_date' => '2015-08-02',
            'doctor_id' => 5,
            'account_id' => 1
        ));

        RegisterRecord::create(array(
            'date' => '2015-07-15',
            'start' => '14:30',
            'end' => '14:50',
            'period' => 1,
            'status' => 1,
            'advice' => '多喝水',
            'return_date' => '2015-07-20',
            'doctor_id' => 6,
            'account_id' => 2
        ));

        RegisterRecord::create(array(
            'date' => '2015-07-20',
            'start' => '16:30',
            'end' => '18:30',
            'period' => 1,
            'status' => 2,
            'advice' => '多吃药',
            'return_date' => '2015-08-20',
            'doctor_id' => 7,
            'account_id' => 3
        ));

        RegisterRecord::create(array(
            'date' => '2015-07-28',
            'start' => '8:00',
            'end' => '12:00',
            'period' => 0,
            'status' => 1,
            'advice' => '多运动',
            'return_date' => '2015-08-01',
            'doctor_id' => 8,
            'account_id' => 4
        ));
    }
}