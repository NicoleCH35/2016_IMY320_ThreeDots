$(".Linput").click(function()
{
	$(this).css('border-color', 'transparent');

});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function validateLogin()
{
	var done2 = true;
	$(".Linput").each(function()
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
		//alert("fine");
		return true;
	}
	else
	{
		//alert("not fine");
		return false;
	}

}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$(".Linput2").click(function()
{
	$(this).css('border-color', 'transparent');

});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function validateLogin2()
{
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
		//alert("fine");
		return true;
	}
	else
	{
		//alert("not fine");
		return false;
	}

}
///