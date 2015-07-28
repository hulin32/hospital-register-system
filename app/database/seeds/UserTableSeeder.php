<?php

class UserTableSeeder extends Seeder {

    public function run()
    {

        DB::table( 'users' )->delete();

        Sentry::createUser(array(
            'account' => 'hyuyuan',
            'password' => '58085088',
            'gender' => 1,
            'phone' => '13580501456',
            'activated' => 1
        ));

        Sentry::createUser(array(
            'account' => 'Cobb',
            'password' => '123456',
            'gender' => 1,
            'phone' => '13512341234',
            'activated' => 1
        ));

        Sentry::createUser(array(
            'account' => 'Alies',
            'password' => '123123',
            'gender' => 2,
            'phone' => '18511112222',
            'activated' => 1
        ));

        Sentry::createUser(array(
            'account' => 'adeng',
            'password' => '8888888',
            'gender' => 2,
            'phone' => '18899990000',
            'activated' => 1
        ));

        Sentry::createUser(array(
            'account' => 'hulin',
            'password' => 'abcdefg',
            'gender' => 1,
            'phone' => '13250502288',
            'activated' => 1
        ));

        Sentry::createUser(array(
            'account' => 'jiali',
            'password' => 'bcd123',
            'gender' => 2,
            'phone' => '13322225555',
            'activated' => 1
        ));
    }
}
