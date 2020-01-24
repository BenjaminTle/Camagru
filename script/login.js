function checkLogin()
{
	var email = document.getElementById("email").value;
	var password = document.getElementById("password").value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/loginController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('email=' + email + '&password=' + password);
	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
			{
				display_msg("Connected, Redirecting on homepage", "green");
				setTimeout(function (){window.location.replace("index.php");}, 1500);
			}
			else
				display_msg(xhr.responseText, "red");
		}
	});
}
