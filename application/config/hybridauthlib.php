<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*!
* HybridAuth
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

// ----------------------------------------------------------------------------------------
//	HybridAuth Config file: http://hybridauth.sourceforge.net/userguide/Configuration.html
// ----------------------------------------------------------------------------------------

// set on "base_url" the relative url that point to HybridAuth Endpoint
// IMPORTANT: If the "index.php" is removed from the URL (http://codeigniter.com/user_guide/general/urls.html) the
// "/index.php/" part __MUST__ be prepended to the base_url.
$config['base_url'] = '/auth/provider_endpoint';

$config['providers'] = array (

			"Twitter" => array (
				"enabled" => true,
				"keys"    => array ( "key" => "q4OCmsOAUOg0ENvFsZPg", "secret" => "D9YgtmiWdCEq3BxAGhq1Vioj6EvR1bPvCttFVQU8A" )
			)
		);

// if you want to enable logging, set 'debug_mode' to true  then provide a writable file by the web server on "debug_file"
$config['debug_mode'] = true;

$config['debug_file'] = APPPATH.'/logs/hybridauth.log';


/* End of file hybridauthlib.php */
/* Location: ./application/config/hybridauthlib.php */