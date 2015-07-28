<?php

class ScheduleTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'schedules' )->delete();

        Schedule::create(array(
            'date' => '2015-07-29',
            'period' => 0,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-07-29',
            'period' => 1,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-07-29',
            'period' => 2,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-07-30',
            'period' => 0,
            'doctor_id' => 1,
        ));

        Schedule::create(array(
            'date' => '2015-07-29',
            'period' => 0,
            'doctor_id' => 2
        ));

        Schedule::create(array(
            'date' => '2015-07-30',
            'period' => 1,
            'doctor_id' => 2,
        ));

        Schedule::create(array(
            'date' => '2015-07-30',
            'period' => 2,
            'doctor_id' => 2,
        ));

        Schedule::create(array(
            'date' => '2015-07-29',
            'period' => 1,
            'doctor_id' => 3,
        ));

        Schedule::create(array(
            'date' => '2015-07-30',
            'period' => 0,
            'doctor_id' => 3,
        ));

        Schedule::create(array(
            'date' => '2015-07-31',
            'period' => 0,
            'doctor_id' => 3,
        ));
    }
}