'use strict';

(function() {

class ReportController {

  constructor($http, $location, Report) {
    this.$http = $http;
    this.$location = $location;
    this.reports = [];
    this.reportService = Report;

    this.reportService.list().then(response => {
      this.reports = response.data;
    });
  }

  addReport(){
    this.$location.path('/report/add');
  }

  selectReport(report) {
      this.$location.path('/report/edit/' + report._id);
  }

  deleteReport(report) {
      this.reportService.delete(report)
      .then(this.reportService.list)
      .then(response => this.reports=response.data);
  }
}

angular.module('geoServerApp')
  .controller('ReportController', ReportController);

})();