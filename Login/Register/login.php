<?php get_header();?>

<section class="inner-banner">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/inner-bg.png" class="inner-img"
        alt="Inner Image" />
    <div class="inner-content">
        <h1>Login</h1>
        <p>Login Here</p>
    </div>
</section>

<section class="my-5">
    <div class="container-fluid">
        <div class="container">

            <div class="form-div shadow">

                <?php
if (isset($_GET['login_error'])) {
    $error_message = urldecode($_GET['login_error']);
    echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
    echo esc_html($error_message);
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
}
?>

                <?php
$args = array(
    'redirect' => home_url('/dashboard/'),
    'form_id' => 'loginform-custom',
    'label_username' => __('Email'),
    'label_password' => __('Password'),
    'label_remember' => __('Remember Me'),
    'label_log_in' => __('Log In'),
    'remember' => true,
    'class_user_login' => 'form-control', // Add 'form-control' class to username input
    'class_password' => 'form-control', // Add 'form-control' class to password input
);
wp_login_form($args);
?>

                <script>
                window.onload = function() {

                    // Add 'form-control' class to the username and password input fields
                    $('#user_login').addClass('form-control');
                    $('#user_pass').addClass('form-control');

                    // Add 'btn-global' class to the login button
                    $('#wp-submit').addClass('btn btn-global px-4');

                    // Add 'required' attribute to the username and password input fields
                    $('#user_login').prop('required', true);
                    $('#user_pass').prop('required', true);
                };
                </script>

                <a href="<?php echo home_url('/registration'); ?>">New User? Registration</a> |
                <a href="<?php echo home_url('/forgot-password'); ?>">Forgot/Reset Password</a>

            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/content', 'brand');?>

<?php get_footer();?>