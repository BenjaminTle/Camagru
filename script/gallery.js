window.onload = function () {
	totalPic = document.getElementById("nbpicture").textContent;
	gallery = document.getElementById("thegallery");
	nodes = gallery.children
	node_nb = 0;
	max_pic = 6;
	for (displayedPic = 0; displayedPic < max_pic * 2; displayedPic+=2) {
		if (displayedPic <= nodes.length - 1)
			nodes[displayedPic].style.display = "block";
		
	}
}

function addComment(image_id, user_name, user_pseudo, location, poster_id){
	comment = document.getElementById("addcomment-" + location + image_id);
	if (comment.value != "")
	{
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/commentController.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('text=' + comment.value + '&image_id=' + image_id + "&poster_id=" + poster_id);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText === "ok")
				{
					display_msg("Successfully add you comment :)", "green");
					newcom = `<div class="box">
					<article class="media">
		  				<div class="media-content">
							<div class="content">
				 				 <p><strong>${user_name}</strong> <small>@${user_pseudo}</small><br>
				  					${comment.value}
				 				 </p>
							</div>
		 				 </div>
					</article>
  				</div>`
		document.getElementById("commentlist" + image_id).insertAdjacentHTML("afterend", newcom);
				}
				else
					display_msg(xhr.responseText, "red");
			}
		});
	}
}

function likeManager(image_id, nb_like, poster_id)
{ 
	like = document.getElementById("like-" + image_id);
	countlike1 = document.getElementById("countlike1" + image_id);
	countlike2 = document.getElementById("countlike2" + image_id);
	likes = parseInt(countlike1.innerHTML);
	var action = null;
	if (like.classList.contains("has-text-grey"))
	{
		action = "add";
		likes += 1;
		like.classList.add('has-text-danger');
		like.classList.remove('has-text-grey');
	}
	else
	{
		action = "remove";
		likes -= 1;
		like.classList.add('has-text-grey');
		like.classList.remove('has-text-danger');
	}
	document.getElementById("countlike1" + image_id).innerHTML = likes + " person like this picture";
	document.getElementById("countlike2" + image_id).innerHTML = likes + " person like this picture";
	var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/likeController.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('action=' + action + '&image_id=' + image_id + "&poster_id=" + poster_id);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText != "ok")
					display_msg(xhr.responseText, "red");
			}
		});
}

//One Modal
function openModal(imagePath, imageId) {
	//console.log (imagePath);
	//console.log(imageId);
	modalname = "modal" + imageId;
	//console.log(modalname)
	modal = document.getElementById(modalname);
	var body = document.body;
	body.display = "none";
    //Change style to display = "block"
	modal.style.display = "block";
	document.getElementById("modalImage" + imageId).src = imagePath
	document.getElementById("modalImage")
}

function closeModal(imageId){
	modalname = "modal" + imageId;
	modal = document.getElementById(modalname);
    modal.style.display = "none";
}

window.onscroll = function(ev) {
	if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight) {
	  max_pic += 6;
	  while(displayedPic <= nodes.length - 1 && displayedPic < max_pic * 2)
		{
			nodes[displayedPic].style.display = "block";
			displayedPic +=2;
		}
	}
  };
