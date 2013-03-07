<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
	function set_translation_language($language='en_EN'){
	    $lang_path = FCPATH.APPPATH.'language/locales';
	    putenv('LANG='.$language.'.UTF-8');
	    setlocale(LC_ALL, $language.'.UTF-8');
	    bindtextdomain('lang', $lang_path);
	    textdomain('lang');
	}

	function _e($string) {
		echo gettext($string);
	}
	set_translation_language('en_EN');

?>