<?php

class PeriodTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'periods' )->delete();

        Period::create(array(
            'start' => '8:00',
            'end' => '9:30',
            'total' => 10,
            'current' => 2,
            'schedule_id' => 1
        ));

        Period::create(array(
            'start' => '9:30',
            'end' => '10:30',
            'total' => 10,
            'current' => 6,
            'schedule_id' => 1
        ));

        Period::create(array(
            'start' => '10:30',
            'end' => '12:00',
            'total' => 10,
            'current' => 0,
            'schedule_id' => 1
        ));

        Period::create(array(
            'start' => '13:00',
            'end' => '14:30',
            'total' => 10,
            'current' => 10,
            'schedule_id' => 3
        ));

        Period::create(array(
            'start' => '14:30',
            'end' => '16:30',
            'total' => 10,
            'current' => 0,
            'schedule_id' => 3
        ));

        Period::create(array(
            'start' => '16:30',
            'end' => '18:00',
            'total' => 8,
            'current' => 3,
            'schedule_id' => 3
        ));
    }
}