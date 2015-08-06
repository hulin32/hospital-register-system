<?php

class UserTableSeeder extends Seeder {

    public function run()
    {

        DB::table( 'users' )->delete();

        Sentry::createUser(array(
            'nickname' => 'hyuyuan',
            'password' => '58085088',
            'real_name' => '黄裕源',
            'phone' => '13580501456',
            'gender' => 1,
            'activated' => 1
        ));

        Sentry::createUser(array(
            'nickname' => 'Cobb',
            'password' => '123456',
            'real_name' => '李四',
            'phone' => '13512341234',
            'gender' => 1,
            'activated' => 1
        ));

        Sentry::createUser(array(
            'nickname' => 'Alies',
            'password' => '123123',
            'real_name' => '小李子',
            'phone' => '18511112222',
            'gender' => 2,
            'activated' => 1
        ));

        Sentry::createUser(array(
            'nickname' => 'adeng',
            'password' => '8888888',
            'real_name' => '阿登',
            'phone' => '18899990000',
            'gender' => 2,
            'activated' => 1
        ));

        Sentry::createUser(array(
            'nickname' => 'hulin',
            'password' => 'abcdefg',
            'real_name' => '胡琳',
            'phone' => '13250502288',
            'gender' => 1,
            'activated' => 1
        ));

        Sentry::createUser(array(
            'nickname' => 'jiali',
            'password' => 'bcd123',
            'real_name' => '袁嘉丽',
            'phone' => '13322225555',
            'gender' => 2,
            'activated' => 1
        ));
    }
}
