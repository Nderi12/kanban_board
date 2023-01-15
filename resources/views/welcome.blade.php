<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <title>Kanban Board Project</title>

        <!-- Fonts -->
        <!--     Fonts and icons     -->
        <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
        <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        @vite([
            'resources/assets/css/nucleo-icons.css',
            'resources/assets/css/blk-design-system.css?v=1.0.0',
            'resources/assets/demo/demo.css',
        ])
    </head>
    <body class="index-page">
        <div id="app">
            <router-view></router-view>
        </div>
        @vite([
            'resources/js/app.js',
            'resources/assets/js/core/jquery.min.js',
            // 'resources/assets/js/core/popper.min.js',
            // 'resources/assets/js/core/bootstrap.min.js',
            // 'resources/assets/js/plugins/perfect-scrollbar.jquery.min.js',
            // 'resources/assets/js/plugins/bootstrap-switch.js',
            // 'resources/assets/js/plugins/nouislider.min.js',
            // 'resources/assets/js/plugins/chartjs.min.js',
            // 'resources/assets/js/plugins/moment.min.js',
            // 'resources/assets/js/plugins/bootstrap-datetimepicker.js',
            // 'resources/assets/demo/demo.js',
            // 'resources/assets/js/blk-design-system.min.js?v=1.0.0'
        ])
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    </body>
</html>
