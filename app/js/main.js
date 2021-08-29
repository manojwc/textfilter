requirejs.config({
	paths: {
		jquery 			: '../../libs/js/jquery-3.3.1.min',
		
		EventManager 	: 'services/EventManager',
		Helper 			: 'utils/Helper',

		app 	 		: 'controllers/app'
	},
	shim: {
	}
});

var app, EventManager;

requirejs(['jquery', 'app', 'EventManager'], function ($, _app, evt) {
	app = _app;
	EventManager = evt;
	
	$(document).ready(function(){
		app.init();
	});
});

