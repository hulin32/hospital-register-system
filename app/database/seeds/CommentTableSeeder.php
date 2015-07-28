<?php

class CommentTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'comments' )->delete();

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'user_id' => 4,
            'doctor_id' => 4
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'user_id' => 3,
            'doctor_id' => 5
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'user_id' => 2,
            'doctor_id' => 6
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'user_id' => 1,
            'doctor_id' => 7
        ));
    }
}