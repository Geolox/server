'use strict';

Object.defineProperty(exports, '__esModule', {
	value: true
});
var mongoose = require('bluebird').promisifyAll(require('mongoose'));

var CategorySchema = new mongoose.Schema({
	updated: { type: Date, 'default': Date.now },
	created: { type: Date, 'default': Date.now },
	name: String,
	short_name: String
});

exports['default'] = mongoose.model('Category', CategorySchema);
module.exports = exports['default'];
//# sourceMappingURL=category.model.js.map
