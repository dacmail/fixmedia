<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

public function __construct() {
parent::__construct();
}

public function index() {
$username = 'edipotrebol@gmail.com';
$password = '12345678';
$email = 'benedmunds';
$this->ion_auth->register($username, $password, $email);
}

}