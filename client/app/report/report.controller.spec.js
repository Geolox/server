'use strict';

describe('Controller: ReportCtrl', function () {

  // load the controller's module
  beforeEach(module('geoServerApp'));

  var ReportCtrl, scope;

  // Initialize the controller and a mock scope
  beforeEach(inject(function ($controller, $rootScope) {
    scope = $rootScope.$new();
    ReportCtrl = $controller('ReportCtrl', {
      $scope: scope
    });
  }));

  it('should ...', function () {
    expect(1).to.equal(1);
  });
});
