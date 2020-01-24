(function() {

  var streaming = false,
		picturemenu = document.getElementById("takepicturemenu");
    	video        = document.getElementById("video");
    	cover        = document.getElementById("cover");
		picture       = document.getElementById("picture");
		uploadedpicture = document.getElementById("uploadedpicture");
    	photo        = document.getElementById("photo");
		button  		= document.getElementById("takepicture");
		canvas = document.getElementById("to-add");
		imgToAdd = document.getElementById("imagetoadd");
		pictureValidation = document.getElementById("pictureButton");
    	width = 520,
	  height = 520;
	  picturemenu.style.marginTop = video.offsetHeight;
	  pictureValidation.style.marginTop = video.offsetHeight;
	var constraints = { video: {width: width, height: height}, audio: false };
  navigator.getMedia = ( navigator.getUserMedia ||
                         navigator.webkitGetUserMedia ||
                         navigator.mozGetUserMedia ||
                         navigator.msGetUserMedia);

	navigator.mediaDevices.getUserMedia(constraints)
    .then(function(stream) {
      if (navigator.mozGetUserMedia) {
        video.srcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.srcObject = stream;
	  }
	  
	  video.play();
    })
    .catch(function(err) {});

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
		height = width;
		picturemenu.style.marginTop = video.offsetHeight;
    	video.setAttribute('width', width);
		video.setAttribute('height', height);
    	picture.setAttribute('width', width);
    	picture.setAttribute('height', height);
		streaming = true;
		document.getElementById("to-add").width = video.offsetWidth;
		document.getElementById("to-add").height = video.offsetHeight;
    }
  }, false);

  function takepicture() {
	if (overlay === true)
	{
		var toDraw = video.style.zIndex == "-1000" ? uploadedpicture : video;
    	picture.width = video.offsetWidth;
		picture.height = video.offsetHeight;
		//console.log(video.style.zIndex == "-1000" ? "lol": "paslol");
    	picture.getContext('2d').drawImage(toDraw, 0, 0, video.offsetWidth, video.offsetHeight);
		pictureValidation.style.marginTop = video.offsetHeight;
		document.getElementById("pictureButton").style.display = "block";
		picturemenu.style.display = "none";
		picture = document.getElementById("picture");
		overlay = document.getElementById("to-add");
		pictureData = picture.toDataURL('image/png');
		pictureData = pictureData.replace("data:image/png;base64,", "");
		overlayData = overlay.toDataURL('image/png');
		overlayData = overlayData.replace("data:image/png;base64,", "");
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/create_image.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('action=build&dst=' + pictureData + '&src=' + overlayData
				+ '&dst_x=0&dst_y=0&src_x=0&src_y=0&src_w=' + video.offsetWidth + '&src_h=' + video.offsetWidth);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText != "error")
				{
					photo.offsetHeight = video.offsetHeight;
					photo.offsetWidth = video.offsetWidth;
					photo.style.display = "block";
					photo.setAttribute('src', xhr.responseText.replace("../", ""));
				}
				else
					display_msg("error while building your picture, please try again", "red");
			}
		});
	}
	else
		display_msg("You need to put at least one element on your picture !", "red");
	
}

	button.addEventListener('click', function(ev){
	    takepicture();
	  ev.preventDefault();
	}, false);

})();
	context = canvas.getContext('2d');
	rect = canvas.getBoundingClientRect();
	overlay = false;
	overlayAddr = null;
	isMoving = false;
	overlayX = 0;
	overlayY = 0;
	overlayWidth = 0;
	overlayHeight = 0;
	base_image = new Image();
	picturemenu = document.getElementById("takepicturemenu");
	canvas.addEventListener('mousedown', e => {
		if (overlay === true)
		{
			overlayX = e.clientX - rect.left;
			overlayY = e.clientY - rect.top;
			isMoving = true;
		}
	});

	canvas.addEventListener('mousemove', e => {
		if (isMoving === true) {
			newX = e.clientX - rect.left - overlayWidth/2;
			newY = e.clientY - rect.top - overlayHeight/2;
			createOverlay(overlayAddr, newX, newY, overlayWidth, overlayHeight);
			overlayX = newX;
			overlayY = newY;
		}
	});

	canvas.addEventListener('mouseup', e => {
		if (isMoving === true) {
			newX = e.clientX - rect.left - overlayWidth/2;
			newY = e.clientY - rect.top - overlayHeight/2;
			createOverlay(overlayAddr, newX, newY, overlayWidth, overlayHeight);
    		isMoving = false;
  		}
	});

	function createOverlay(imgAddr, x, y, width, height){
		base_image.src = imgAddr;
		canvas.width = video.offsetWidth;
		canvas.height = video.offsetHeight;
		overlayY = y;
		overlayX = x;
		overlayWidth = width;
		overlayHeight = height;
		base_image.onload = function(){
			context.drawImage(base_image, overlayX, overlayY, overlayWidth, overlayHeight);
			overlay = true;
			overlayAddr = imgAddr;
			overlayY = y;
			overlayX = x;
		}
	}

	window.addEventListener('resize', function () {
	canvas.width = video.offsetWidth;
	canvas.height = video.offsetHeight;
	photo.width = video.offsetWidth;
	photo.height = video.offsetHeight;

	uploadedpicture.offsetWidth = video.offsetWidth;
	uploadedpicture.offsetHeight = video.offsetHeight;
	picturemenu.style.marginTop = video.offsetHeight;
	if (overlay === true && overlayAddr != null)
		createOverlay(overlayAddr, 0, 0, overlayWidth, overlayHeight);
	});

	document.getElementById("validatePicture").addEventListener("click", function (){
		picturemenu.style.marginTop = video.offsetHeight;
		newimage = `<div id= "picture${photo.src}"class="box column">
		<div class="card">
			<div class="card-image">
				<figure class="image" height="80%" width="80%">
  					<img src="${photo.src}" alt="Placeholder image">
				</figure>
			</div>
		</div>
		<div class="card-content">
			<div class="content">
				<a style ="width:100%" class="button is-danger" id="deletepicture" onclick="deletePicture('${photo.src}', '${photo.src}')">
				<span class="icon">
					<i class="fas fa-trash"></i>
				</span>
				<span>Delete Picture</span>
				</a>
			</div>
		</div>
	</div>`
	document.getElementById("mypictures").insertAdjacentHTML("afterbegin", newimage);
		document.getElementById("pictureButton").style.display = "none";
		document.getElementById("photo").style.display = "none";
		picturemenu.style.display = "block";
		overlay = true;
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/create_image.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('action=save&imagepath=' + photo.src);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText === "ok")
				{
					
					display_msg("image saved successfully", "green");
				}
				else
					display_msg(xhr.responseText, "red");
			}
		});
	});

	document.getElementById("cancelPicture").addEventListener("click", function (){
		picturemenu.style.marginTop = video.offsetHeight;
		document.getElementById("pictureButton").style.display = "none";
		document.getElementById("photo").style.display = "none";
		picturemenu.style.display = "block";
		overlay = true;
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/create_image.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('action=cancel&imagepath=' + photo.src);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText === "ok")
				{
					display_msg("image deleted, you can take another one if you want", "green");
				}
				else
					display_msg(xhr.responseText, "red");
			}
		});
	});

	document.getElementById("increasesize").addEventListener("click", function() {
		if(overlayWidth * 1.1 < video.offsetWidth)
		{
			overlayWidth *= 1.1;
			overlayHeight *= 1.1;
		}
		createOverlay(overlayAddr, overlayX, overlayY, overlayWidth, overlayHeight);
	})

	document.getElementById("reducesize").addEventListener("click", function() {
		if(overlayWidth / 1.1 > 80)
		{
			overlayWidth /= 1.1;
			overlayHeight /= 1.1;
		}
		createOverlay(overlayAddr, overlayX, overlayY, overlayWidth, overlayHeight);
	})
