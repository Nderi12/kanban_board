<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite([
            'resources/assets/vendors/morris.js/morris.css',
            'resources/assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.css',
            'resources/assets/vendors/jquery-toggles/css/themes/toggles-light.css',
            'resources/assets/dist/css/style.css',
        ])
        <title>USSD Channels</title>
    </head>
    <body>
        <!-- Preloader -->
        <div class="preloader-it">
            <div class="loader-pendulums"></div>
        </div>
        <!-- /Preloader -->

        <div id="app">
            <router-view></router-view>
        </div>
        
        @vite([
            'resources/js/app.js',
            'resources/assets/vendors/jquery/dist/jquery.min.js',
            'resources/assets/vendors/bootstrap/dist/js/bootstrap.min.js',
            'resources/assets/dist/js/jquery.slimscroll.js',
            'resources/assets/dist/js/dropdown-bootstrap-extended.js',
            'resources/assets/dist/js/feather.min.js',
            'resources/assets/vendors/waypoints/lib/jquery.waypoints.min.js',
            'resources/assets/vendors/jquery.counterup/jquery.counterup.min.js',
            'resources/assets/vendors/easy-pie-chart/dist/jquery.easypiechart.min.js',
            'resources/assets/vendors/morris.js/morris.min.js',
            'resources/assets/vendors/echarts/dist/echarts-en.min.js',
            'resources/assets/dist/js/init.js',
            'resources/assets/dist/js/dashboard2-data.js',

            'resources/assets/vendors/peity/jquery.peity.min.js',
            'resources/assets/vendors/jquery-toast-plugin/dist/jquery.toast.min.js',
        ])
    </body>
</html>
