<?php
if (isset($email)) {
	include 'navbar-user.tpl.php';
} else {
	include 'navbar-guest.tpl.php';
}
?>