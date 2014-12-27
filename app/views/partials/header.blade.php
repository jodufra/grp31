<nav class="navbar navbar-static-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" style="color:white;" data-toggle="collapse" data-target="#collapseable-navbar-header">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        @if(!isset($has_sidebar))
        <a class="navbar-brand" href="/">
            <span>
                <img alt="" class="portrait portrait-xs" src="/favicon.ico"/>&nbsp;Yahtzee
            </span>
        </a>
        @endif
    </div>
    <div class="collapse navbar-collapse" id="collapseable-navbar-header">
        @if(!isset($has_sidebar))
        <ul class="nav navbar-nav">
            <li><a href="#" data-target="#rules-modal" data-toggle="modal">Rules</a></li>
        </ul>
        @endif
        <ul class="nav navbar-nav navbar-right" ng-controller="NotificationsController">
            @if (Auth::check())
            <?php $person = Auth::user()->person()->first();?>
            <!-- Friend List -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-user"></span>&nbsp;<span class="badge">0</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu dropdown-autoclose-prevented" role="menu">
                    <li ng-if="!haveOnlineFriends()"></li>
                    <li ng-repeat="friend in onlineFriends">
                        <div class="media">
                            <div class="media-left media-middle">
                                <img src="[[friend.img_src]]" alt="" class="portrait portrait-s" style="height:100%">
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading" ng-bind="friend.name"></h4>
                                <div class="btn-group clearfix">
                                    <a href="/user/[[friend.name]]" class="success" data-toggle="tooltip" data-placement="top" title="View Profile">
                                        <span class="glyphicon glyphicon-eye-open"></span>
                                    </a>
                                    <a href="#" ng-click="sendMessageToFriend([[friend.name]])" class="info" data-toggle="tooltip" data-placement="top" title="Send Message">
                                        <span class="glyphicon glyphicon-envelope"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <span>Invite Friend</span>
                        <div>
                            <input style="width: 70%" class="pull-left" type="text" placeholder="Friend Name" ng-bind="newFriendName" ng-click="inviteNewFriend()">
                            <button style="width: 30%" class="pull-left" >Invite</button>
                        </div>
                    </li>
                </ul>
            </li>
            <!-- Notifications List -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span class="glyphicon glyphicon-bell"></span>&nbsp;<span class="badge">0</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li ng-if="!haveNotifications()"></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Logout</a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span><img class="portrait" style="width:14px; height:14px;" src="{{ $person->photo}}" alt="">&nbsp;{{ $person->name}}</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="/user/{{Auth::user()->username}}">My profile</a></li>
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
    </div>
</nav>
<!-- Rules -->
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