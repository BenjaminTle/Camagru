<?php
session_start();
$title = 'My Account';
$css = array (
);
$script = array(
	
	"displayMessage.js",
	"account.js"
);
$user_id = $_SESSION['user_id'];
require_once("controller/accountController.php");
require_once("controller/galleryController.php");
ob_start();
if ($_SESSION['status'] == 1)
{
?>
<p id="message"></p>
<div style="padding-top:100px" class="has-text-centered">
	<p class="title"> Hi <?= $user_infos['name'] ?> </p>
	<p class="subtitle">If you want to change your infos or delete your pictures, you're in the right place ! </p>
	<div class = "columns is-vcentered">
		<div class="column">
			<p class="title"> Account information </p>
			<?php
				foreach ($user_infos as $key => $value) {
					echo "<label class='subtitle'> $key <input type =\"text\" id='$key' name = '$key' placeholder='$value' value='$value' required></label><br>";
				}
			?>
			<div class="checkbox has-text-centered" style="width:100%; margin:auto">
  	<input id="comment-check" type="checkbox" <?php if ($_SESSION['comment_mail'] == 1) {echo 'checked';};?> onclick="comment_mail()">
  	Receive mail when someone comment my pictures
</div>
			<button class="button is-danger" name="update" onclick="update_infos(<?= $user_id ?>)">update infos</button>
		</div>
		<div class="column has-text-centered">
			<p class="title"> Password update</p>
			<button class="button is-danger" name="updatepassword" onclick="reset_password(<?= $user_id ?>)">update password</button>
		</div>
	</div>
</div>
<p class="title has-text-centered"> My pictures</p>
<div class = "columns is-multiline">
<?php if (!empty($user_pictures))
{
	foreach ($user_pictures as $key => $value) {
		$liked = image_is_liked($user_pictures[$key]["image_id"], $_SESSION['user_id'], $dbh);
		//echo $liked;
		$user_info = get_user_infos($user_pictures[$key]["user_id"], $dbh);
		//$nb_like = get_nb_like($user_pictures[$key]["image_id"]);
		?>
	<div id= "picture<?= $user_pictures[$key]['image_id']?>"class="box column is-one-third">
		<div class="card">
			<div class="card-image">
				<figure class="image" height="80%" width="80%">
  					<img src="<?php echo $user_pictures[$key]["image_path"]?>" alt="Placeholder image">
				</figure>
			</div>
		</div>
		<div class="card-content">
			<div class="media is-centered">
				<div class="media-content">
					<p class="title is-4"><?php echo $user_info['name'] . " " . $user_info['lastname']?></p>
    				<p class="subtitle is-6">@<?php echo $user_info['pseudo']?></p>
  				</div>
			</div>
			<div class="content">
  				<time datetime="2016-1-1"><?php echo $user_pictures[$key]['timestamp']?></time>
				<a style ="width:100%" class="button is-danger" id="deletepicture" onclick="deletePicture('<?php echo $user_pictures[$key]['image_path']?>',<?= $user_pictures[$key]['image_id']?>, <?= $_SESSION['user_id'] ?>)">
				<span class="icon">
					<i class="fas fa-trash"></i>
				</span>
				<span>Delete Picture</span>
				</a>
			</div>
		</div>
	</div>
					<?php }} ?>
</div>
	<?php } else if($_SESSION['status'] == 1){?>
	<p class = "subtitle"> Please go to you email and validate your account to access this section </p>
	<?php } else if (empty($user_pictures)){?>
	<p class = "subtitle"> Go take a picture dude :) </p>
	<?php }$content = ob_get_clean(); ?>

<?php require('template.php'); ?>
