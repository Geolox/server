'use strict';

describe('Service: report', function () {

  // load the service's module
  beforeEach(module('geoServerApp'));

  // instantiate service
  var report;
  beforeEach(inject(function (_report_) {
    report = _report_;
  }));

  it('should do something', function () {
    expect(!!report).to.be.true;
  });

});