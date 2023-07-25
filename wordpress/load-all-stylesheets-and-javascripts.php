<?php

// https://developer.wordpress.org/themes/basics/including-css-javascript/

// Stylesheet Syntax
wp_enqueue_style( $handle, $src, $deps, $ver, $media );

// $handle is simply the name of the stylesheet.
// $src is where it is located. The rest of the parameters are optional.
// $deps refers to whether or not this stylesheet is dependent on another stylesheet. If this is set, this stylesheet will not be loaded unless its dependent stylesheet is loaded first.
// $ver sets the version number.
// $media can specify which type of media to load this stylesheet in, such as ‘all’, ‘screen’, ‘print’ or ‘handheld.’

//Script Syntax
wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer);

// $handle is the name for the script.
// $src defines where the script is located.
// $deps is an array that can handle any script that your new script depends on, such as jQuery.
// $ver lets you list a version number.
// $in_footer is a boolean parameter (true/false) that allows you to place your scripts in the footer of your HTML document rather then in the header, so that it does not delay the loading of the DOM tree.