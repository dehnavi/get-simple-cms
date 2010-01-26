<?php

/*
 * Configuration file for GetSimple
 * @since 2.0
 */

if (basename($_SERVER['PHP_SELF']) == 'gsconfig.php') { 
	die('You cannot load this page directly.');
}; 


# Turn on debug mode
#define('GSDEBUG', TRUE);

# Default thumbnail width of uploaded image
define('GSIMAGEWIDTH', '200');

# Ping search engines upon sitemap generation?
#define('GSDONOTPING', 1);

# Use Uploadify to upload files?
#define('GSNOUPLOADIFY', 1);

# WYSIWYG editor height (default 500)
#define('GSEDITORHEIGHT', '400');

# WYSIWYG toolbars (advanced or basic) 
#define('GSEDITORTOOL', 'advanced');

# WYSIWYG editor language (default en)
#define('GSEDITORLANG', 'en');

# Turn off auto-generation of SALT and use a custom value
#define('GSUSECUSTOMSALT', 'your_new_salt_value_here');

# Set PHP locale
# http://php.net/manual/en/function.setlocale.php
#setlocale(LC_ALL, 'en_US');
