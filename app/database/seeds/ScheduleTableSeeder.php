<?php

class ScheduleTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'schedules' )->delete();

        Schedule::create(array(
            'date' => '2015-08-10',
            'period' => 0,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-08-10',
            'period' => 1,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-08-11',
            'period' => 0,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-08-10',
            'period' => 0,
            'doctor_id' => 2
        ));

        Schedule::create(array(
            'date' => '2015-08-11',
            'period' => 1,
            'doctor_id' => 2,
        ));

        Schedule::create(array(
            'date' => '2015-08-10',
            'period' => 1,
            'doctor_id' => 3,
        ));

        Schedule::create(array(
            'date' => '2015-08-11',
            'period' => 0,
            'doctor_id' => 3,
        ));

        Schedule::create(array(
            'date' => '2015-08-12',
            'period' => 0,
            'doctor_id' => 3,
        ));
    }
}