'use strict';

(function() {

	class ReportEditController {

		constructor($http, $location, $routeParams, $q, Report, Category){
			var that = this;
			this.reportId = $routeParams.id;
			this.$http = $http;
			this.$location = $location;
			this.report = {};
			this.reportService = Report;
			this.categories = [];
		    this.categoryService = Category;

		    this.categoryService.list().then(response => {
		      this.categories = response.data;
		    });

			if(this.reportId && this.reportId.length > 0) {
				this.reportService.get(this.reportId)
				.then(res => {
					that.report = res.data;
				})
				.catch(err => {
		          return $q.reject(err.data);
		        });
			}
		}
		saveItem () {
	        if(this.reportId && this.reportId.length > 0) {
	        	this.reportService.update(this.report)
	        	.then(res => {
	        		this.$location.path('/report')
	        	})
	        	.catch(err => {
		          return $q.reject(err.data);
		        });
	        }
	        else {
				this.reportService.add(this.report)
	        	.then(res => {
	        		this.$location.path('/report')
	        	})
	        	.catch(err => {
		          return $q.reject(err.data);
		        });
	        }
    	}
	}
angular.module('geoServerApp')
  .controller('ReportEditController', ReportEditController);

})();