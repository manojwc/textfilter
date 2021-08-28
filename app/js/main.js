requirejs.config({
	baseUrl				: 'app/js/',

	paths: {
		jquery 			: '../../libs/js/jquery-3.3.1.min',
		bootstrap		: '../../libs/js/bootstrap.min',
		bootstrapbundle : '../../libs/js/bootstrap.bundle',
		
		EventManager 	: 'services/EventManager',
		Helper 			: 'utils/Helper',

		app 	 		: 'controllers/app'
	},
	shim: {
    	'bootstrap': {
			deps: ['jquery'],
			exports: 'bootstrap'
		},
		'bootstrapbundle': {
			deps: ['jquery', 'bootstrap'],
			exports: 'bootstrapbundle'
		}
	}
});

var app, EventManager;

requirejs(['jquery', 'bootstrap', 'app', 'EventManager'], function ($, bootstrap, _app, evt) {
	app = _app;
	EventManager = evt;
	
	$(document).ready(function(){
		app.init();
	});
});

