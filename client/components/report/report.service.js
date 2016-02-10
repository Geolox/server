'use strict';

(function() {

var ReportService = function($http){
  var endpoint = '/api/reports/';
  return {
    add: function(report){
      return $http.post(endpoint,report);
    },
    list: function(){
      return $http.get(endpoint);
    },
    get: function(id){
      return $http.get(endpoint + id);
    },
    update: function(report){
      report.updated = Date.now();
      return $http.put(endpoint + report._id, report);
    },
    delete: function(report){
      return $http.delete(endpoint + report._id);
    }
  }
}


angular.module('geoServerApp.auth')
  .factory('Report', ReportService);

})();