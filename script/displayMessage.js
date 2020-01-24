function display_msg(message, color)
{
	elem = document.getElementById('message');
	elem.style.display = "block";
	elem.style.width="100%";
	elem.style.height="3%";
	elem.style.margin="auto";
	elem.style.textAlign="center";
	elem.style.borderRadius="15px";
	elem.style.backgroundColor = color;
	elem.innerHTML = message;
	elem.style.color = "white";
	elem.classList.toggle("subtitle")
	setTimeout(function (){elem.style.display = "none"}, 5000);
	elem.classList.toggle("subtitle")
}
