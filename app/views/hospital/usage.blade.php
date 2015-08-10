
@extends('layouts.master')

@section('title')
    使用说明
@stop

@section('css')
    @parent
    <link rel="stylesheet" type="text/css" href="/dist/css/hospital/usage.css" />
@stop

@section('body-title')
    预约需知
@stop

@section('body-main')
    <ul>
        <li class="description li-base">
            1、预约时间 每天21:30前可预约第二日至第七日内所有出诊医师号。
        </li>
        <li class="description li-base">
            2、信息填写 预约挂号采用实名制，儿童挂号需填写监护人信息。
        </li>
        <li class="description li-base">
            3、如何取号 预约成功后，请在就诊当天凭身份证号码及预约流水号到门诊各楼层收款处预约取号
            要求预约就诊时间段15分钟之前完成挂号逾期未取号者，预约自动作废，号源将开放给现场患者。
        </li>
        <li class="description li-base">
            4、停诊安排 专家临时停诊时，医院负责安排同等级别专家出诊，系统自动取消原预约信息，并通过邮箱、短信、电话等方式 通知患者重新预约。
        </li>
        <li class="description li-base">
            5、取消预约 就诊前一天20:00之前输入患者姓名，身份证号码，预约时间及预约流水号取消预约。
        </li>
        <li class="description li-base">
            6、我们的网上预约保证您在所约的时间段内就诊，就诊顺序以实际挂号为准。
        </li>
        <li class="description li-base">
            7、预约成功后，请按时来院就诊。若预约成功后多次未按时来院，将被取消预约资格。 
        </li>
        <li class="description li-base">
            8、您还可以通过拨打预约挂号电话0898-65222333、65222666(日间)、门诊总服务台现场预约等途径进行预约挂号
        </li>
    </ul>
    
    <button id="register" class="btn">
        <a href="/register/select_department">开始预约挂号</a>
    </button>
@stop