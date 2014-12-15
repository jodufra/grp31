<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @include('partials.scripts_bload')
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
            <div class="col-md-3 sidebar">
                @yield('sidebar')
            </div>
            <div class="col-md-9 content">
                @include('partials.session_messages')
                @yield('body')
            </div>
        </div>
    </div>
    @include('partials.scripts_aload')
</body>
</html>
