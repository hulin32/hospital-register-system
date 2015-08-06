<?php

class CommentTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'comments' )->delete();

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 4,
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 3,
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 2,
        ));

        Comment::create(array(
            'content' => '这医生好帅哦，虽然没阿登帅',
            'record_id' => 1,
        ));
    }
}