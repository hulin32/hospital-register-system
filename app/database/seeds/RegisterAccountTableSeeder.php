<?php

class RegisterAccountTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'register_accounts' )->delete();

        RegisterAccount::create(array(
            'name' => '阿登',
            'age' => 22,
            'weight' => 60,
            'gender' => 1,
            'blood_type' => 'A型',
            'type' => '老年人',
            'phone' => '13511112222',
            'id_card' => '441111199311112222',
            'emergency_name' => '壁鸿',
            'emergency_phone' => '13522223333',
            'user_id' => 4
        ));

        RegisterAccount::create(array(
            'name' => '黄裕源',
            'age' => 22,
            'weight' => 62,
            'gender' => 1,
            'blood_type' => 'O型',
            'type' => '帅哥',
            'phone' => '13580501456',
            'id_card' => '440923199302065413',
            'emergency_name' => '黄裕源',
            'emergency_phone' => '13580501456',
            'user_id' => 3
        ));

        RegisterAccount::create(array(
            'name' => '胡琳',
            'age' => 22,
            'weight' => 60,
            'gender' => 1,
            'blood_type' => 'B型',
            'type' => '小伙子',
            'phone' => '13511222222',
            'id_card' => '442222199311112222',
            'emergency_name' => '壁鸿',
            'emergency_phone' => '13522333333',
            'user_id' => 2
        ));

        RegisterAccount::create(array(
            'name' => '嘉丽',
            'age' => 22,
            'weight' => 60,
            'gender' => 1,
            'blood_type' => 'AB型',
            'type' => '美女',
            'phone' => '13511111122',
            'id_card' => '443333199311112222',
            'emergency_name' => '壁鸿',
            'emergency_phone' => '13522222233',
            'user_id' => 1
        ));
    }
}