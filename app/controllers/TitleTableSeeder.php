<?php

class TitleTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'titles' )->delete();

        Title::create(array(
            'name' => '主任医师',
            'register_fee'=> '50',
        ));

        Title::create(array(
            'name' => '副主任医师',
            'register_fee'=> '5',
        ));

        Title::create(array(
            'name' => '副副任医师',
            'register_fee'=> '5',
        ));
    }
}