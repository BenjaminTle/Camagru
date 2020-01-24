<?php 
	if (array_key_exists('user_id', $_SESSION))
		header("Location:http://localhost:8100/camagru/");
	$title = 'Register';
	$css = array (
		"login.css"
	);
	$script = array(
		"login.js",
		"displayMessage.js"
	);
	ob_start();?>
	<p id="message" style="display:none"></p>
	<div class="container has-text-centered">
        <div class="column is-4 is-offset-4">
            <h3 class="title has-text-grey">Login</h3>
            <p class="subtitle has-text-grey">Welcome back on Camagru</p>
            <div class="box">
                    <div class="field">
                        <div class="control">
                            <input id ="email" class="input is-large" type="email" placeholder="Your Email" autofocus="">
                        </div>
                    </div>
                    <div class="field">
                        <div class="control">
                            <input id ="password" class="input is-large" type="password" placeholder="Your Password">
                        </div>
                    </div>
                    <button onclick="checkLogin()" class="button is-block is-info is-large is-fullwidth">Login</button>
            </div>
            <p class="has-text-grey">
                <a href="http://localhost:8100/camagru/?action=register">Register</a> &nbsp;·&nbsp;
                <a href="http://localhost:8100/camagru/?action=forgot_password">Forgot Password</a> 
            </p>
        </div>
    </div>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
