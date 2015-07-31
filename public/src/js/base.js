
(function(){

    var browser = {
        versions: function(){
            var u = navigator.userAgent, 
                app = navigator.appVersion;
            
            return {
                trident: u.indexOf('Trident') > -1,                             //IE内核
                presto: u.indexOf('Presto') > -1,                               //opera内核
                webKit: u.indexOf('AppleWebKit') > -1,                          //苹果、谷歌内核
                gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1,     //火狐内核
                mobile: !!u.match(/AppleWebKit.*Mobile.*/),                     //是否为移动终端
                ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/),                //ios终端
                android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1,  //android终端或者uc浏览器
                iPhone: u.indexOf('iPhone') > -1 ,                              //是否为iPhone或者QQHD浏览器
                iPad: u.indexOf('iPad') > -1,                                   //是否iPad
                webApp: u.indexOf('Safari') == -1,                              //是否web应该程序，没有头部与底部
                weixin: u.indexOf('MicroMessenger') > -1,                       //是否微信 （2015-01-22新增）
                qq: u.match(/\sQQ/i) == " qq"                                   //是否QQ
            };
        }(),
        language:(navigator.browserLanguage || navigator.language).toLowerCase()
    }

    var user_scalable = 'no';
    var design_width = 320;
    var max_design_scale = 1.0;
    var screen_width = window.screen.width;
    var devicePixelRatio = window.devicePixelRatio;

    design_width *= 3;
    
    if ( browser.versions.ios ){
        design_width /= devicePixelRatio;
    }

    //alert( 'Screen width: ' + screen_width + ', devicePixelRatio: ' + devicePixelRatio );

    var initial_scale = screen_width / ( design_width * devicePixelRatio );
    var maximum_scale = screen_width * max_design_scale / ( design_width * devicePixelRatio );

    var meta_screen_adjust_info = '<meta name="viewport" content="width=device-width, initial-scale=' + 
                                  initial_scale + ', maximum-scale=' + maximum_scale + 
                                  ', user-scalable=' + user_scalable + '" />';

    $('head').append( meta_screen_adjust_info );
    //document.write( meta_screen_adjust_info );
    
    //alert( meta_screen_adjust_info );

})();