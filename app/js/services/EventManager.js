define([], function() {
	//Events
    var subscribers = {};
    var subscribe = function(type, fn) {
        if (!subscribers[type]) {
            subscribers[type] = [];
        };

        if (subscribers[type].indexOf(fn) === -1) {
            subscribers[type].push(fn);
        };
    };

    var unsubscribe = function(type, fn) {
        var listeners = subscribers[type];

        if (!listeners) {
            return;
        } else {
            var idx = listeners.indexOf(fn);
            if (idx >= 0) {
                listeners.splice(idx, 1);
            };
        };
    };

    var publish = function(type, evtObj) {
        var listeners = subscribers[type];
        if (!listeners) {
            return;
        } else {
            if (!evtObj.type) {
                evtObj.type = type;
            };

            for(var i = 0, len = listeners.length; i < len ; i++) {
                listeners[i](evtObj);
            };
        };
    };

    return {
    	subscribe: subscribe,
    	unsubscribe: unsubscribe,
    	publish: publish
    };
});