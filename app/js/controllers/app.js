define(['Helper'], function(Helper) {
	var self;
	var apiPath = '../../com/index.php/';
	var nav, frame;
	var files = ['words'];
	var foldername = 'app/partials/';

	//Init
	var init = function() {
		nav = $('#nav');
		frame = $('#page-container');
		addEventListeners();
		fname = foldername + files[0] + '.html';
		EventManager.publish('LOAD_PAGE', {'file': fname});
	};

	var addEventListeners = function() {
		EventManager.subscribe('LOAD_PAGE', function(ev) {
			file = ev.file;
			frame.on('load', function() {
			});
			frame.attr("src", file);
		});

		nav.find('.nav-item').on('click', function() {
			var $this = $(this);
			if (!$this.hasClass('active')) {
				nav.find('.nav-item').removeClass('active');
				$this.addClass('active');

				var idx = parseInt($this.attr('idx'));
				fname = foldername + files[idx] + '.html';
				EventManager.publish('LOAD_PAGE', {'file': fname});
			}
		});
	};

	var get_api_path = function() {
		return apiPath;
	};
	
	return {
		init: init,
		get_api_path: get_api_path
    };
});


