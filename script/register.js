function register()
{
	var name = document.getElementById("name").value;
	var lastname = document.getElementById("lastname").value;
	var email = document.getElementById("email").value;
	var pseudo = document.getElementById("pseudo").value;
	var password = document.getElementById("password").value;
	var confirm = document.getElementById("confirm").value;
	var xhr = new XMLHttpRequest();
	xhr.open('POST', 'controller/registerController.php', true);
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send('name=' + name + '&lastname=' + lastname + '&email=' + email + '&pseudo=' + pseudo + '&password=' + password + '&confirm=' + confirm);

	xhr.addEventListener('readystatechange', function() {
		if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
			if(xhr.responseText === "ok")
			{
				display_msg("Compte créé avec succès, nous allons vous rediriger vers la page de confirmation dans quelques secondes", "green");
				setTimeout(function (){window.location.replace("view/activateaccountView.php");}, 1500);
			}
			else 
				display_msg(xhr.responseText, "red");
		}
	});
}
