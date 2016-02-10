'use strict';

angular.module('geoServerApp.auth', [
  'geoServerApp.constants',
  'geoServerApp.util',
  'ngCookies',
  'ngRoute'
])
  .config(function($httpProvider) {
    $httpProvider.interceptors.push('authInterceptor');
  });
