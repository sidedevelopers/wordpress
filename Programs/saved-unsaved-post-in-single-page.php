<?php
if (is_user_logged_in()) {

    $post_id = get_the_ID();
    $user_id = get_current_user_id();

    $is_saved = check_if_post_is_saved($post_id, $user_id);

    if ($is_saved) {
        echo '<form method="post" action="' . get_permalink() . '">';
        echo '<input type="hidden" name="action_type" value="remove">';
        echo '<input type="submit" value="Remove from Saved">';
        echo '</form>';
    } else {
        echo '<form method="post" action="' . get_permalink() . '">';
        echo '<input type="hidden" name="action_type" value="save">';
        echo '<input type="submit" value="Save Post">';
        echo '</form>';
    }
}

if (isset($_POST['action_type']) && in_array($_POST['action_type'], array('save', 'remove'))) {

    $post_id = get_the_ID();
    $user_id = get_current_user_id();

    if ($_POST['action_type'] === 'save') {
        // Add code to save the post for the user
        // Here, we're using post meta to store saved posts for the user
        $saved_posts = get_user_meta($user_id, 'saved_posts', true);

        // Make sure $saved_posts is an array
        if (!is_array($saved_posts)) {
            $saved_posts = array();
        }

        // Add the current post ID to the saved posts array if not already saved
        if (!in_array($post_id, $saved_posts)) {

            $saved_posts[] = $post_id;
            update_user_meta($user_id, 'saved_posts', $saved_posts);

            echo "<script>window.location='" . get_the_permalink() . "'</script>";

        }
    } else if ($_POST['action_type'] === 'remove') {

        // Add code to remove the post from the user's saved posts
        // Here, we're using post meta to store saved posts for the user
        $saved_posts = get_user_meta($user_id, 'saved_posts', true);

        // Make sure $saved_posts is an array
        if (!is_array($saved_posts)) {
            $saved_posts = array();
        }

        // Remove the current post ID from the saved posts array if saved
        $index = array_search($post_id, $saved_posts);
        if ($index !== false) {
            unset($saved_posts[$index]);
            update_user_meta($user_id, 'saved_posts', $saved_posts);
            echo "<script>window.location='" . get_the_permalink() . "'</script>";
        }
    }
}

?>




<!-- For Fetch in Dashboard Page -->
<?php
$user_id = get_current_user_id();
$saved_posts = get_user_meta($user_id, 'saved_posts', true);

if (!empty($saved_posts)) {
    echo '<h2>Saved Posts</h2>';
    echo '<ul>';

    foreach ($saved_posts as $post_id) {
        // Check if the post ID is not equal to the dashboard page's ID
        $dashboard_page_id = get_page_by_path('dashboard')->ID; // Change 'dashboard' to the actual slug of your dashboard page
        if ($post_id !== $dashboard_page_id) {
            $post_permalink = get_permalink($post_id);
            $post_title = get_the_title($post_id);

            echo '<li><a href="' . $post_permalink . '">' . $post_title . '</a></li>';
        }
    }

    echo '</ul>';
} else {
    echo '<p>No saved posts found.</p>';
}
?>


<?php
register_post_type('saved_post', array(
        'labels' => array(
            'name' => 'Saved Posts',
            'singular_name' => 'Saved Post',
        ),
        'public' => false,
        'show_ui' => true,
    ));


    function check_if_post_is_saved($post_id, $user_id) {
        // Get the user's saved posts
        $saved_posts = get_user_meta($user_id, 'saved_posts', true);
    
        // Check if the post ID exists in the user's saved posts
        if (is_array($saved_posts) && in_array($post_id, $saved_posts)) {
            return true; // Post is saved
        }
    
        return false; // Post is not saved
    }

    ?>