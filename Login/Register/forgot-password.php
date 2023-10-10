<?php get_header();?>

<section class="inner-banner">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/inner-bg.png" class="inner-img"
        alt="Inner Image" />
    <div class="inner-content">
        <h1>Forgot Password</h1>
        <p>Resend Verification Email</p>
    </div>
</section>

<section class="my-5">
    <div class="container-fluid">
        <div class="container">

            <div class="form-div shadow">

                <?php

// Check if the user has submitted the form
if (isset($_POST['reset_password'])) {

    $user_login = sanitize_user($_POST['user_login']);

    if (!filter_var($user_login, FILTER_VALIDATE_EMAIL)) {

        // Check email is valid or not
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Please Enter Valid Email Address';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';

    } else {
        $user_data = get_user_by('login', $user_login);

        if ($user_data) {

            // Generate a unique key
            $key = wp_generate_password(20, false);

            // Store the key in the user's meta
            update_user_meta($user_data->ID, 'reset_password_key', $key);

            // Create a reset password link
            $reset_link = add_query_arg(['key' => $key, 'login' => rawurlencode($user_data->user_login)], home_url('/reset-password/'));

            // Send the reset password email
            $subject = 'Password Reset';
            $message = 'To reset your password, click the following link: ' . $reset_link;

            if (wp_mail($user_data->user_email, $subject, $message)) {
                echo '<div class="alert alert-success mb-4 alert-dismissible rounded-0" role="alert">';
                echo 'A Verification Email has been sent with instructions to Reset your Password.';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }

        } else {
            echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
            echo 'Invalid Email Address.';
            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            echo '</div>';
        }
    }

}

?>

                <form method="post" class="needs-validation" novalidate>
                    <div class="mb-3">
                        <label for="user_login">Email</label>
                        <input type="email" name="user_login" id="user_login" class="input form-control" size="20"
                            placeholder="Enter Email" required />
                        <div class="invalid-feedback">
                            Please Enter Correct Email Address
                        </div>
                    </div>
                    <input type="submit" name="reset_password" class="btn btn-global rounded-pill px-4"
                        value="Reset Password" />
                    <a href="<?php echo home_url('/login/'); ?>" class="btn btn-warning rounded-pill px-4">Back to
                        Login</a>
                </form>


            </div>
        </div>
    </div>
</section>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()
</script>

<?php get_template_part('template-parts/content', 'brand');?>

<?php get_footer();?>