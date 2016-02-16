"use strict";

module.exports = {
    process: function process(tweet) {
        if (!tweet) return null;
        var ret = {};
        ret.text = tweet.text;
        ret.user = tweet.user;
        ret.geo = tweet.geo;
        ret.id = tweet.id;
        ret.entities = tweet.entities;
        ret.retweeted_status = this.process(tweet.retweeted_status);
        return JSON.stringify(ret);
    }
};
//# sourceMappingURL=message.js.map
