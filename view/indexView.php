<?php
if (!array_key_exists('user_id', $_SESSION))
	header("location:?action=login");
	$title = 'Mon blog';
	$css = array (
		"index.css"
	);
	$script = array(
		"index.js",
		"webcam.js",
		"displayMessage.js"
	);
	require_once("controller/indexController.php");
?>
<?php ob_start();?>
<p class="subtitle" id="message"></p>
<?php if (array_key_exists('user_id', $_SESSION)) {?>
	<div class="columns" style="height:100%">
		<div class="column is-one-third" style="overflow:auto">
		<p class="title">1. Choose your overlay !</p>
			<div class="dropdown is-active" style="width:100%">
				<div class="dropdown-trigger"style="width:100%">
				  <button class="button" aria-haspopup="true" aria-controls="dropdown-menu" style="width:100%">
				    <span class="icon is-small">
				      <i class="fas fa-angle-down" aria-hidden="true"></i>
				    </span>
				  </button>
				</div>
				<div class="dropdown-menu" id="dropdown-menu" role="menu" style="width:100%">
				  <div class="dropdown-content">
				  	<div class="media">
						<div class="media-content" style="display:flex; flex-direction:column">
							<?php $overlays = array_slice(scandir("images/overlays"),2);
								foreach ($overlays as $key => $value) {
									$overlay_type = explode('.', $overlays[$key])[1];
									?>
									<div class="box has-background-light has-text-centered"  style="display:inline-block" onclick="createOverlay('images/overlays/<?= $overlays[$key]?>', 0, 0, 100, 100)">
										<img id="imagetoadd" class="image is-128x128" style="margin:auto" src="images/overlays/<?= $overlays[$key]?>" draggable="true">
										<p class="subtitle">#<?= $overlay_type?></p>
									</div>
								<?php }?>
				 			</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="column is-one-third">
		<p class="title has-text-centered">2. Take a Picture !</p>
			<div class="box has-background-black is-paddingless" style="position:relative">
				<video id="video" style="position:absolute" class="is-square" draggable="false"></video>
				<canvas id="to-add" style="position:absolute;"></canvas>
				<img id="uploadedpicture" style="display:none" src="#"></canvas>
				<img id="photo" alt="photo" class="image" style="position:absolute; display:none">
			<canvas id="picture" style="display:none"></canvas>		
			</div>
			<div id="takepicturemenu" style="padding-top:40px;margin:auto">
				<button id="takepicture" class="button is-primary" >Prendre une photo</button>
				<button id="reducesize" class = "button is-danger">Reduce size</button>
				<button id="increasesize" class = "button is-success">Increase size</button>
				<p class="subtitle" style="padding-top:20px">You can also download your image</p>
        		<input type="file" onchange="uploadImage(this)" class="button is-primary" name="myfile" id="fileToUpload">
        		<button class="button is-primary" > Upload your image </button>
			</div>
			<div id="pictureButton" style="display:none; position:absolute; margin-top:300px;" class="has-text-grey">
			<p class="title has-text-centered">3. Save the result !</p>
					<a id="validatePicture" class="button is-primary" onclick="">
						<span class="icon is-large">
	        				<i class="far fa-check-square"></i>
	      				</span>
					</a>
					<a id="cancelPicture" class="button is-danger" onclick="">
						<span class="icon is-large">
							<i class="far fa-window-close"></i>
						</span>
					</a> 
	        </div>
		</div>
		<div class="column is-one-third is-multiline">
		<p class="title has-text-centered"> My pictures</p>
<div id = "mypictures" class = "columns is-multiline">
<?php if (!empty($user_pictures)){
	foreach ($user_pictures as $key => $value) {
		?>
	<div id= "picture<?= $user_pictures[$key]['image_id']?>"class="box column is-fullwidth">
		<div class="card">
			<div class="card-image">
				<figure class="image" height="80%" width="80%">
  					<img src="<?php echo $user_pictures[$key]["image_path"]?>" alt="Placeholder image">
				</figure>
			</div>
		</div>
		<div class="card-content">
			<div class="content">
				<a style ="width:100%" class="button is-danger" id="deletepicture" onclick="deletePicture('<?= $user_pictures[$key]['image_path']?>', <?= $user_pictures[$key]['image_id']?>)">
				<span class="icon">
					<i class="fas fa-trash"></i>
				</span>
				<span>Delete Picture</span>
				</a>
			</div>
		</div>
	</div>
					<?php }} else
					echo "You don't have images yet !" ?>
</div>						
		</div>
	</div>
<?php } else 
{
	echo "Please login or register to be able to take pictures";	
}?>
<?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
