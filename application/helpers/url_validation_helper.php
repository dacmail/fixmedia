<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_url_data')) {
    function get_url_data($url, $maxlen = 150000, $check_local = true) {
        $url=trim($url);
        $url_components = @parse_url($url);
        $html='';
        $url_title = '';
        $url_ok = false;


        if (($response = get_url($url)) ) {

            /* Were we redirected? */
            if ($response['redirect_count'] > 0) {
                /* update $url with where we were redirected to */
                $new_url = clean_input_url($response['location']);
            }
            if (!empty($new_url) && $new_url != $url) {
                /* Check again the url */
                if (!check_url($new_url, $check_local, true)) {
                    $the_url = $new_url;
                    return false;
                }
                // Change the url if we were directed to another host
                if (strlen($new_url) < 300  && ($new_url_components = @parse_url($new_url))) {
                    if ($url_components['host'] != $new_url_components['host']) {
                        $url = $new_url;
                        $url_components = $new_url_components;
                    }
                }
            }
            $html = $response['content'];
            $url_ok = true;
        } else {
            $url_ok = false;
        }

        $the_url=$url;

        if(preg_match('/charset=([a-zA-Z0-9-_]+)/i', $html, $matches)) {
            $encoding=trim($matches[1]);
            if(strcasecmp($encoding, 'utf-8') != 0) {
                $html=iconv($encoding, 'UTF-8//IGNORE', $html);
            }
        }

        if(preg_match('/<title[^<>]*>([^<>]*)<\/title>/si', $html, $matches)) {
            $url_tit=clean_text($matches[1]);
            if (mb_strlen($url_tit) > 3) {
                $url_title=$url_tit;
            }
        }
        $url_description = "";
        if(preg_match('/< *meta +name=[\'"]description[\'"] +content=[\'"]([^<>]+)[\'"] *\/*>/si', $html, $matches)) {
            $url_description = clean_text($matches[1]);
            $url_description = html_entity_decode($url_description, ENT_COMPAT, 'UTF-8');
            $url_description = strip_tags($url_description);
            $url_description = @htmlspecialchars($url_description, ENT_COMPAT, 'UTF-8');
            if (mb_strlen($url_description) > 20) {
                $url_description = $url_description;
            }
        }
        if (empty($the_url) || empty($url_title) || empty($url_components['host'])) { $url_ok = false; }
        return array('valid' => $url_ok, 'url' => $the_url, 'title' => $url_title,'host' => $url_components['host'], 'description' => $url_description);
    }
}


