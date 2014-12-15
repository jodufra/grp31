<script type="text/javascript" src="//code.jquery.com/jquery-2.1.1.js"></script>
<script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.js"></script>
<script type="text/javascript" src="//code.angularjs.org/1.3.5/angular.js"></script>
<script type="text/javascript" src="//code.angularjs.org/1.3.5/angular-route.js"></script>
<script type="text/javascript" src="//code.angularjs.org/1.3.5/angular-sanitize.js"></script>
<script>
var appConstants = angular.module('appConstants',[]);
appConstants.constant('CSRF_TOKEN', '{{csrf_token()}}' );
</script>