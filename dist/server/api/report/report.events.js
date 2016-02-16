/**
 * Report model events
 */

'use strict';

Object.defineProperty(exports, '__esModule', {
  value: true
});

var _events = require('events');

var Report = require('./report.model');
var ReportEvents = new _events.EventEmitter();

// Set max event listeners (0 == unlimited)
ReportEvents.setMaxListeners(0);

// Model events
var events = {
  'save': 'save',
  'remove': 'remove'
};

// Register the event emitter to the model events
for (var e in events) {
  var event = events[e];
  Report.schema.post(e, emitEvent(event));
}

function emitEvent(event) {
  return function (doc) {
    ReportEvents.emit(event + ':' + doc._id, doc);
    ReportEvents.emit(event, doc);
  };
}

exports['default'] = ReportEvents;
module.exports = exports['default'];
//# sourceMappingURL=report.events.js.map
