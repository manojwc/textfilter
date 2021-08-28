<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
require APPPATH . '/libraries/REST_Controller.php';

/**
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array
 *
 * @package         CodeIgniter
 * @subpackage      Rest Server
 * @category        Controller
 * @author          Phil Sturgeon, Chris Kacerguis
 * @license         MIT
 * @link            https://github.com/chriskacerguis/codeigniter-restserver
 */
class Words extends REST_Controller {

	function __construct() {
		header("Access-Control-Allow-Credentials: true");
		header("Access-Control-Allow-Origin: *");
		header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
		header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");

		if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
			header("HTTP/1.1 200 OK");
			exit();
		}
		// Construct the parent class
		parent::__construct();
	}

	public function get_adjectives_get() {
		$this->load->model("words_model", "words_model");
        $return_array = $this->words_model->get_adjectives();
    	$this->response($return_array, REST_Controller::HTTP_OK);
    }

    public function get_adverbs_get() {
		$this->load->model("words_model", "words_model");
        $return_array = $this->words_model->get_adverbs();
    	$this->response($return_array, REST_Controller::HTTP_OK);
    }

    public function get_common_get() {
		$this->load->model("words_model", "words_model");
        $return_array = $this->words_model->get_common();
    	$this->response($return_array, REST_Controller::HTTP_OK);
    }

    public function get_prepositions_get() {
		$this->load->model("words_model", "words_model");
        $return_array = $this->words_model->get_prepositions();
    	$this->response($return_array, REST_Controller::HTTP_OK);
    }

    public function get_pronouns_get() {
		$this->load->model("words_model", "words_model");
        $return_array = $this->words_model->get_pronouns();
    	$this->response($return_array, REST_Controller::HTTP_OK);
    }

    public function get_slug_get() {
		$this->load->model("words_model", "words_model");
        $return_array = $this->words_model->get_slug();
    	$this->response($return_array, REST_Controller::HTTP_OK);
    }
}