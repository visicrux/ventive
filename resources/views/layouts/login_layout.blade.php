<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title")</title>
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('public/assets/images/icons.ico')}}"/>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/css/core.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
        <link href="{{asset('public/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
        
    </head>
    <body class="login-container">
        <div class="page-container">
            <!-- Page content -->
            <div class="page-content">
                    <!-- Main content -->
                    <div class="content-wrapper">
                        @yield("login")
                    </div>
            </div>
        </div>
        <!-- Page container -->
        
        <!-- Core JS files -->
        
        <script type="text/javascript" src="{{asset('public/assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/assets/js/core/libraries/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/nicescroll.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('public/assets/js/plugins/ui/drilldown.js')}}"></script>
	<!-- /core JS files -->


	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/core/app.js')}}"></script>

	<script type="text/javascript" src="assets/js/plugins/ui/ripple.min.js')}}"></script>
	<!-- /theme JS files -->
        
    </body>
</html>