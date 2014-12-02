'use strict';

/* App Module */

var app = angular.module('app', ['appControllers'],
	function($interpolateProvider) 
    {
      $interpolateProvider.startSymbol('[[');
      $interpolateProvider.endSymbol(']]');
    }
);