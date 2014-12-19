<!-- Socket -->
<script src="https://grp31.dad:3000/socket.io/socket.io.js"></script>
<script>var socket = io.connect('https://grp31.dad:3000');</script>

<!-- Angular -->
<script>
var appConstants = angular.module('appConstants',[]);
appConstants.constant('CSRF_TOKEN', '{{csrf_token()}}' );
</script>
{{ HTML::script('angular/services.js'); }}
{{ HTML::script('angular/controllers.js'); }}
{{ HTML::script('angular/app.js'); }}


{{ HTML::script('js/scripts.js'); }}