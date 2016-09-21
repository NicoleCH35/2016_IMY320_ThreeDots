$(document).ready(function ()
{
	$(".form-control").click(function()
	{
		$(this).css('border-color','#c4c4c4');

	});

	///////////////////////////////////////////////////////////////////////////////////////////////////
	//INDIVIDUAL MESSAGE
	$('#iMessage').on("click", function (e)
	{
		e.preventDefault();
		//alert("in");

		areErrors =false;
		Errormessage = "Please fill in all the form fields";
		//alert("clicked");

		var body = $("#bodyI").val();
		var user = $("#userSelect option:selected").val();
		var subject = $("#subjI").val();
		//alert(body);

		if(subject=="")
		{
			areErrors = true;
			$("#subjI").css('border-color', 'red');
		}

		if(user == "Recipient")
		{
			areErrors = true;
			$("#userSelect").css('border-color', 'red');
		}

		if(areErrors)
		{
			$("#errorMsg_iMessage").text(Errormessage).css('color', 'red');
		}
		else
		{
			$("#errorMsg_iMessage").text("");
			$.post("userEmail.php", {subject: subject, body : body, userID : user})
				.done(function(e)
				{
					//alert(e);
					window.location.replace("../pages/admin.php");
				});
		}

	});
	///////////////////////////////////////////////////////////////////////////////////////////////////
	//WORK GROUP MESSAGE
	$('#wgMessage').on("click", function (e)
	{
		//alert("in");
		e.preventDefault();


		areErrors =false;
		Errormessage = "Please fill in all the form fields";
		//alert("clicked");

		var body = $("#bodyW").val();
		var group = $(".WGTeams:checked").val();
		var subject = $("#subjW").val();
		//alert(subject);

		if(subject=="")
		{
			areErrors = true;
			$("#subjW").css('border-color', 'red');
		}


		if(group == null)
		{
			areErrors = true;
			//$(".WGTeams").css('border-color', 'red');
		}

		if(areErrors)
		{
			$("#errorMsg_wMessage").text(Errormessage).css('color', 'red');
		}
		else
		{
			$("#errorMsg_wMessage").text("");
			$.post("workgroupEmail.php", {subject: subject, body : body, groupID : group})
				.done(function(e)
				{
					//alert(e);
					window.location.replace("../pages/admin.php");
				});
		}

	});

	///////////////////////////////////////////////////////////////////////////////////////////////////
	//EVENT MESSAGE
	$('#eMessage').on("click", function (e)
	{
		e.preventDefault();
		areErrors =false;
		Errormessage = "Please fill in all the form fields";
		//alert("clicked");

		var body = $("#bodyE").val();
		var event = $("#eventSelect option:selected").val();
		var group = $(".EventTeams:checked").val();
		var subject = $("#subjE").val();
		//alert(subject);

		if(subject=="")
		{
			areErrors = true;
			$("#subjE").css('border-color', 'red');
		}

		if(event == "event")
		{
			areErrors = true;
			$("#eventSelect").css('border-color', 'red');
		}

		if(group == null)
		{
			areErrors = true;
			//$(".EventTeams").css('border-color', 'red');
		}

		if(areErrors)
		{
			$("#errorMsg_eMessage").text(Errormessage).css('color', 'red');
		}
		else
		{
			$("#errorMsg_eMessage").text("");
			$.post("eventEmail.php", {subject: subject, body : body, eventID : event, groupID : group})
				.done(function(e)
				{
					//alert(e);
					window.location.replace("../pages/admin.php");
				});
		}
		//alert(checked);

	});

});
