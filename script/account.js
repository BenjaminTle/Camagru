function update_infos(user_id)
{
	var action = "updateinfos";
	var name = document.getElementById("name").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	var pseudo = document.getElementById("pseudo").value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/modifUserController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('user_id=' + user_id + '&name=' + name + '&lastname=' + lastname + '&email=' + email + '&pseudo=' + pseudo + '&action=' + action);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
				display_msg("Your informations has been updated", "green");
			else
				display_msg(xhr.responseText, "red");
		}
	});
}
function reset_password (user_id)
{
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/updatePwdController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('user_id=' + user_id);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
			{
				display_msg("An email have been sent to your adress to reinitialize your password", "green");
				setTimeout(function (){window.location.replace("index.php");}, 3000);
				
			}
			else
				display_msg(xhr.responseText, "red");
		}
	});
}

function update_password(user_id)
{
	var action = "updatepassword";
	var newpassword = document.getElementById("newpassword").value;
	var confirm = document.getElementById("confirm").value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/modifUserController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('user_id=' + user_id + '&newpassword=' + newpassword + '&confirm=' + confirm +'&action=' + action);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
			{
				display_msg("Your password has been updated, redirecting...", "green");
				setTimeout(function (){window.location.replace("index.php");}, 3000);
				
			}
			else
				display_msg(xhr.responseText, "red");
		}
	});
}

function forgot_password()
{
	var mail = document.getElementById("email").value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/updatePwdController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('mail=' + mail);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
			{
				display_msg("An email have been sent to your adress to reinitialize your password", "green");
				setTimeout(function (){window.location.replace("index.php");}, 3000);
				
			}
			else
				display_msg(xhr.responseText, "red");
		}
	});

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

function comment_mail()
{
	//console.log(document.getElementById("comment-check").checked);
	if (document.getElementById("comment-check").checked == false){
		var checked = 1;
		
		//console.log(document.getElementById("comment-check").checked);
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/accountController.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('comment_check=' + checked);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText === "ok")
				{
					display_msg("You'll not receive mail anymore", "green");
				}
				else
					display_msg(xhr.responseText, "red");
			}
		});
	}
	else if(document.getElementById("comment-check").checked == true){
		var checked = 0;
		document.getElementById("comment-check").checked = true;
		//console.log(document.getElementById("comment-check").checked);
		var xhr = new XMLHttpRequest();
		xhr.open('POST', 'controller/accountController.php', true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send('comment_check=' + checked);
		xhr.addEventListener('readystatechange', function() {
			if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
				if(xhr.responseText === "ok")
				{
					document.getElementById("comment-check").checked = true;
					display_msg("You'll receive mail when someone comment your picture", "green");
				}
				else
					display_msg(xhr.responseText, "red");
			}
		});
	}
}
