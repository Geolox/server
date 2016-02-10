'use strict';

var mongoose = require('bluebird').promisifyAll(require('mongoose'));

var CategorySchema = new mongoose.Schema({
	updated: {type: Date, default: Date.now},
	created: {type: Date, default: Date.now},
	name: String,
	short_name: String
});

export default mongoose.model('Category', CategorySchema);
