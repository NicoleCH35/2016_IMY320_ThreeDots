$(document).ready(function ()
{
	//alert("in");
	$("#loginForm").submit(function(e)
	{
		e.preventDefault();
		var done2 = true;
		$(".Linput2").each(function()
		{
			if($(this).val() == '')
			{
				$(this).css('border-color', 'red');
				//alert(this);
				done2 = false;
			}

		});

		if(done2)
		{
			var userN = $("#username").val();
			var pass = $("#password").val();

			//alert(userN);
			//alert(pass);

			var xhttp7 = new XMLHttpRequest();
			xhttp7.onreadystatechange = function()
			{
				if (this.readyState == 4 && this.status == 200)
				{
					//document.getElementById("response").innerHTML = this.responseText;
					//alert(this.responseText);
					if(this.responseText=="admin")
					{
						window.location.replace("admin.html");
						//alert("admin");
					}
					else if(this.responseText=="user")
					{
						window.location.replace("../index.html");
						//alert("user");
					}
					else if(this.responseText=="error")
					{
						$("#errorHead").html("The username and password you entered do not match!");
						//$("#errorHead").css("{'color': 'red'}");
						//alert("error");
					}
				}
			};
			xhttp7.open("POST", "http://threedots.site88.net/pages/php_Files/validate_login.php", true);
			xhttp7.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xhttp7.send("username=" + userN + "&password=" + pass);
		}
		//alert("in");

	});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#signupForm").submit(function(e)
	{
		e.preventDefault();
		//alert("in");


		var done = true;

		$(".SUinput").each(function(){
			if($(this).val() == '')
			{
				$(this).css('border-color','red');
				done=false;
			}

		});

		//alert(done);
		if(done)
		{
			var areNoErrors = true;

			var emailM = $("#email");
			var email=emailM .val().search(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/);

			var passMain = $("#password");
			var pass = passMain.val();

			var conPass = $("#passwordC");


			if(email!=0)
			{
				emailM.css('border-color','red');
				areNoErrors = false;
			}
			//alert("in "+areNoErrors);

			if(conPass.val()!= pass)
			{

				conPass.css('border-color','red');
				areNoErrors = false;
			}
			//alert("in2 "+areNoErrors);
			if(areNoErrors)
			{
				//alert("in ne");
				var userN = $("#username").val();
				var pass = $("#password").val();
				var email = $("#email").val();
				//alert(userN);
				//alert(pass);

				var xhttp7 = new XMLHttpRequest();
				xhttp7.onreadystatechange = function()
				{
					if (this.readyState == 4 && this.status == 200)
					{
						//document.getElementById("response").innerHTML = this.responseText;
						//alert(this.responseText);
						if(this.responseText=="usernameF")
						{
							$("#errorHead").html("The username you entered is already in use!");
						}
						else if(this.responseText=="emailF")
						{
							$("#errorHead").html("The email you entered is already in use!");
						}
						else if(this.responseText=="success")
						{
							window.location.replace("../index.html");
						}
					}
				};
				xhttp7.open("POST", "http://threedots.site88.net/pages/php_Files/validate_signup.php", true);
				xhttp7.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp7.send("username=" + userN + "&password=" + pass+"&email="+email);
			}
		}





	});
});


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(".Linput2").click(function()
{
	$(this).css('border-color', 'transparent');

});

$(".SUinput").click(function()
{
	$(this).css('border-color', 'transparent');

});
