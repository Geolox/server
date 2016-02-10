'use strict';

(function() {

	class CategoryEditController {

		constructor($http, $location, $routeParams, $q, Category){
			var that = this;
			this.categoryId = $routeParams.id;
			this.$http = $http;
			this.$location = $location;
			this.category = {};
			this.categoryService = Category;

			if(this.categoryId && this.categoryId.length > 0) {
				this.categoryService.get(this.categoryId)
				.then(res => {
					that.category = res.data;
				})
				.catch(err => {
		          return $q.reject(err.data);
		        });
			}
		}
		saveItem () {
	        if(this.categoryId && this.categoryId.length > 0) {
	        	this.categoryService.update(this.category)
	        	.then(res => {
	        		this.$location.path('/category')
	        	})
	        	.catch(err => {
		          return $q.reject(err.data);
		        });
	        }
	        else {
				this.categoryService.add(this.category)
	        	.then(res => {
	        		this.$location.path('/category')
	        	})
	        	.catch(err => {
		          return $q.reject(err.data);
		        });
	        }
    	}
	}
angular.module('geoServerApp')
  .controller('CategoryEditController', CategoryEditController);

})();