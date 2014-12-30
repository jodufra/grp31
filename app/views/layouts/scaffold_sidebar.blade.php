<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @include('partials.includes_bload')
    <title>Yahtzee</title>
</head>
<body>
    <div class="hidden" ng-controller="UserController"></div>
    <div id="sidebar">
        @yield('sidebar')
    </div>
    <div id="content">
        <?php $has_sidebar = true;?>
        @include('partials.header')
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 ">
                    @include('partials.session_messages')
                    @yield('body')
                </div>
            </div>
        </div>
    </div>
    @include('partials.chat')
    @include('partials.includes_aload')
</body>
</html>
