<?php
$title = 'My Account';
$css = array (
);
$script = array(
	
	"displayMessage.js",
	"account.js"
);
?>
<p id="message" style="display:none"></p>
		<div class="column has-text-centered">
			<p class="title"> Password update</p>
			<input type ="text" id='email' name = '$email' placeholder='email'>
			<button class="button is-danger" name="updatepassword" onclick="forgot_password()">Reset password</button>
		</div>
	<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
