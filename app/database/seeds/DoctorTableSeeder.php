<?php

class DoctorTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'doctors' )->delete();

        $common_specialty = '<p>
                                专业特长：妇科腹腔镜、宫腔镜微创肿瘤切除手术，腹腔镜治疗不孕症手术。阴式            微创子宫切除术及各类妇科产科阴暗危重病症。
                                妇科内分泌疾病与生殖内分泌。
                            </p>';

        $common_description = '<p>
                                  葛菲，女，院长助理兼妇科主任，主任医师，留美归国学着。
                                  中华医学会海南省分会妇产科专业委员会常务委员，省医学会医疗事  故、司法医学，计划生育医疗技术鉴定专家。
                                  先后获得海口市科技进步奖一等奖和二等奖，海南省科技进步四等奖  。
                                  已经主持完成海口市重点科技计划项目一项，目前主持海口市重点科  技计划项目一项。
                              </p>';

        Doctor::create(array(
            'name' => '葛菲',
            'photo' => '/images/hospital/doc_pic.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => true,
            'is_consultable' => true,
            'department_id' => 1,
            'title_id' => 1
        ));

        Doctor::create(array(
            'name' => '王磊',
            'photo' => '/images/hospital/doc.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => false,
            'is_consultable' => false,
            'department_id' => 1,
            'title_id' => 2
        ));

        Doctor::create(array(
            'name' => '葛天',
            'photo' => '/images/hospital/doc_pic.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => true,
            'is_consultable' => true,
            'department_id' => 2,
            'title_id' => 1
        ));

        Doctor::create(array(
            'name' => '张三',
            'photo' => '/images/hospital/doc.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => false,
            'is_consultable' => true,
            'department_id' => 2,
            'title_id' => 2
        ));

        Doctor::create(array(
            'name' => '李四',
            'photo' => '/images/hospital/doc.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => true,
            'is_consultable' => true,
            'department_id' => 6,
            'title_id' => 1
        ));

        Doctor::create(array(
            'name' => '王五',
            'photo' => '/images/hospital/doc.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => false,
            'is_consultable' => true,
            'department_id' => 6,
            'title_id' => 2
        ));

        Doctor::create(array(
            'name' => '嘉丽',
            'photo' => '/images/hospital/doc_pic.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => true,
            'is_consultable' => false,
            'department_id' => 8,
            'title_id' => 1
        ));

        Doctor::create(array(
            'name' => '阿登',
            'photo' => '/images/hospital/doc.png',
            'specialty' => $common_specialty,
            'description' => $common_description,
            'is_chief' => false,
            'is_consultable' => true,
            'department_id' => 8,
            'title_id' => 2
        ));
    }
}