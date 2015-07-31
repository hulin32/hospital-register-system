@extend('layouts.master')

@section('title')
    查看地图
@stop

@section('css')
    <link rel="stylesheet" type="text/css" href="dist/css/common.css" />
    <link rel="stylesheet" type="text/css" href="dist/css/map.css" />
@stop

@section('js')
    <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
    <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&v=1.0&ak=iG2mRPwyHcIDiYc25f1PudGC"></script>
    <script type="text/javascript">
        
        $(document).ready(function(){
            var map_width = parseInt( $("#baidu-map").css( "width" ) );
            $("#baidu-map").css( "height", map_width * 0.65 + "px" );
            
            wx.config( {
                debug: false,
                appId: '{{{ $app_id }}}',
                timestamp: '{{{ $sign_package["timestamp"] }}}',
                nonceStr: '{{{ $sign_package["nonce_str"] }}}',
                signature: '{{{ $sign_package["signature"] }}}',
                jsApiList: [
                    "getLocation"
                ]
            });
            
            wx.ready(function(){
                wx.getLocation({
                    type: 'wgs84',
                    success: function( response ){
                        var map_level = 16;
                        var map = new BMap.Map("baidu-map");
                        map.centerAndZoom( new BMap.Point( response.longitude, response.latitude ), map_level );
                        var my_geo = new BMap.Geocoder();
                        my_geo.getLocation( 
                            new BMap.Point( response.longitude, response.latitude ),
                            function( result ){
                                if ( result ){
                                    $("#current-pos").html( result.address );
                                }
                            }
                        );
                    }
                });
            });
        });
        
    </script>
@stop

@section('body-title')
    <img src="icon/location_flag.png">当前定位：<span id="current-pos">无</span>
@stop

@section('body-main')
    <div class="para-wrap">
        {{{ $traffice_intro }}}
        {{{ $traffic_guide }}}
        <p>
            联系电话：{{{ $phone }}}
        </p>
    </div>
@stop


