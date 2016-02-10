'use strict';

angular.module('geoServerApp')
  .config(function ($routeProvider) {
    $routeProvider
      .when('/category', {
        templateUrl: 'app/category/category.html',
        controller: 'CategoryController',
        controllerAs: 'main'
      })
      .when('/category/add', {
        templateUrl: 'app/category/edit/edit.html',
        controller: 'CategoryEditController',
        controllerAs: 'main'
      })
      .when('/category/edit/:id', {
        templateUrl: 'app/category/edit/edit.html',
        controller: 'CategoryEditController',
        controllerAs: 'main'
      });
  });
