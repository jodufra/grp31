<!doctype html>
<html lang="en" ng-app="app">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    {{ HTML::style('apiscss/bootstrap-yeti.min.css'); }}
    {{ HTML::style('apiscss/bootstrap-datepicker.css'); }}
    {{ HTML::style('css/layout.css'); }}
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
                    <span class=""><img alt="Yahtzee" src="{{asset('favicon.ico')}}"/>&nbsp;Yahtzee</span>
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
                <div class="col-md-8 col-md-offset-2">
                    <div class="container-fluid">
                        @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <ul>
                                <li class="success">
                                    {{ Session::get('success') }}
                                </li>
                            </ul>
                        </div>
                        @endif
                        @if(Session::has('info'))
                        <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <ul>
                                <li class="info">
                                    {{ Session::get('info') }}
                                </li>
                            </ul>
                        </div>
                        @endif
                        @if(Session::has('warning'))
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <ul>
                                <li class="warning">
                                    {{ Session::get('warning') }}
                                </li>
                            </ul>
                        </div>
                        @endif
                        @if(Session::has('danger'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <ul>
                                <li class="danger">
                                    {{ Session::get('danger') }}
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
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

   <!--  For the days were everything else fails --><!--
   {{ HTML::script('apisjs/jquery-2.1.0.min.js'); }}
   {{ HTML::script('apisjs/bootstrap.min.js'); }}
   {{ HTML::script('apisjs/angular.min.js'); }}  -->

   <script src="//code.jquery.com/jquery-2.1.1.min.js"></script>
   <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
   <script src="//code.angularjs.org/1.3.5/angular.min.js"></script>
   <script src="//code.angularjs.org/1.3.5/angular-route.min.js"></script>
   {{ HTML::script('js/datepicker.js'); }}
   {{ HTML::script('js/datepickerAtivate.js'); }}
   {{ HTML::script('js/scripts.js'); }}
   {{ HTML::script('js/controllers.js'); }}
   {{ HTML::script('js/app.js'); }}


</body>
</html>
