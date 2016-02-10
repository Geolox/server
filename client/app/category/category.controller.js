'use strict';

(function() {

class CategoryController {

  constructor($http, $location, Category) {
    this.$http = $http;
    this.$location = $location;
    this.categories = [];
    this.categoryService = Category;

    this.categoryService.list().then(response => {
      this.categories = response.data;
    });
  }

  addCategory(){
    this.$location.path('/category/add');
  }

  selectCategory(category) {
      this.$location.path('/category/edit/' + category._id);
  }

  deleteCategory(category) {
      this.categoryService.delete(category)
      .then(this.categoryService.list)
      .then(response => this.categories=response.data);
  }
}

angular.module('geoServerApp')
  .controller('CategoryController', CategoryController);

})();