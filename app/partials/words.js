var pg = (function() {
	var error_cont, result_cont;
	var apiPath;
	var txtPara;
	var maxLength;
	var charLeft;
	var chkAdjectives, chkAdverbs, chkCommon, chkPrepositions, chkPronouns, chkSlug;
	var words = {'adjectives': [], 'adverbs': [], 'common': [], prepositions: [], pronouns: [], slug: []};
	
	var init = function() {
		error_cont = $('.error-container');
		result_cont = $('.result-container');
		txtPara = $('#txtPara');
		chkAdjectives = $('#chkAdjectives');
		chkAdverbs = $('#chkAdverbs');
		chkCommon = $('#chkCommon');
		chkPrepositions = $('#chkPrepositions');
		chkPronouns = $('#chkPronouns');
		chkSlug = $('#chkSlug');
		maxLength = txtPara[0].maxLength;
		charLeft = $('#charLeft');

		addEventListeners();
		if (parent.app) {
			apiPath = parent.app.get_api_path();
		};
	};

	var reset_containers = function() {
		error_cont.addClass('hidden');
		result_cont.addClass('hidden');
		result_cont.html("");
		error_cont.find('.error-msg').html("");
    };

	var addEventListeners = function() {
		chkAdjectives.on('click', function() {
			return show_words('adjectives', this.checked);
		});
		chkAdverbs.on('click', function() {
			return show_words('adverbs', this.checked);
		});
		chkCommon.on('click', function() {
			return show_words('common', this.checked);
		});
		chkPrepositions.on('click', function() {
			return show_words('prepositions', this.checked);
		});
		chkPronouns.on('click', function() {
			return show_words('pronouns', this.checked);
		});
		chkSlug.on('click', function() {
			return show_words('slug', this.checked);
		});

		txtPara.on('keyup', (function() {
			var textlen = maxLength - $(this).val().length;
			charLeft.text('Characters Left: ' + textlen);
		}));
	};

	var show_words = function(word_type, flag) {
		words[word_type] = [];
		if (flag) {
			txtPara.val(txtPara.val().trim());
			
			if (txtPara.val() === '') {
				alert('Oops! Please enter some text first.');
				return false;
			};
			var prm = get_words_list(word_type);
			prm.done(function(data) {
				if (data !== '') {
					var words_list = decode_data(data);
					var available_words = find_words(words_list, txtPara.val());
					display_words(word_type, available_words);
				}
			}).fail(Helper.ajaxErrorHandler);
		} else {
			//Remove Container 
			var cont = '.' + word_type + '_cont';
			result_cont.find(cont).html('').addClass('hidden');
		};
		return true;
	};

	var get_words_list = function(word_type) {
		var defer = $.Deferred();
		localStorage.setItem('wt_' + word_type, null);
		var local_val = localStorage.getItem('wt_' + word_type);
		var from_api = false;
		if (local_val === null || local_val === undefined || local_val === "null") {
			from_api = true;
		} else {
			dateString = JSON.parse(local_val).timestamp;
    		now = new Date().getTime();
    		var diff_ms = (parseInt(now, 10) - parseInt(dateString, 10));
    		var diff = diff_ms / (1000 * 60 * 60 * 24);
    		from_api = (diff > 10);
		}
		if (from_api) {
			localStorage.setItem('wt_' + word_type, null);
			/*var prm = Helper.loadFile(apiPath + 'words/get_' + word_type, 'get', false, 'json');
			prm.done(function(resp) {
				if (resp.data !== '') {
					var object = {value: resp.data, timestamp: new Date().getTime()}
					localStorage.setItem('wt_' + word_type, JSON.stringify(object));
				};
				defer.resolve(resp.data);
			}).fail(function(err) {
				defer.reject(err);
			});*/
			var data = words_list[word_type];
			if (data) {
				var object = {value: data, timestamp: new Date().getTime()};
				localStorage.setItem('wt_' + word_type, JSON.stringify(object));
				defer.resolve(data);
			} else {
				defer.reject("Error");
			}
		} else {
			defer.resolve(JSON.parse(local_val).value);
		};
		return defer.promise(); 
	};

	var decode_data = function(data) {
		//Decode data
		data = atob(data);
		return data.split(",");
	};

	var find_words = function(arr, para) {
		var words = [];
		var para_words = para.split(" ");
		words = para_words.filter(function(word) {
			return (arr.indexOf(word) > -1);
		}).filter(function(word, pos, self) {
			return (self.indexOf(word) === pos);
		});
		return words;
	};

	String.prototype.toTitleCase = function() {
		return(this.toLowerCase().replace(this.charAt(0), this.charAt(0).toUpperCase()));
	}

	var display_words = function(word_type, words) {
		var title = Helper.toTitleCase(word_type);
		
		var str = '<strong>' + title + '</strong>';
		if (words.length === 0) {
			str += '<p>No ' + word_type.toUpperCase() + ' found</p>';
		} else {
			str += '<ul>';
			words.forEach(function(word) {
				str += '<li>' + word + '</li>';
			});
			str += '</ul>';
			
			var selectedLabel = word_type.toTitleCase();
			var selectedLabelID = eval('chk' + selectedLabel);

			selectedLabelID[0].labels[0].innerHTML = selectedLabel + ' (' + words.length + ')';
		}	

		var cont = '.' + word_type + '_cont';
		result_cont.find(cont).html(str).removeClass('hidden');
	};

	return {
		init: init
	}
})();

$(document).ready(function() {
	pg.init();
});
