function uploadImage(input){
	file = document.getElementById("fileToUpload");
	if (!file.value)
		display_msg("Please choose a file and try again", "red");
	else{
		if (file.value.split('.').pop() !== "png")
			display_msg("Only PNG file, please try again", "red");
		else
		{
			var preview = document.getElementById("uploadedpicture");
				preview.src = URL.createObjectURL(event.target.files[0]);
				preview.style.display = "block";
				preview.width = document.getElementById("to-add").width;
				preview.height = document.getElementById("to-add").height;
			var video = document.getElementById("video");
			video.style.zIndex = "-1000";
		}
	}
}


function deletePicture(image_path, image_id)
{
	image = document.getElementById("picture" + image_id);
	image.style.display = "none";
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/accountController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('image_path=' + image_path);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
			{
				display_msg("Image deleted successfully", "green");
			}
			else
				display_msg(xhr.responseText, "red");
		}
	});
}
