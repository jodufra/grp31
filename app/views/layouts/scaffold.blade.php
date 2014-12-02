<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    {{ HTML::style('apiscss/bootstrap.min.css'); }}
    {{ HTML::style('apiscss/bootstrap-datepicker.css'); }}
    {{ HTML::style('css/layout.css'); }}
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <title>Yahtzee</title>
</head>
<body>
    <div id="fake-background">
        <div class="container"></div>
    </div>
    <nav class="navbar navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">
                    <span class=""><img alt="Yahtzee" src="{{asset('favicon.ico')}}"/>&nbspYahtzee</span>
                </a>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="#" data-target="#myModal" data-toggle="modal">Rules</a></li>
                    @if(Auth::check())
                    <li>{{ link_to('game','Play')}}</li>
                    @endif
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    @if (Auth::check())
                    <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->username}}<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="/user/show">My profile</a></li>
                            <li class="divider"></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                    @else
                    <li><a href="/user/create">Register</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Login<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @include('users.login_form')
                        </ul>
                    </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Rules</h4>
                </div>
                <div class="modal-body">
                    <div id="rules-page" class="inner-page">
                        @include('partials.rules')
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="content container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    @if(Session::has('message'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <ul>
                            <li class="success">
                                {{ Session::get('message') }}
                            </li>
                        </ul>
                    </div>
                    @endif
                    @if(Session::has('flash_notice'))
                    <div class="alert alert-warning">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <ul>
                            <li class="warning">
                                {{ Session::get('flash_notice') }}
                            </li>
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                @yield('body')
            </div>
        </div>

    </div>

    <!--Scripts -->

    {{ HTML::script('apisjs/jquery-2.1.0.min.js'); }}
    {{ HTML::script('apisjs/bootstrap.min.js'); }}
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.3/angular.min.js"></script>
    {{ HTML::script('js/app.js'); }}
    {{ HTML::script('js/animations.js'); }}
    {{ HTML::script('js/controllers.js'); }}
    {{ HTML::script('js/filters.js'); }}
    {{ HTML::script('js/services.js'); }}
    {{ HTML::script('js/datepicker.js'); }}
    {{ HTML::script('js/datepickerAtivate.js'); }}


</body>
</html>
