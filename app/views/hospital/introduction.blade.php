@extends('layouts.master')

@section('title')
    医院信息
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/hospital/introduction.css" />
@stop

@section('body-title')
    医院简介
@stop

@section('body-main')
    <img class="hos-pic" src="/images/hospital_picture.png" alt="海口市妇幼保健院">

    <fieldset class="desc-bd">
        <legend class="desc-top">简介</legend>
        <p class="desc-content">
            海口市妇幼保健院始建于1951年11月，是一家集保健、医疗、科研、教学于一体的多功能三级妇幼保健机构。目前医院分为国兴总院和解放东分院，承担着海口市204万常驻人口、20万流动人口的妇幼保健任务，是全市的妇幼保健技术指导、业务培训中心、孕产妇保健基地、危急症孕产妇抢救中心及危重新生儿护理抢救中心。 
        </p>
        <p class="desc-content">    
            我院的专业技术力量雄厚，设备先进，目前开放床位400张，现有职工600多人，其中教授、主任医师10人，副教授、副主任医师51人，中级职称技术人员142人。医院设有10个临床专科（国兴产科、妇科、国兴儿内科、新生儿科、乳腺科、儿外科、麻醉科手术室、国兴门（急）诊、解放东妇产科、解放东儿科），6个保健科室（妇女保健科、儿童保健科、健康生殖科、妇幼信息科、儿童康复科、体检中心），4个医技科室（影像科、功能科、检验科和药剂科），年门诊30万余人次 ，住院人次近2万，固定资产逾亿元，是目前全省最具规模、现代化医疗水平的妇女儿童专科医院。30余万人口在我院出生。 
        </p>
        <p class="desc-content">    
            开展的主要业务有阴式全子宫切除术、腹腔镜手术、阴道成形术、超导可视人流、无痛人流、利普刀治疗宫颈疾病、早期乳腺癌的治疗、妊娠合并内科疾病治疗、胎儿远程监护、导乐分娩、无痛分娩、预防产后出血技术、新生儿急救、早产儿和极低体重儿的转运救治及护理、新生儿听力筛查、婴儿抚触、新生儿油浴、新生儿游泳、产后康复一条龙服务等项目。
        </p>
        <div class="desc-btm clearfix">
            <div class="line"></div>
            <div class="arrow-wrap">
                <img class="desc-btm-arrow" src="/images/arrow_down.png" />
            </div>
            <div class="line"></div>
        </div>
    </fieldset>
@stop