<?php
function sl_login_shortcode() {
    ob_start();

    if (isset($_SESSION['sl_step']) && $_SESSION['sl_step'] === 'verify') {
        include SL_PATH . 'templates/code-verification.php';
    } else {
        include SL_PATH . 'templates/login-form.php';
    }

    return ob_get_clean();
}
add_shortcode('secure_login', 'sl_login_shortcode');

/*
add_shortcode('secure_login_form', function () {
    ob_start();
    include SL_PATH . 'templates/login-form.php';
    return ob_get_clean();
});

*/
