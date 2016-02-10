'use strict';
var Report = require('../report/report.model');
const child_process = require("child_process").fork("server/components/queue/index.js", [], { execArgv: ['--debug=5859'] });
const consumer = require("child_process").fork("server/components/queue/index.js", [], { execArgv: ['--debug=5860'] });

child_process.on('message', function(response) {
    switch(response.event.type){
        case 'info':
            console.log(response.data.message);
            break;
        default:
            console.log("Unknown event type:" + response.event.type);
    }
});

consumer.on('message', function(response) {
    switch(response.event.type){
        case 'info':
            console.log(response.data.message);
            break;
        case 'message':
            var report = translateTweet(JSON.parse(response.data.message),true,false);
            if (report){
              var r = new Report();
              for(var i in report){
                r[i]=report[i];
              }
              r.save(function (err) {
                if (err) console.log(err);
              });
            }

            break;
        default:
            console.log("Unknown event type:" + response.event.type);
    }
});

function handleError(res, statusCode) {
  statusCode = statusCode || 500;
  return function(err) {
    res.status(statusCode).send(err);
  };
}

var translateTweet = function(tweet, validateMedia, validateLocation){

  var validMedia = tweet.entities && tweet.entities.media && tweet.entities.media.length;

  var validLocation = tweet.coordinates && tweet.coordinates.coordinates && tweet.coordinates.coordinates.length;

  if(validateMedia && !(validMedia)){
    return;
  }

  if(validateLocation && !(validLocation)){
    return;
  }
  var media;
  if(validMedia){
    media = [];
    for (var i = 0; i < tweet.entities.media.length; i++) {
      var item = tweet.entities.media[i];
      media.push({
        media_url:item.media_url,
        media_url_https:item.media_url_https,
        url:item.url,
        display_url:item.display_url,
        expanded_url:item.expanded_url,
        type:item.type});
    };
  }

  return{
    updated: Date.now(),
    created: Date.now(),
    report_datetime: Date.now(),
    due_datetime: Date.now(),
    description: tweet.text,
    media:media,
    user:tweet.user.name,
    loc: validLocation?tweet.coordinates.coordinates:[]
  }
}

export function start(req, res){
    child_process.send({event:{type:"start"},data:{user:req.params.id}});
    res.status(200).end();
}
export function stop(req, res){
    child_process.send({event:{type:"stop"},data:{user:req.params.id}});
    res.status(200).end();
}
export function refresh(req, res){
    child_process.send({event:{type:"refresh"},data:{user:req.params.id}});
    res.status(200).end();
}
export function consume(req, res){
    consumer.send({event:{type:"consume"},data:{user:req.params.id}});
    res.status(200).end();
}