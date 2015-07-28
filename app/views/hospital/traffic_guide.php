<?php

require_once "jssdk.php";
require_once "SaeDataStorageWrapper.php";

$appId = "wx8a975fb1e046442e";
$appSecret = "3698bdf9bdcf8cffeb1d0c87953503f7";

$jssdk = new JSSDK( $appId, $appSecret, new SaeDataStorageWrapper() );
$signPackage = $jssdk->getSignPackage();

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Map</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <link rel="stylesheet" type="text/css" href="dist/css/common.css" />
        <link rel="stylesheet" type="text/css" href="dist/css/map.css" />
        <script src="http://libs.baidu.com/jquery/2.0.0/jquery.min.js"></script>
        <script type="text/javascript" src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
        <script type="text/javascript" src="http://api.map.baidu.com/api?type=quick&v=1.0&ak=iG2mRPwyHcIDiYc25f1PudGC"></script>
        <script type="text/javascript">
            
            $(document).ready(function(){
                var map_width = parseInt( $("#baidu-map").css( "width" ) );
                $("#baidu-map").css( "height", map_width * 0.65 + "px" );
                
                wx.config( {
                    debug: false,
                    appId: '<?php echo $appId; ?>',
                    timestamp: '<?php echo $signPackage["timestamp"]; ?>',
                    nonceStr: '<?php echo $signPackage["nonce_str"]; ?>',
                    signature: '<?php echo $signPackage["signature"]; ?>',
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
    </head>
    
    <body>
        <div class="bd-wrap">
            <h2 class="title"><img src="icon/location_flag.png">当前定位：<span id="current-pos">无</span></h2>
            
            <div class="map-wrap">
                <div id="baidu-map"></div>
            </div>
            
            <div class="para-wrap">
                <p class="para">
                    位于海口市解放东路15号（和平影城对面）。分院始建于1951年，
                    是一所有着几十年历史的老院，已有30多万人口在这里降生，
                    医院环境温馨、交通便利、以精湛的医疗位于海口市解放东路15号（和平影城对面）。
                    分院始建于1951年，是一所有着几十年历史的老院，
                    已有30多万人口在这里降生，医院环境温馨、交通便利、
                    以精湛的医疗技术和贴心服务成为海口市广大妇女儿童的惠民医院。
                </p>
                <p class="para">
                    经过解放东分院的公交车有：2路、4路、5路、8路、25路、26路。
                </p>
                <p class="para">
                    联系电话：0898-66111120
                </p>
            </div>
            
        </div>
    </body> 
</html>


