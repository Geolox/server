'use strict';

var express = require('express');
var controller = require('./queue.controller');


var router = express.Router();

router.get('/start/:id', controller.start);
router.get('/stop/:id', controller.stop);
router.get('/refresh/:id', controller.refresh);
router.get('/consume/:id', controller.consume);

module.exports = router;
