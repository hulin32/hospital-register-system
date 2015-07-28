<!DOCTYPE html>
<html>
    <head>
        <title>
            @section('title')
            @show
        </title>
        @section('css')
        <link rel="stylesheet" type="text/css" href="/dist/css/common.css" />
        <link rel="stylesheet" type="text/css" href="/dist/css/base.css" />
        @show
    </head>
    
    <body>
        <div class="bd-wrap">
            <h2 class="title">
                @section('body-title')
                @show
            </h2>
            
            @section('body-main')
            @show
        </div>

        @section('body-bottom')
        @show

        @section('js')
        @show
    </body>
</html>