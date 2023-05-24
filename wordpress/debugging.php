<?php

// https://developer.wordpress.org/themes/getting-started/setting-up-a-development-environment/

define( 'WP_DISABLE_FATAL_ERROR_HANDLER', true );
define( 'WP_DEBUG', true );

// WP_DEBUG_LOG is used in conjunction with WP_DEBUG to log all error messages to a debug.log within your WordPress /wp-content/ directory.
define( 'WP_DEBUG_LOG', true );

// WP_DEBUG_DISPLAY is used to control whether debug messages display within the HTML of your theme pages.
define( 'WP_DEBUG_DISPLAY', true );