if ( ! function_exists('get_url')) {
	function get_url($url, $referer = false, $max=200000) {
	    global $globals;
	    static $session = false;
	    static $previous_host = false;

	    $url = html_entity_decode($url);
	    $parsed = parse_url($url);
	    if (!$parsed) return false;

	    if ($session && $previous_host != $parsed['host']) {
	        curl_close($session);
	        $session = false;
	    }
	    if (!$session) {
	        $session = curl_init();
	        $previous_host =  $parsed['host'];
	    }
	    $url = preg_replace('/ /', '%20', $url);
	    curl_setopt($session, CURLOPT_URL, $url);
	    curl_setopt($session, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	    if ($referer) curl_setopt($session, CURLOPT_REFERER, $referer);
	    curl_setopt($session, CURLOPT_CONNECTTIMEOUT, 20);
	    curl_setopt($session, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt($session, CURLOPT_HEADER , true );
	    curl_setopt($session, CURLOPT_FOLLOWLOCATION, 1);
	    curl_setopt($session, CURLOPT_MAXREDIRS, 20);
	    curl_setopt($session, CURLOPT_TIMEOUT, 25);
	    curl_setopt($session, CURLOPT_FAILONERROR, true);
	    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($session, CURLOPT_SSL_VERIFYHOST, 2);
	    curl_setopt($session, CURLOPT_COOKIESESSION, true);
	   	curl_setopt($session, CURLOPT_COOKIEFILE, "/dev/null");
	    curl_setopt($session, CURLOPT_COOKIEJAR, "/dev/null");
	    $response = @curl_exec($session);
	    if (!$response) {
	            return false;
	    }
	    $header_size = curl_getinfo($session,CURLINFO_HEADER_SIZE);



	    $result['header'] = substr($response, 0, $header_size);
	    $result['content'] = substr($response, $header_size, $max);
	    if (preg_match('/Content-Encoding: *gzip/i', $result['header'])) {
	            $result['content'] = gzBody($result['content']);
	            echo "<!-- get_url gzinflating -->\n";
	    }
	    $result['http_code'] = curl_getinfo($session,CURLINFO_HTTP_CODE);
	    $result['content_type'] = curl_getinfo($session, CURLINFO_CONTENT_TYPE);
	    $result['redirect_count'] = curl_getinfo($session, CURLINFO_REDIRECT_COUNT);
	    $result['location'] = curl_getinfo($session, CURLINFO_EFFECTIVE_URL);
	    return $result;
	}
}

if ( ! function_exists('clean_text')) {
	function clean_text($string, $wrap=0, $replace_nl=true, $maxlength=0) {

		mb_internal_encoding("UTF-8");
		$string = mb_convert_encoding($string, "UTF-8", "auto");
	    $string = stripslashes(trim($string));
	    $string = preg_replace('/\r\n/u', "\n", $string); // Change \r\n to \n to show right chars' counter
	    $string = clear_whitespace($string);
	    $string = html_entity_decode($string, ENT_COMPAT, 'UTF-8');
	    // Replace two "-" by a single longer one, to avoid problems with xhtml comments
	    //$string = preg_replace('/--/', '–', $string);
	    if ($wrap>0) $string = wordwrap($string, $wrap, " ", 1);
	    if ($replace_nl) $string = preg_replace('/[\n\t\r]+/su', ' ', $string);

	    if ($maxlength > 0) $string = mb_substr($string, 0, $maxlength);

	    $string = @htmlspecialchars($string, ENT_COMPAT, 'UTF-8');
	    return preg_replace('/(\d+) +(\d{3,})/u', "$1&nbsp;$2", $string); // Avoid to wrap in the middle of numbers with thousands' space separator
	}
}
if ( ! function_exists('clear_whitespace')) {
	function clear_whitespace($input){
	    $input = clear_unicode_spaces(clear_invisible_unicode($input));
	    return preg_replace('/ {5,}/', ' ', $input);
	}
}

if ( ! function_exists('clear_invisible_unicode')) {
	function clear_invisible_unicode($input){
	    $invisible = array(
	    "\0",
	    "\xc2\xad", // 'SOFT HYPHEN' (U+00AD)
	    "\xcc\xb7", // 'COMBINING SHORT SOLIDUS OVERLAY' (U+0337)
	    "\xcc\xb8", // 'COMBINING LONG SOLIDUS OVERLAY' (U+0338)
	    "\xcd\x8f", // 'COMBINING GRAPHEME JOINER' (U+034F)
	    "\xe1\x85\x9f", // 'HANGUL CHOSEONG FILLER' (U+115F)
	    "\xe1\x85\xa0", // 'HANGUL JUNGSEONG FILLER' (U+1160)
	    "\xe2\x80\x8b", // 'ZERO WIDTH SPACE' (U+200B)
	    "\xe2\x80\x8c", // 'ZERO WIDTH NON-JOINER' (U+200C)
	    "\xe2\x80\x8d", // 'ZERO WIDTH JOINER' (U+200D)
	    "\xe2\x80\x8e", // 'LEFT-TO-RIGHT MARK' (U+200E)
	    "\xe2\x80\x8f", // 'RIGHT-TO-LEFT MARK' (U+200F)
	    "\xe2\x80\xaa", // 'LEFT-TO-RIGHT EMBEDDING' (U+202A)
	    "\xe2\x80\xab", // 'RIGHT-TO-LEFT EMBEDDING' (U+202B)
	    "\xe2\x80\xac", // 'POP DIRECTIONAL FORMATTING' (U+202C)
	    "\xe2\x80\xad", // 'LEFT-TO-RIGHT OVERRIDE' (U+202D)
	    "\xe2\x80\xae", // 'RIGHT-TO-LEFT OVERRIDE' (U+202E)
	    "\xe3\x85\xa4", // 'HANGUL FILLER' (U+3164)
	    "\xef\xbb\xbf", // 'ZERO WIDTH NO-BREAK SPACE' (U+FEFF)
	    "\xef\xbe\xa0", // 'HALFWIDTH HANGUL FILLER' (U+FFA0)
	    "\xef\xbf\xb9", // 'INTERLINEAR ANNOTATION ANCHOR' (U+FFF9)
	    "\xef\xbf\xba", // 'INTERLINEAR ANNOTATION SEPARATOR' (U+FFFA)
	    "\xef\xbf\xbb", // 'INTERLINEAR ANNOTATION TERMINATOR' (U+FFFB)
	    );

	    return str_replace($invisible, '', $input);

	}
}

if ( ! function_exists('clear_unicode_spaces')) {
	function clear_unicode_spaces($input){
	    $spaces = array(
	    "\x9", // 'CHARACTER TABULATION' (U+0009)
	    //  "\xa", // 'LINE FEED (LF)' (U+000A)
	    "\xb", // 'LINE TABULATION' (U+000B)
	    "\xc", // 'FORM FEED (FF)' (U+000C)
	    //  "\xd", // 'CARRIAGE RETURN (CR)' (U+000D)
	    "\x20", // 'SPACE' (U+0020)
	    "\xc2\xa0", // 'NO-BREAK SPACE' (U+00A0)
	    "\xe1\x9a\x80", // 'OGHAM SPACE MARK' (U+1680)
	    "\xe1\xa0\x8e", // 'MONGOLIAN VOWEL SEPARATOR' (U+180E)
	    "\xe2\x80\x80", // 'EN QUAD' (U+2000)
	    "\xe2\x80\x81", // 'EM QUAD' (U+2001)
	    "\xe2\x80\x82", // 'EN SPACE' (U+2002)
	    "\xe2\x80\x83", // 'EM SPACE' (U+2003)
	    "\xe2\x80\x84", // 'THREE-PER-EM SPACE' (U+2004)
	    "\xe2\x80\x85", // 'FOUR-PER-EM SPACE' (U+2005)
	    "\xe2\x80\x86", // 'SIX-PER-EM SPACE' (U+2006)
	    "\xe2\x80\x87", // 'FIGURE SPACE' (U+2007)
	    "\xe2\x80\x88", // 'PUNCTUATION SPACE' (U+2008)
	    "\xe2\x80\x89", // 'THIN SPACE' (U+2009)
	    "\xe2\x80\x8a", // 'HAIR SPACE' (U+200A)
	    "\xe2\x80\xa8", // 'LINE SEPARATOR' (U+2028)
	    "\xe2\x80\xa9", // 'PARAGRAPH SEPARATOR' (U+2029)
	    "\xe2\x80\xaf", // 'NARROW NO-BREAK SPACE' (U+202F)
	    "\xe2\x81\x9f", // 'MEDIUM MATHEMATICAL SPACE' (U+205F)
	    "\xe3\x80\x80", // 'IDEOGRAPHIC SPACE' (U+3000)
	    );

	    return str_replace($spaces, ' ', $input);
	}
}
if ( ! function_exists('clean_input_url')) {
	function clean_input_url($string) {
	    $string = preg_replace('/ /', '+', trim(stripslashes(mb_substr($string, 0, 512))));
	    $string = preg_replace('/[<>\r\n\t]/', '', $string);
	    $string = preg_replace('/(utm_\w+?|feature)=[^&]*/', '', $string); // Delete common variables for Analitycs and Youtube
	    $string = preg_replace('/&{2,}/', '&', $string); // Delete duplicates &
	    $string = preg_replace('/&+$/', '', $string); // Delete useless & at the end
	    $string = preg_replace('/\?&+/', '?', $string); // Delete useless & after ?
	    $string = preg_replace('/\?&*$/', '', $string); // Delete empty queries
	    return $string;
	}
}
if ( ! function_exists('check_url')) {
	function check_url($url, $check_local = true, $first_level = false) {
	    if(!preg_match('/^http[s]*:/', $url)) return false;
	    $url_components = @parse_url($url);
	    if (!$url_components) return false;
	    if (!preg_match('/[a-z]+/', $url_components['host'])) return false;
	    return true;
	}
}