/* App Module */

var app = angular.module('app', ['ngAnimate', 'timer', 'appControllers', 'appServices']);
app.config(function($interpolateProvider) {
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');
});

var appConstants = angular.module('appConstants', []);
var appServices = angular.module('appServices', []);
var appControllers = angular.module('appControllers', ['ngSanitize','appConstants']);

app.directive('animateOnChange', function($animate) {
	return function(scope, elem, attr) {
		elem.addClass("animated-on-change");
		scope.$watch(attr.animateOnChange, function(nv, ov) {
			if (nv != ov) {
				$animate.addClass(elem, 'flash').then(function() {
					elem.removeClass('flash');
				});
			}
		});  
	}  
});
app.filter('range', function() {
	return function(input, total) {
		total = parseInt(total);
		for (var i = 0; i < total; i++){
			input.push(i);
		}
		return input;
	};
});