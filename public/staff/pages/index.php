<?php require_once('../../../private/initialize.php'); ?>

<?php
//admin must be logged in before performing any operation
require_login();

redirect_to(url_for('/staff/index.php'));

?>