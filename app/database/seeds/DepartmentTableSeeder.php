<?php

class DepartmentTableSeeder extends Seeder {

    public function run()
    {
        DB::table( 'departments' )->delete();

        $common_test_para = '<p class="desc-para">
                                  简介：妇科拥有先进的医疗设备和雄厚的技术力量。
                                  设有不孕症、内窥镜、妇科内分泌、妇科肿瘤、妇科炎症等专科门诊。
                                  常年开展各种妇科疾病的诊治及手术，妇科肿瘤及诊治手术达省内最先进水平。
                              </p>
                              <p class="desc-para">
                                  科室现有一批从事妇科临床工作多年的专业医护人员队伍，其中副高职以上专业技术人员3人。
                                  全体医务人员以人性化服务为宗旨开展各种微创治疗，新式阴式手术及腹部手术腹腔镜下，宫腔镜下完成各种妇科疾病的治疗。
                              </p>';

        Department::create(array(
            'name' => '妇科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0001@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '普通门诊',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0002@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '乳腺科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0003@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '新生儿科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0004@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '儿外科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0005@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '儿内科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0006@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '分院儿内科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0007@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '麻醉手术室',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0008@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));

        Department::create(array(
            'name' => '分院妇产科',
            'photo' => '/images/hospital/detail.png',
            'icon' => '/images/hospital/0009@3x.png',
            'description' => $common_test_para,
            'hospital_id' => 1
        ));
    }
}