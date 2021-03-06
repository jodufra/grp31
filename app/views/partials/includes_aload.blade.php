<!-- Socket -->
<script src="http://grp31.dad:3000/socket.io/socket.io.js"></script>
<script>var socket = io.connect('http://grp31.dad:3000');</script>


<!-- Angular Global Constants -->
<script>
appConstants.constant('CSRF_TOKEN', '{{csrf_token()}}' );
</script>

<!-- Angular Controllers-->
{{ HTML::script('angular/controllers/user-controller.js'); }}
{{ HTML::script('angular/controllers/home-controller.js'); }}
{{ HTML::script('angular/controllers/chat-controller.js'); }}
{{ HTML::script('angular/controllers/tournament-controller.js'); }}
{{ HTML::script('angular/controllers/notifications-controller.js'); }}
{{ HTML::script('angular/controllers/countries-controller.js'); }}
{{ HTML::script('angular/controllers/game/home-controller.js'); }}
{{ HTML::script('angular/controllers/game/index-controller.js'); }}
{{ HTML::script('angular/controllers/game/create-controller.js'); }}
{{ HTML::script('angular/controllers/game/show-controller.js'); }}

<!-- Angular Services-->
{{ HTML::script('angular/services/chat-services.js'); }}
{{ HTML::script('angular/services/game-services.js'); }}
{{ HTML::script('angular/services/player-services.js'); }}
{{ HTML::script('angular/services/notification-services.js'); }}
{{ HTML::script('angular/services/spectator-services.js'); }}

<!--{{ HTML::script('angular/services.js'); }}-->


{{ HTML::script('js/scripts.js'); }}