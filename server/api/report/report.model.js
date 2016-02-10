'use strict';

var mongoose = require('bluebird').promisifyAll(require('mongoose'));

var Media = new mongoose.Schema({
    media_url:String,
    media_url_https:String,
    url:String,
    display_url:String,
    expanded_url:String,
    type:String
});

var ReportSchema = new mongoose.Schema({
    updated: Date,
    created: Date,
    category: {type: mongoose.Schema.Types.ObjectId, ref: 'Category'},
    report_datetime: Date,
    due_datetime: Date,
    closed_datetime: Date,
    description: String,
    media:[Media],
    user: String,
    moderator: {type: mongoose.Schema.Types.ObjectId, ref: 'User'},
    loc: { type: [Number], index: '2dsphere'}
});

export default mongoose.model('Report', ReportSchema);
