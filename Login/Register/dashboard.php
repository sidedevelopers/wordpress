<?php get_header();?>

<section class="inner-banner">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/inner-bg.png" class="inner-img"
        alt="Inner Image" />
    <div class="inner-content">
        <h1>Dashboard</h1>
        <p>create your cv</p>
    </div>
</section>

<?php
$user_id = get_current_user_id();
?>

<section class="my-5">
    <div class="container-fluid">
        <div class="container">

            <div class="row">
                <div class="col-md-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action active" id="list-home-list"
                            data-bs-toggle="list" href="#list-home" role="tab" aria-controls="list-home">Welcome</a>
                        <a href="<?php echo site_url(); ?>/editcv/" class="list-group-item list-group-item-action"
                            id="list-profile-list" href="#list-profile" role="tab"
                            aria-controls="list-profile">Profile</a>
                        <a class="list-group-item list-group-item-action" id="saved-jobs-list" data-bs-toggle="list"
                            href="#saved-jobs" role="tab" aria-controls="saved-jobs">Saved Jobs</a>
                        <a href="<?php echo wp_logout_url(home_url('/login/')); ?>"
                            class="list-group-item list-group-item-action" id="list-settings-list" href="#list-settings"
                            role="tab" aria-controls="list-settings">Logout</a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="list-home" role="tabpanel"
                            aria-labelledby="list-home-list">

                            <div class="bg-body-tertiary p-4">
                                <div class="row align-items-center">
                                    <div class="col-md-3 p-2 bg-white">
                                        <?php
$image_url = get_user_meta($user_id, 'user_image', true);

if (!empty($image_url)) {
    echo '<img src="' . esc_url($image_url) . '" class="w-100" alt="User Image">';
} else {
    echo '<img src="' . get_template_directory_uri() . '/assets/icons/graduation.png" class="w-100" alt="User Image" />';
}
?>
                                    </div>
                                    <div class="col-md-9">
                                        <h4 class="fw-bold">Welcome
                                            <?php echo esc_attr(get_the_author_meta('user_name', $user_id)); ?></h4>
                                        <p class="mb-1"><strong>Telephone:</strong>
                                            <?php echo esc_attr(get_the_author_meta('user_phone', $user_id)); ?></p>
                                        <p><strong>Account Email:</strong>
                                            <?php echo esc_attr(get_the_author_meta('user_email', $user_id)); ?>
                                        </p>
                                        <a href="<?php echo site_url(); ?>/editcv/"
                                            class="btn btn-global rounded-0 btn-sm px-4">Update my Profile</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- <div class="tab-pane fade" id="list-profile" role="tabpanel"
                            aria-labelledby="list-profile-list">...</div> -->
                        <div class="tab-pane fade" id="saved-jobs" role="tabpanel" aria-labelledby="saved-jobs-list">

                            <?php
$user_id = get_current_user_id();
$saved_posts = get_user_meta($user_id, 'saved_posts', true);

if (!empty($saved_posts)) {
    echo '<h3>Saved Jobs</h3>';
    echo '<ul class="list-group">';

    foreach ($saved_posts as $post_id) {

        if (get_the_title($post_id) !== 'Dashboard') {

            $post_permalink = get_permalink($post_id);
            $post_title = get_the_title($post_id);

            echo '<li class="list-group-item d-flex justify-content-between align-items-center"><a href="' . $post_permalink . '">' . $post_title . '</a><a href="' . $post_permalink . '"><span class="badge bg-primary rounded-pill">View</span></a></li>';

        }
    }

    echo '</ul>';
} else {
        echo '<div class="alert alert-danger mb-4 rounded-0" role="alert">';
        echo 'No saved jobs found.';
        echo '</div>';
}

?>

                        </div>
                        <!-- <div class="tab-pane fade" id="list-settings" role="tabpanel"
                            aria-labelledby="list-settings-list">...</div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<?php get_footer();?>