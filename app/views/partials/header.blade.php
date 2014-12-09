<nav class="navbar navbar-inverse" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapseable-navbar-header">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">
                <span class=""><img alt="Yahtzee" src="{{asset('favicon.ico')}}"/>&nbsp;Yahtzee</span>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="collapseable-navbar-header">
            <ul class="nav navbar-nav">
                <li><a href="#" data-target="#rules-modal" data-toggle="modal">Rules</a></li>
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
                        @include('auth.login_form')
                    </ul>
                </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- Modal -->
<div class="modal fade" id="rules-modal" tabindex="-1" role="dialog" aria-labelledby="rules-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="rules-modal-label">Rules</h4>
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