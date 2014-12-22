/* App Module */

var app = angular.module('app', ['appControllers', 'appServices']);
app.config(function($interpolateProvider) {
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');
});

var appConstants = angular.module('appConstants', []);
var appServices = angular.module('appServices', []);
var appControllers = angular.module('appControllers', ['ngSanitize','appConstants']);