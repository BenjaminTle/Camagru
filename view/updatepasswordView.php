<?php
$title = 'My Account';
$css = array (
);
$script = array(
	
	"displayMessage.js",
	"account.js"
);
	$user_id = $_GET['user_id'];
ob_start();
?>
<p id="message"></p>
		<div class="column has-text-centered">
			<p class="title"> Password update</p>
			<label> New password <input type =password id='newpassword' name = 'newpassword'  required></label><br>
			<label> Confirm <input type =password id='confirm' name ='confirm' required></label><br>
			<button class="button is-danger" name="updatepassword" onclick="update_password(<?= $user_id ?>)">update password</button>
		</div>
	<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
