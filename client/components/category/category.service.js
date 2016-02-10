'use strict';

(function() {

var CategoryService = function($http){
  var endpoint = '/api/categories/';
  return {
    add: function(category){
      return $http.post(endpoint,category);
    },
    list: function(){
      return $http.get(endpoint);
    },
    get: function(id){
      return $http.get(endpoint + id);
    },
    update: function(category){
      category.updated = Date.now();
      return $http.put(endpoint + category._id, category);
    },
    delete: function(category){
      return $http.delete(endpoint + category._id);
    }
  }
}


angular.module('geoServerApp.auth')
  .factory('Category', CategoryService);

})();