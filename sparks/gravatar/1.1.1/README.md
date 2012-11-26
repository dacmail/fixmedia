
Gravatar Helper Spark for CodeIgniter
============================

A [CodeIgniter](http://codeigniter.com) helper [Spark](http://getsparks.org/) for working with the [Gravatar](http://gravatar.com) API to pull user avatar images, QR codes & profile URL's from email addresses.


Installation
-------------------------------------

1. Install the spark: `php tools/spark install gravatar` - or, if not using Spark package management, copy `gravatar_helper.php` to your `application/helpers` folder.
2. Load the spark: `$this->load->spark('gravatar/1.1.1');` - or, optionally autoload the spark in `application/config/autoload.php`: `$autoload['sparks'] = array('gravatar/1.1.1');`.
3. Employ helper functions as needed.


Usage
-------------------------------------

	/**
	 * Get either a Gravatar URL or complete image tag for a specified email address.
	 *
	 * @param string 	$email The email address
	 * @param string 	$s Size in pixels, defaults to 80px [ 1 - 512 ]
	 * @param boolean 	$img True to return a complete IMG tag False for just the URL 
	 * @param string 	$d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
	 * @param string 	$r Maximum rating (inclusive) [ g | pg | r | x ]
	 * @param array 	$atts Optional, additional key/value attributes to include in the IMG tag
	 * @return 			String containing either just a URL or a complete image tag
	 */

	<?=gravatar( 'test@example.com', 100 )?>


	/**
	 * Get a Gravatar profile URL from a primary gravatar email address.
	 *
	 * @param string 	$email The email address
	 * @return 			String containing the users gravatar profile URL.
	 */

	<?=gravatar_profile( 'test@example.com' )?>

	
	/**
	 * Get either a Gravatar QR Code URL or complete image tag from a primary gravatar email address.
	 *
	 * @param string 	$email The email address
	 * @param string 	$s Size in pixels, defaults to 80px [ 1 - 512 ]
	 * @param boolean 	$img True to return a complete IMG tag False for just the URL 
	 * @param array 	$atts Optional, additional key/value attributes to include in the IMG tag
	 * @return 			String containing either just a URL or a complete image tag
	 */
 
	<?=gravatar_qr( 'test@example.com' )?> 
	
  	
License
-------------------------------------

Copyright © 2012 Jason M Horwitz, Sekati LLC. All Rights Reserved.

Released under the MIT License: [http://www.opensource.org/licenses/mit-license.php](http://www.opensource.org/licenses/mit-license.php)

	The MIT License

	Permission is hereby granted, free of charge, to any person obtaining a copy of this software and 
	associated documentation files (the “Software”), to deal in the Software without restriction, 
	including without limitation the rights to use, copy, modify, merge, publish, distribute, 
	sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is 
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in all copies or 
	substantial portions of the Software.

	THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING 
	BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND 
	NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, 
	DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, 
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.	
	