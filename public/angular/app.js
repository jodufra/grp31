'use strict';

/* App Module */

var app = angular.module('app', ['appControllers', 'appServices']);
app.config(function($interpolateProvider) {
	$interpolateProvider.startSymbol('[[');
	$interpolateProvider.endSymbol(']]');
});