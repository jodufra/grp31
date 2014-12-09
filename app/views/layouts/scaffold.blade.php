<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular.min.js"></script>
    <script src="//code.angularjs.org/1.3.5/angular-route.min.js"></script>
    {{ HTML::style('css/bootstrap-yeti.min.css'); }}
    {{ HTML::style('css/bootstrap-datepicker.css'); }}
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

    <!--Scripts -->
    {{ HTML::script('js/datepicker.js'); }}
    {{ HTML::script('js/datepickerAtivate.js'); }}
    {{ HTML::script('js/scripts.js'); }}
    {{ HTML::script('js/services.js'); }}
    {{ HTML::script('js/controllers.js'); }}
    {{ HTML::script('js/app.js'); }}
</body>
</html>
