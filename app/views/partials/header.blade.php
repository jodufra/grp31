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
                    <span data-toggle="tooltip" data-placement="bottom" title="Online Friend List">
                        <span class="glyphicon glyphicon-user"></span>&nbsp;
                        <span class="badge" ng-bind="onlineFriends().length"></span>
                        <span class="caret"></span>
                    </span>
                </a>
                <ul ng-if="started" class="dropdown-menu dropdown-autoclose-prevented" role="menu">
                    <li class="text-center" ng-if="!haveOnlineFriends()">No Friends Online!</li>
                    <li ng-if="onlineFriends().length > 4">
                        <input type="text" placeholder="Search" ng-model="searchText">  
                    </li>
                    <li ng-repeat="friend in onlineFriends() | filter:searchText">
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
                    <li>
                        <div class="clearfix">
                            <input style="width: 100%" type="text" placeholder="Friend Name" ng-model="friendRequestName">
                        </div>
                        <div class="btn-group btn-group-single">
                            <a href="#" ng-click="sendFriendRequest()" class="warning">
                                <span class="glyphicon glyphicon-plus"></span><span>&nbsp;Add Friend</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- Notifications List -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" >
                    <span data-toggle="tooltip" data-placement="bottom" title="Notifications">
                        <span class="glyphicon glyphicon-inbox"></span>&nbsp;
                        <span class="badge" ng-bind="notificationsCount()"></span>
                        <span class="caret"></span>
                    </span>
                </a>
                <ul ng-if="started" class="dropdown-menu dropdown-autoclose-prevented" role="menu">
                    <li class="text-center" ng-if="!haveNotifications()">Your Inbox is Empty!</li>
                    <li ng-repeat="notification in getNormalNotifications()">
                        <p ng-bind="notification.text"></p>
                        <div class="btn-group btn-group-single clearfix">
                            <a href="#" ng-click="dismiss([[notification]])" class="danger">
                                <span class="glyphicon glyphicon-remove"></span><span>&nbsp;Dismiss</span>
                            </a>
                        </div>
                    </li>
                    <li ng-repeat="request in getGameNotifications()">
                        <p>User <a href="/user/[[request.user.name]]">[[request.user.name]]</a> has invited you to join his game</p>
                        <div class="btn-group btn-group clearfix">
                            <a href="#" ng-click="acceptGameInvite([[request]])" class="success">
                                <span class="glyphicon glyphicon-check"></span><span>&nbsp;Accept</span>
                            </a>
                            <a href="#" ng-click="dismissGameInvite([[request]])" class="danger">
                                <span class="glyphicon glyphicon-remove"></span><span>&nbsp;Ignore</span>
                            </a>
                        </div>
                    </li>
                    <li ng-repeat="request in getFriendNotifications()">
                        <p>User <a href="/user/[[request.user.name]]">[[request.user.name]]</a> wants to add you to his friends list</p>
                        <div class="btn-group btn-group clearfix">
                            <a href="#" ng-click="acceptFriendRequest([[request]])" class="success">
                                <span class="glyphicon glyphicon-check"></span><span>&nbsp;Accept</span>
                            </a>
                            <a href="#" ng-click="dismiss([[request]])" class="danger">
                                <span class="glyphicon glyphicon-remove"></span><span>&nbsp;Ignore</span>
                            </a>
                        </div>
                    </li>
                </ul>
            </li>

            <!-- User -->
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <span><img class="portrait" style="width:14px; height:14px;" src="{{ $person->photo}}" alt="">&nbsp;{{ $person->name}}</span>
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="/user/{{Auth::user()->username}}"><span class="glyphicon glyphicon-eye-open"></span>&nbsp;&nbsp;&nbsp;My profile</a></li>
                    <li><a href="/logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;&nbsp;&nbsp;Logout</a></li>
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
<!-- Rules Modal -->
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