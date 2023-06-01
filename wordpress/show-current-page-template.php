<?php

function show_current_template() {
    if (current_user_can('manage_options')) { // Only show to users with sufficient privileges
        global $template;
        echo "<div style='position: fixed; bottom: 0; right: 0; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd; font-family: monospace; font-size: 12px; z-index: 9999;'>";
        echo "Current Template: <strong>" . basename($template) . "</strong><br/>";
		echo "Template Location: <strong>{$template}</strong>";
        echo "</div>";
    }
}
add_action('wp_footer', 'show_current_template');

// ################################################################################################

function show_current_template_files() {
    if (current_user_can('manage_options')) { // Only show to users with sufficient privileges
        
		global $template;

        //This div css set to all content in right bottom corner
		echo "<div style='position: fixed; bottom: 0; right: 0; padding: 10px; background-color: #f9f9f9; border: 1px solid #ddd; font-family: monospace; font-size: 12px; z-index: 9999;'>";
		
        //Fetch Template Name with use of basename function
        echo "Current Template: <strong>" . basename($template) . "</strong><br/>";

        //Fetch Template Location
		echo "Template Location: <strong>{$template}</strong><br/>";
		
        $included_files = get_included_files();
		
		if (!empty($included_files)) {
            echo '<strong>Included Files:</strong><br>';

            foreach ($included_files as $included_file) {
				if ( strstr( $included_file, 'themes' . DIRECTORY_SEPARATOR ) ) {
					if (get_template_name($included_file) != basename($template)){
	                    echo get_template_name($included_file) . '<br/>';
					}
	            }
			}
			
        }

        // Fetch Active Theme Name
        $current_theme = wp_get_theme();
		$active_theme_name = $current_theme->get('Name');
		echo "<strong>Theme Name</strong>: " . $active_theme_name;
		
        echo "</div>";
    }
}
add_action('wp_footer', 'show_current_template_files');

function get_template_name($file_path) {
    $theme_path = get_template_directory();
    $template_name = str_replace($theme_path . '/', '', $file_path);
    return $template_name;
}