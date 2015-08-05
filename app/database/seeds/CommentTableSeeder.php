<?php

class CommentTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'comments' )->delete();

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 4,
            'doctor_id' => 4,
            'user_id' => RegisterRecord::find( 4 )->user->id
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 3,
            'doctor_id' => 5,
            'user_id' => RegisterRecord::find( 3 )->user->id
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 2,
            'doctor_id' => 6,
            'user_id' => RegisterRecord::find( 2 )->user->id
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 1,
            'doctor_id' => 7,
            'user_id' => RegisterRecord::find( 1 )->user->id
        ));
    }
}