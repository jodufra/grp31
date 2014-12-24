<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @include('partials.includes_bload')
    <title>Yahtzee</title>
</head>
<body>
    @include('partials.header')
    <div class="wrapper">
        <div id="sidebar" class=" pull-left">
            @yield('sidebar')
        </div>
        <div id="content" class='pull-left'>
            <div style="width:100%;">
                <div class="container ">
                    <div class="row">
                        <div class="col-md-12 ">
                            @include('partials.session_messages')
                            @yield('body')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('partials.includes_aload')
</body>
</html>
