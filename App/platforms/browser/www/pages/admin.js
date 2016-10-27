$(document).ready(function ()
{
	$("#msgForm").submit(function(e)
	{

		e.preventDefault();
		//alert("in");
		var subj = $("#subjE").val();
		var msg = $("#bodyE").val();
		var xhttp7 = new XMLHttpRequest();
		xhttp7.onreadystatechange = function()
		{

			if (this.readyState == 4 && this.status == 200)
			{
				//alert(this.responseText);
				window.location.replace("messages.html");
			}
		};
		xhttp7.open("POST", "http://threedots.site88.net/pages/php_Files/broadcastMessage.php", true);
		xhttp7.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhttp7.send("subject=" + subj + "&message=" + msg);
	});
});
