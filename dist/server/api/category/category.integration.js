'use strict';

var _interopRequireDefault = require('babel-runtime/helpers/interop-require-default')['default'];

var _supertest = require('supertest');

var _supertest2 = _interopRequireDefault(_supertest);

var app = require('../..');

var newCategory;

describe('Category API:', function () {

  describe('GET /api/categories', function () {
    var categorys;

    beforeEach(function (done) {
      (0, _supertest2['default'])(app).get('/api/categories').expect(200).expect('Content-Type', /json/).end(function (err, res) {
        if (err) {
          return done(err);
        }
        categorys = res.body;
        done();
      });
    });

    it('should respond with JSON array', function () {
      expect(categorys).to.be.instanceOf(Array);
    });
  });

  describe('POST /api/categories', function () {
    beforeEach(function (done) {
      (0, _supertest2['default'])(app).post('/api/categories').send({
        name: 'New Category',
        info: 'This is the brand new category!!!'
      }).expect(201).expect('Content-Type', /json/).end(function (err, res) {
        if (err) {
          return done(err);
        }
        newCategory = res.body;
        done();
      });
    });

    it('should respond with the newly created category', function () {
      expect(newCategory.name).to.equal('New Category');
      expect(newCategory.info).to.equal('This is the brand new category!!!');
    });
  });

  describe('GET /api/categories/:id', function () {
    var category;

    beforeEach(function (done) {
      (0, _supertest2['default'])(app).get('/api/categories/' + newCategory._id).expect(200).expect('Content-Type', /json/).end(function (err, res) {
        if (err) {
          return done(err);
        }
        category = res.body;
        done();
      });
    });

    afterEach(function () {
      category = {};
    });

    it('should respond with the requested category', function () {
      expect(category.name).to.equal('New Category');
      expect(category.info).to.equal('This is the brand new category!!!');
    });
  });

  describe('PUT /api/categories/:id', function () {
    var updatedCategory;

    beforeEach(function (done) {
      (0, _supertest2['default'])(app).put('/api/categories/' + newCategory._id).send({
        name: 'Updated Category',
        info: 'This is the updated category!!!'
      }).expect(200).expect('Content-Type', /json/).end(function (err, res) {
        if (err) {
          return done(err);
        }
        updatedCategory = res.body;
        done();
      });
    });

    afterEach(function () {
      updatedCategory = {};
    });

    it('should respond with the updated category', function () {
      expect(updatedCategory.name).to.equal('Updated Category');
      expect(updatedCategory.info).to.equal('This is the updated category!!!');
    });
  });

  describe('DELETE /api/categories/:id', function () {

    it('should respond with 204 on successful removal', function (done) {
      (0, _supertest2['default'])(app)['delete']('/api/categories/' + newCategory._id).expect(204).end(function (err, res) {
        if (err) {
          return done(err);
        }
        done();
      });
    });

    it('should respond with 404 when category does not exist', function (done) {
      (0, _supertest2['default'])(app)['delete']('/api/categories/' + newCategory._id).expect(404).end(function (err, res) {
        if (err) {
          return done(err);
        }
        done();
      });
    });
  });
});
//# sourceMappingURL=category.integration.js.map
