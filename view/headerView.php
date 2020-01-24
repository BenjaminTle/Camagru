<?php
	$link = array(
		'Gallery' => 'http://localhost:8100/camagru/?action=gallery'
	);
	if (array_key_exists("user_id", $_SESSION))
	{
		$link['Account'] = "http://localhost:8100/camagru/?action=account";
		$link['Logout'] = "http://localhost:8100/camagru/?action=logout";
	}
	else
	{
		$link['Register'] = "http://localhost:8100/camagru/?action=register";
		$link['Login'] = "http://localhost:8100/camagru/?action=login";
	}
?>
<nav class="navbar">
	<div class="navbar-brand center">
		<a class="navbar-item" href="http://localhost:8100/camagru/">
		  <img class="logo" src="images/logo_transparent_camagru.png" width="128" height="128">
		</a>
		<a role="button" class="navbar-burger" data-target="navMenu" aria-label="menu" aria-expanded="false">
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
			<span aria-hidden="true"></span>
		</a>
	</div>
	<div class="navbar-menu" id="navMenu">
		<div class="navbar-start">
		<?php
			foreach ($link as $key => $value) {
				echo "<a href=\"" . $value ."\" class=\"navbar-item is-tab is-size-3\">" . $key ."</a>";
			}
		?>
		</div>
		<div class="navbar-end">
		<?php 
			if(array_key_exists("user_id", $_SESSION)) {?>
			<div class="navbar-item horizontal-align">
				<p class="navbar-item is-size-5" style="padding-left: 0rem">Nice to see you <?php echo $_SESSION['name']?> </p>
				<div class="is-primary vertical-align">
					<a href="http://localhost:8100/camagru/?action=account" class="is-size-6">My account</a>
					<a href="http://localhost:8100/camagru/?action=logout" class="is-size-6">Log-out</a>
				</div>
			</div>

		<?php } else { ?>
			<div class="navbar-item horizontal-align">
				<p class="navbar-item is-size-5" style="padding-left: 0rem">You're not connected yet:</p>
				<div class="is-primary vertical-align">
					<a href="http://localhost:8100/camagru/?action=login" class="is-size-6">Log-in</a>
					<a href="http://localhost:8100/camagru/?action=register" class="is-size-6">Register</a>
				</div>
			</div>
		</div>
		<?php } ?>
	</div>
</nav>
