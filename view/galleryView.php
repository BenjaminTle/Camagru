<?php
session_start();
$title = 'Gallery';
$css = array (
);
$script = array(
	"gallery.js",
	"displayMessage.js"
);
$user_id = $_SESSION['user_id'];
require_once("controller/galleryController.php");

ob_start(); ?>
<p id="message"></p>
<p class="subtitle has-text-centered">There is currently <span id="nbpicture"><?= $nb_picture ?></span> Pictures in the gallery</p>
<div class="columns is-multiline" id="thegallery">
<?php
	if(!empty($pictures)) {
	foreach ($pictures as $key => $value) {
		$liked = image_is_liked($pictures[$key]["image_id"], $_SESSION['user_id'], $dbh);
		//echo $liked;
		$user_info = get_user_infos($pictures[$key]["user_id"], $dbh);
		//$nb_like = get_nb_like($pictures[$key]["image_id"]);
		?>
	<div class="box column is-one-third" id="section<?= $pictures[$key]["image_id"] ?>" style="display:none">
		<div class="card">
			<div class="card-image">
				<figure class="image" height="80%" width="80%">
  					<img src="<?php echo $pictures[$key]["image_path"]?>" alt="Placeholder image">
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
  				<time datetime="2016-1-1"><?php echo $pictures[$key]['timestamp']?></time>
				<?php if (array_key_exists('user_id', $_SESSION) && $_SESSION['status'] == 1) {?>
					<span id="<?php echo "like-" . $pictures[$key]['image_id']?>" class="icon <?php if ($liked == 0){echo "has-text-grey";}else{echo "has-text-danger";} ?> is-medium" onclick="likeManager(<?php echo $pictures[$key]['image_id']?>, <?php echo image_nb_like($pictures[$key]['image_id'],$dbh) ?>, <?php echo $pictures[$key]['user_id']?>)">
						<i class="fas fa-lg fa-heart" ></i>
					</span>
				<?php } ?>
				<p id ="<?php echo "countlike1" . $pictures[$key]['image_id'] ?>"><?php echo image_nb_like($pictures[$key]['image_id'],$dbh)?> person like this picture</p> 
				<div class="field">
					<div class="control">
					<?php if (array_key_exists('user_id', $_SESSION) && $_SESSION['status'] == 1) {?>
						<textarea id="<?php echo "addcomment-1" . $pictures[$key]['image_id']?>" class="textarea is-info" placeholder="Write you comment here"></textarea>
						<a style ="width:100%" class="button is-primary" id="addcomment" onclick="addComment(<?= $pictures[$key]['image_id']?>, '<?php echo $_SESSION['name'] ?>', '<?php echo $_SESSION['pseudo'] ?>', 1, <?php echo $pictures[$key]['user_id']?>)">
							<span class="icon">
							<i class="fas fa-comment"></i>
							</span>
							<span>Send your comment</span>
						</a>
					<?php } ?>
						<a style="width:100%" class="button is-info modal-button" id="<?php echo "seecomment-" . $pictures[$key]['image_id']?>" onclick="openModal('<?= $pictures[$key]['image_path'] ?>', '<?= $pictures[$key]['image_id']?>')">
							<span class="icon">
							<i class="fas fa-comments"></i>
							</span>
							<span>See all comments</span>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="modal" id="<?php echo "modal" . $pictures[$key]['image_id'] ?>" style="display:none">
		<div class="modal-background" id="modalBg" onclick="closeModal(<?= $pictures[$key]['image_id']?>)"></div>
			<div class="modal-content" style="width:80%;margin-top:5%;">
				<div class="columns is-gapless" style="width:100%;background-color:white">
					<div class="column is-half">	
						<img id="<?php echo 'modalImage' . $pictures[$key]['image_id']?>" style="width:100%;height:auto">
						<div class="columns">
							<div class="column">
								<div class="media is-centered">
									<div class="media-content">
										<p class="title is-4"><?php echo $user_info['name'] . " " . $user_info['lastname']?></p>
	    								<p class="subtitle is-6">@<?php echo $user_info['pseudo']?></p>
	  								</div>
								</div>
								<div class="content">
	  								<time datetime="2016-1-1"><?php echo $pictures[$key]['timestamp']?></time>
									<p id ="<?php echo "countlike2" . $pictures[$key]['image_id']?>"><?php echo image_nb_like($pictures[$key]['image_id'],$dbh)?> person like this picture</p>
								</div>
							</div>
							<?php if (array_key_exists('user_id', $_SESSION) && $_SESSION['status'] == 1) {?>
							<div class="column">
									<div class="field">
										<div class="control">
											<textarea id="<?php echo "addcomment-2" . $pictures[$key]['image_id']?>" class="textarea is-info" placeholder="Write you comment here"></textarea>
											<a style ="width:100%" class="button is-primary" id="addcomment" onclick="addComment(<?php echo $pictures[$key]['image_id']?> , '<?php echo $_SESSION['name'] ?>' , '<?php echo $_SESSION['pseudo'] ?>', 2, <?php echo $pictures[$key]['user_id']?>)">
												<span class="icon">
													<i class="fas fa-comment"></i>
												</span>
												<span>Send your comment</span>
											</a>
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
						</div>
						<div class="column is-half has-background-white has-text-centered">
							<p id= "<?php echo 'commentlist' . $pictures[$key]['image_id']?>" class = "subtitle">Publication's comments</p>
							<?php $picture_comment = [];
							if (!empty($comments))
							{
								foreach ($comments as $key2 => $value) {
									if ($comments[$key2]['image_id'] == $pictures[$key]['image_id'])
									{
										$picture_comment[] = $comments[$key2];
									}	
								}
							}
							if (!empty($picture_comment))
							{
								$picture_comment = array_reverse($picture_comment);
								foreach ($picture_comment as $key3 => $value) {
									require_once("model/User.Class.php");
									$user_comment = new User($picture_comment[$key3]['user_id'], $dbh)
									?>
									<div class="box">
  										<article class="media">
    										<div class="media-content">
      											<div class="content">
        											<p><strong><?= $user_comment->getName();?></strong> <small>@<?= $user_comment->getPseudo(); ?></small><br>
													<?= $picture_comment[$key3]['text']?>
        											</p>
      											</div>
    										</div>
  										</article>
									</div>
									<?php
								}
							} else {
								echo "no comment yet !";
							}
								?>
						</div>
					</div>
				</div>
			</div>
			<?php }} ?>
</div>
	<style>
</style>

	
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
