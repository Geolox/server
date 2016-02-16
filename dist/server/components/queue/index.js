'use strict';

var util = require('util');
var config = require('./config.js');
var database = require('./database.js')(config.db);
var twitter = require('./twitter.js')(config.twitter);
var queue = require('./queue.js')(config.queue);
var p = require('./prioritizer.js');
var m = require('./message.js');
var i18n = require('./en.i18n.js');

var manual_stop = false;
var auto_start = true;
var chords = [];
var message = {};
var queues = [];
var root = "";

var ondata = function ondata(tweet) {
    var q = p.prioritize(tweet.text, chords, root);
    if (q) {
        var str_tweet = m.process(tweet);
        queue.enqueue(q, str_tweet);
    }
};

var onend = function onend(event_data) {
    if (!manual_stop && auto_start) {
        process.send({ event: { type: "info" }, data: { message: i18n.AUTO_STARTING } });
        start(message.data.user);
    }
    if (manual_stop) {
        process.send({ event: { type: "info" }, data: { message: i18n.MANUALLY_STOPPED } });
    }
};

var stream = function stream(pattern) {
    load_keywords(pattern);
    twitter.start_stream(pattern.root, ondata, onend);
};

process.on('message', function (m) {
    message = m;
    switch (m.event.type) {
        case 'start':
            start(m.data.user);
            break;
        case 'stop':
            stop(m.data.user);
            break;
        case 'refresh':
            refresh(m.data.user);
            break;
        case 'consume':
            consume(m.data.user);
            break;
        default:
            process.send({ event: { type: "info" }, data: { message: i18n.UNKNOWN_EVENT } });
    }
});

var load_keywords = function load_keywords(pattern) {
    chords = pattern.chords;
    root = pattern.root;
    queues.push(root);
    for (var i = chords.length - 1; i >= 0; i--) {
        queues.push(chords[i].chord);
    }
    process.send({ event: { type: "info" }, data: { message: i18n.NOW_LISTENING_TO + root } });
    process.send({ event: { type: "info" }, data: { message: i18n.QUEUES + JSON.stringify(queues) } });
};

var start = function start(user) {
    process.send({ event: { type: "info" }, data: { message: i18n.STARTING } });
    manual_stop = false;
    database.get_pattern(user).then(stream);
};

var stop = function stop(user) {
    process.send({ event: { type: "info" }, data: { message: i18n.STOPPING } });
    manual_stop = true;
    twitter.stop_stream();
};

var refresh = function refresh(user) {
    process.send({ event: { type: "info" }, data: { message: i18n.REFRESHING } });
    database.get_pattern(user).then(load_keywords);
};

var consume = function consume(user) {
    process.send({ event: { type: "info" }, data: { message: i18n.CONSUMING } });
    database.get_pattern(user).then(load_keywords).then(function () {
        for (var i = queues.length - 1; i >= 0; i--) {
            queue.consume(queues[i], process_tweet);
        };
    });
};

var process_tweet = function process_tweet(message) {
    process.send({ event: { type: "message" }, data: { message: message } });
};
//# sourceMappingURL=index.js.map
