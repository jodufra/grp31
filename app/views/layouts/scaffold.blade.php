<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="//code.jquery.com/jquery-2.1.1.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular-route.js"></script>
    {{ HTML::style('css/bootstrap-yeti.min.css'); }}
    {{ HTML::style('css/bootstrap-datepicker.css'); }}
    {{ HTML::style('css/font-awesome.min.css'); }}
    {{ HTML::style('css/style.css'); }}
    <title>Yahtzee</title>
</head>
<body>
    @include('partials.header')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                @include('partials.session_messages')
            </div>
            <div class="col-md-12 content">
                @yield('body')
            </div>
        </div>
    </div>

    <!-- Yatzhee Scripts -->
    {{ HTML::script('js/datepicker.js'); }}
    {{ HTML::script('js/datepickerAtivate.js'); }}
    {{ HTML::script('js/scripts.js'); }}

    <!-- Angular Scripts -->
    {{ HTML::script('angular/angular_modules/angular-socket-io/socket.js'); }}
    {{ HTML::script('angular/services.js'); }}
    {{ HTML::script('angular/controllers.js'); }}
    {{ HTML::script('angular/app.js'); }}
</body>
</html>
