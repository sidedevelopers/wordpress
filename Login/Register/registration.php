<?php get_header();?>

<section class="inner-banner">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/inner-bg.png" class="inner-img"
        alt="Inner Image" />
    <div class="inner-content">
        <h1>Register & Manage Your CV</h1>
        <p>Registration</p>
    </div>
</section>

<section class="my-5">
    <div class="container-fluid">
        <div class="container">

            <div class="form-div shadow">

                <?php

if (isset($_POST['submit'])) {

    $r_civility = sanitize_text_field($_POST['r_civility']);
    $r_name = sanitize_text_field($_POST['r_name']);
    $r_phone = sanitize_text_field($_POST['r_phone']);
    $r_email = sanitize_email($_POST['r_email']);
    $r_password = $_POST['r_password'];
    $r_confirm_password = $_POST['r_confirm_password'];

    // Remove leading and trailing white spaces
    $r_email = trim($r_email);
    $r_name = trim($r_name);

    // Define validation criteria
    $min_length = 8; // Minimum length for the password
    $requires_uppercase = true; // Password must contain at least one uppercase letter
    $requires_lowercase = true; // Password must contain at least one lowercase letter
    $requires_digit = true; // Password must contain at least one digit
    $requires_special_character = true; // Password must contain at least one special character

    $name_max_length = 25;
    // Check the length of the name
    $name_length = strlen($r_name);

    // Check if the user already exists with the same email
    $existing_user_id = email_exists($r_email);

    if ($name_length >= $name_max_length) {
        // Check name length is smaller than 25 alphabets
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Only 25 alphabets allowed in name';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if (!filter_var($r_email, FILTER_VALIDATE_EMAIL)) {
        // Check email is valid or not
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Please Enter Valid Email Address';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if ($r_password != $r_confirm_password) {
        // Check the password is equal to confirm password
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Password Do Not Match!';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if (strlen($r_password) < $min_length) {
        // Check the password minimum length
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Password must be at least ' . $min_length . ' characters long.';
        echo '<br/><hr/><strong>Password Requirements</strong><br/>';
        echo '<ul class="mt-2"><li>Password must be at least ' . $min_length . ' characters long.</li><li>Password must contain at least one uppercase letter.</li><li>Password must contain at least one lowercase letter.</li><li>Password must contain at least one digit.</li><li>Password must contain at least one special character.</li></ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if ($requires_uppercase && !preg_match('/[A-Z]/', $r_password)) {
        // Check for uppercase letter requirement
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Password must contain at least one uppercase letter.';
        echo '<br/><hr/><strong>Password Requirements</strong><br/>';
        echo '<ul class="mt-2"><li>Password must be at least ' . $min_length . ' characters long.</li><li>Password must contain at least one uppercase letter.</li><li>Password must contain at least one lowercase letter.</li><li>Password must contain at least one digit.</li><li>Password must contain at least one special character.</li></ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if ($requires_lowercase && !preg_match('/[a-z]/', $r_password)) {
        // Check for lowercase letter requirement
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Password must contain at least one lowercase letter.';
        echo '<br/><hr/><strong>Password Requirements</strong><br/>';
        echo '<ul class="mt-2"><li>Password must be at least ' . $min_length . ' characters long.</li><li>Password must contain at least one uppercase letter.</li><li>Password must contain at least one lowercase letter.</li><li>Password must contain at least one digit.</li><li>Password must contain at least one special character.</li></ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if ($requires_digit && !preg_match('/[0-9]/', $r_password)) {
        // Check for digit requirement
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Password must contain at least one digit.';
        echo '<br/><hr/><strong>Password Requirements</strong><br/>';
        echo '<ul class="mt-2"><li>Password must be at least ' . $min_length . ' characters long.</li><li>Password must contain at least one uppercase letter.</li><li>Password must contain at least one lowercase letter.</li><li>Password must contain at least one digit.</li><li>Password must contain at least one special character.</li></ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if ($requires_special_character && !preg_match('/[!@#$%^&*()\-_=+{};:,<.>?]/', $r_password)) {
        // Check for special character requirement
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'Password must contain at least one special character.';
        echo '<br/><hr/><strong>Password Requirements</strong><br/>';
        echo '<ul class="mt-2"><li>Password must be at least ' . $min_length . ' characters long.</li><li>Password must contain at least one uppercase letter.</li><li>Password must contain at least one lowercase letter.</li><li>Password must contain at least one digit.</li><li>Password must contain at least one special character.</li></ul>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else if ($existing_user_id) {
        // User with the same email already exists
        echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
        echo 'User Already Registered with this email. <a href="' . home_url('/login') . '" class="fw-bold">Click Here to Login</a>';
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    } else {

        $user_id = wp_create_user($r_email, $r_password, $r_email);

        if (!is_wp_error($user_id)) {

            // Generate a verification token
            $verification_token = wp_generate_password(32, false);

            // Send the verification email
            $verification_link = home_url('/verify-account/?token=' . $verification_token); // Change this to the actual URL for verification

            $subject = 'Account Verification';
            $message = 'Thank you for registering with us. Please click the following link to verify your account: ' . $verification_link;

            // Send the email
            $headers = array('Content-Type: text/html; charset=UTF-8');
            if (wp_mail($r_email, $subject, $message, $headers)) {

                // Store the verification token in user meta
                update_user_meta($user_id, 'verification_token', $verification_token);

                $user_verified_value = 0;
                // Mark the user as unverified
                update_user_meta($user_id, 'user_verified', $user_verified_value);

                // Update user meta data
                update_user_meta($user_id, 'user_civility', $r_civility);
                update_user_meta($user_id, 'user_name', $r_name);
                update_user_meta($user_id, 'user_phone', $r_phone);

                echo '<div class="alert alert-success mb-4 alert-dismissible rounded-0" role="alert">';
                echo 'Registration Successfully! A Confirmation Email was sent to this mail ' . $r_email;
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';

            } else {
                echo '<div class="alert alert-danger mb-4 alert-dismissible rounded-0" role="alert">';
                echo 'Something Went Wrong! Try Again';
                echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                echo '</div>';
            }

        }

    }

}
?>

                <form method="POST" class="row g-3 needs-validation" novalidate>

                    <div class="col-md-6">
                        <label for="r_civility" class="form-label mb-1 fw-bold">CIVILITY</label>
                        <select name="r_civility" class="form-select" id="r_civility" required>
                            <option selected disabled value="">Choose...</option>
                            <option value="Mr.">Mr.</option>
                            <option value="Mrs.">Mrs.</option>
                            <option value="Miss.">Miss.</option>
                        </select>
                        <div class="valid-feedback">
                            Great!
                        </div>
                        <div class="invalid-feedback">
                            Please select a valid civility.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="r_name" class="form-label mb-1 fw-bold">NAME</label>
                        <input type="text" name="r_name" class="form-control" id="r_name" size="20"
                            placeholder="Enter Name" required>
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>

                    <!-- <div class="col-md-2">
                    <label for="civility" class="form-label mb-1 fw-bold">COUNTRY CODE</label>
                    <select name="civility" class="form-select" id="civility" required>
                        <option selected disabled value="">Choose...</option>
                        <option value="Mr.">+91</option>
                        <option value="Mrs.">Mrs.</option>
                        <option value="Miss.">Miss.</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select a valid civility.
                    </div>
                </div> -->

                    <div class="col-md-6">
                        <label for="r_phone" class="form-label mb-1 fw-bold">PHONE</label>
                        <input type="number" name="r_phone" class="form-control" id="r_phone" min="999999999"
                            placeholder="Enter Phone" required />
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="r_email" class="form-label mb-1 fw-bold">E-MAIL</label>
                        <input type="email" name="r_email" class="form-control" id="emailAddress"
                            placeholder="Enter Email" required />
                        <div class="valid-feedback">
                            We'll never share your email with anyone else.
                        </div>
                        <div class="invalid-feedback">
                            Please Enter Valid Email Address.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="r_password" class="form-label mb-1 fw-bold">PASSWORD</label>
                        <input type="password" name="r_password" class="form-control" id="r_password"
                            placeholder="Enter Password" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label for="r_confirm_password" class="form-label mb-1 fw-bold">CONFIRM PASSWORD</label>
                        <input type="password" name="r_confirm_password" class="form-control" id="r_confirm_password"
                            placeholder="Enter Confirm Password" required />
                        <div class="valid-feedback">
                            Looks good!
                        </div>
                        <div class="invalid-feedback">
                            This field is required.
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                            <label class="form-check-label" for="invalidCheck">
                                Agree to terms and conditions
                            </label>
                            <div class="invalid-feedback">
                                You must agree before submitting.
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button class="btn btn-global px-4 rounded-pill" type="submit" name="submit">Register</button>
                        <a href="<?php echo home_url('/login/'); ?>" class="btn btn-warning rounded-pill px-4">Go To
                            Login</a>
                    </div>
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