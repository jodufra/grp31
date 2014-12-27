<!-- Socket -->
<script src="https://grp31.dad:3000/socket.io/socket.io.js"></script>
<script>var socket = io.connect('https://grp31.dad:3000');</script>


<!-- Angular Config -->
{{ HTML::script('angular/app.js'); }}

<!-- Angular Constants -->
<script>
appConstants.constant('CSRF_TOKEN', '{{csrf_token()}}' );
</script>

<!-- Angular Controllers-->
{{ HTML::script('angular/controllers/home-controller.js'); }}
{{ HTML::script('angular/controllers/chat-controller.js'); }}
{{ HTML::script('angular/controllers/notifications-controller.js'); }}
{{ HTML::script('angular/controllers/game/home-controller.js'); }}
{{ HTML::script('angular/controllers/game/index-controller.js'); }}
{{ HTML::script('angular/controllers/game/create-controller.js'); }}
{{ HTML::script('angular/controllers/game/play-controller.js'); }}

<!-- Angular Services-->
{{ HTML::script('angular/services/chat-services.js'); }}
{{ HTML::script('angular/services/game-services.js'); }}
{{ HTML::script('angular/services/player-services.js'); }}

<!--{{ HTML::script('angular/services.js'); }}-->


{{ HTML::script('js/scripts.js'); }}