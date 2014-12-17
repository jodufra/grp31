<!-- Yatzhee Scripts -->
{{ HTML::script('js/datepicker.js'); }}
{{ HTML::script('js/datepickerAtivate.js'); }}
{{ HTML::script('js/scripts.js'); }}

<script src="https://grp31.dad:3000/socket.io/socket.io.js"></script>
<script>var socket = io('https://grp31.dad:3000');</script>

<!-- Angular Scripts 
{{ HTML::script('angular/angular_modules/angular-socket-io/mock/socket-io.js'); }}
-->
{{ HTML::script('angular/angular_modules/angular-socket-io/socket.js'); }}

{{ HTML::script('angular/services.js'); }}
{{ HTML::script('angular/controllers.js'); }}
{{ HTML::script('angular/app.js'); }}