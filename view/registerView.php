<?php
	$title = 'Register';
	$css = array (
		"register.css"
	);
	$script = array(
		"register.js",
		"displayMessage.js"
	);
	ob_start(); ?>
	<p id="message"></p>
<div class="container has-text-centered">
<div class="column is-offset-3 is-half">
<h3 class="title has-text-grey">Login</h3>
<p class="subtitle has-text-grey">Welcome back on Camagru</p>
<div class="box">
<div class="field">
  <label class="label">Name</label>
  <div class="control has-icons-left">
    <input class="input is-large" id="name" type="text" placeholder="Text input" required>
    <span class="icon is-small is-left">
      <i class="fas fa-user"></i>
    </span>
  </div>
</div>
<div class="field">
  <label class="label">Lastname</label>
  <div class="control has-icons-left">
    <input class="input  is-large" id="lastname" type="text" placeholder="Text input" required>
    <span class="icon is-small is-left">
      <i class="fas fa-user"></i>
    </span>
  </div>
</div>
<div class="field">
  <label class="label">Email</label>
  <div class="control has-icons-left">
    <input class="input is-large" id="email" type="email" placeholder="Email input" required>
    <span class="icon is-small is-left">
      <i class="fas fa-envelope"></i>
    </span>
  </div>
</div>
<div class="field">
  <label class="label">Pseudo</label>
  <div class="control has-icons-left">
    <input class="input is-large" id="pseudo" type="text" placeholder="Text input" required>
    <span class="icon is-small is-left">
      <i class="fas fa-user"></i>
    </span>
  </div>
</div>
<div class="field">
<label class="label">Password</label>
  <p class="control has-icons-left">
    <input id="password" class="input is-large" type="password" placeholder="Password" required>
    <span class="icon is-small is-left">
      <i class="fas fa-lock"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control has-icons-left">
    <input id="confirm" class="input is-large" type="password" placeholder="Password" required>
    <span class="icon is-small is-left">
      <i class="fas fa-lock"></i>
    </span>
  </p>
</div>
<div class="field is-grouped">
  <div class="control">
    <button class="button is-link" onclick="register()">Submit</button>
  </div>
</div>
</div>
</div>
</div>
</div>
	</div>
<?php $content = ob_get_clean(); ?>

<?php 
	require('template.php'); 
	
?>
