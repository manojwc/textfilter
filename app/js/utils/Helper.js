var Helper = (function() {
	//Show Loader
	var loader;
	var mon = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
	
	var showLoader = function() {
		if (typeof(loader) === 'undefined') {
			loader = $('#loader');
		};
		loader.show();
	}

	//Hide Loader
	var hideLoader = function() {
		if (typeof(loader) === 'undefined') {
			loader = $('#loader');
		};
		loader.hide();
	}

	//Ajax Error Status Mapping
	var statusErrorMap = {
		'400' : 'Server understood the request, but request content was invalid.',
		'401' : 'Unauthorized access.',
		'403' : 'Forbidden resource can\'t be accessed.',
		'500' : 'Internal server error.',
		'503' : 'Service unavailable.',
		'404' : 'File not found.'
	};
	
	//Ajax Error Handler
	var ajaxErrorHandler = function(xhr, exception) {
		var message;
		if (exception != "success") {
			if (xhr.status) {
				message = statusErrorMap['' + xhr.status];
			} 
			if (!message) {
				if (exception == 'parsererror') {
					message = "Parsing Error.";
				} else if (exception == 'timeout') {
					message = "Request Time out.";
				} else if (exception == 'abort') {
					message = "Request was aborted by the server";
				} else {
					message="Unknown Error.";
				};
			};
			alert("AJAX Error Handler -" + message);
		};
	};

	var loadFile = function(_url, _method, _isSync, _dataType, _data) {
		return $.ajax({
			url: _url,
			method: _method,
			async: _isSync,
			dataType: _dataType,
			data: _data,
			processData: false,
			contentType: false,
			dataType: 'json'
		});
	};


	var get_random_numbers_array = function(min, max, count) {
		var arr = [];
		if (count > (max - min + 1)) {
			count = max - min + 1;
		};
		if (count !== 0) {
			var val;
			while(arr.length < count) {
	  			val = Math.round(Math.random() * (max - min) + min);
	  			if (arr.indexOf(val) === -1) {
	  				arr.push(val);
	  			};
	  		};
	  	};
  		return arr;
	};

	var get_serial_numbers_array = function(min, max, _total) {
        _total = (_total != 0 && _total != "all") ? _total : max + 1;
        var arr = [];
        for (var i = 0; i < _total; i++) {
            arr[i] = (i + 1);
        }
        return arr;
    };

    var toTitleCase = function(str) {
    	return str.charAt(0).toUpperCase() + str.substr(1).toLowerCase();
    };

    return {
		showLoader: showLoader,
		hideLoader: hideLoader,
		loadFile: loadFile,
		ajaxErrorHandler: ajaxErrorHandler,
		get_random_numbers_array: get_random_numbers_array,
		get_serial_numbers_array: get_serial_numbers_array,
		toTitleCase: toTitleCase
	};
})();
