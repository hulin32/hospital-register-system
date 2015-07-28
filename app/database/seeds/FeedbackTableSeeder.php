<?php

class FeedbackTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'feedbacks' )->delete();

        Feedback::create(array(
            'title' => '好坑爹啊',
            'content' => '不会治病学别人当什么医生',
            'user_id' => 1
        ));

        Feedback::create(array(
            'title' => '超赞',
            'content' => '好棒哦',
            'user_id' => 2
        ));

        Feedback::create(array(
            'title' => '一般般',
            'content' => '阿西吧~~~~',
            'user_id' => 3
        ));

        Feedback::create(array(
            'title' => '不错',
            'content' => '这家医院不错哦',
            'user_id' => 4
        ));
    }
}