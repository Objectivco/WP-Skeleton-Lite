<?php
// clear opcache if secret key validates
if ( isset($_GET['secret_key']) && $_GET['secret_key'] == "SECRETKEY" && function_exists('opcache_reset') ) {
	@opcache_reset();
}