'use strict';

angular.module('geoServerApp')
  .config(function ($routeProvider) {
    $routeProvider
      .when('/report', {
        templateUrl: 'app/report/report.html',
        controller: 'ReportController',
        controllerAs: 'main'
      })
      .when('/report/add', {
        templateUrl: 'app/report/edit/edit.html',
        controller: 'ReportEditController',
        controllerAs: 'main'
      })
      .when('/report/edit/:id', {
        templateUrl: 'app/report/edit/edit.html',
        controller: 'ReportEditController',
        controllerAs: 'main'
      });
  });
