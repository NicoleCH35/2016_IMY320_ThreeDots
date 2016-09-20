$(document).ready(function () 
{
	tooBig = false;
	
	///////////////////////////////////////////////////////////////////////////////////////////////////
	//POST_CREATION_VALIDATION
	$('#submit_news').on("click", function (e)
	{
		e.preventDefault();
		//alert("clicked");
		var isError = false;
		var emptyInput;
		
		$('#form_news input:not(#submit_news)').each( function(index) //for each input except formSubmit
		{
			if ($(this).val() == '') //check if empty and set flag
			{
				if (isError == false)
				{
					isError = true;
					emptyInput = $(this); //get first input with error
				}
			}
		});
		
		if (isError == true)
		{
			$('#errorMsg_news').html('Please fill in all the form fields').css('color', 'red');
			$(emptyInput).css('border-color', 'red');
			//return false; //do not submit as there are empty fields
		}
		else //all fields were filled therefore validate
		{
			//if all fields filled then check them using php
			///////////////////////////////////////////////////////////////////////////////////////////////////
			//POST_CREATION_PHPCHECK
			
			if (tooBig == true)
			{
				$('#errorMsg_news').html('Image is too large. Max file size is 500kB.');
				//return false;
			}
			else //everything is fine and form can be submitted and uploaded
			{
				alert("here");
				//alert("title= " + $("#title_news").val());
				var title_i = $("#title_news").val();
				var news_i = $("#news_news").val();
				var link_i = $("#link_news").val();
				
				//var image = $("#image").files[0];
				$.post("validate_news.php", {title : title_i, news : news_i, link : link_i})
				.done(function(resultMsg) 
				{
					var fd = new FormData();
					fd.append('image', document.getElementById('image_news').files[0]);
					var xhr = new XMLHttpRequest();
					xhr.addEventListener("load", uploadComplete, false);
					xhr.open("POST", "validate_image_news.php");
					xhr.send(fd);
					
					function uploadComplete(e)
					{
						window.location.replace("../index.php");
					}
					//alert(resultMsg);
				});
			}
		}
	});
	
	$("#image_news").bind("change", function()
	{
		$('#errorMsg_news').html('');
		var size = this.files[0].size;
		if (size > 500000)
		{
			$('#errorMsg_news').html('Image is too large. Max file size is 500kB.');
			tooBig = true;
		}
		else
		{
			tooBig = false;
		}
	});
	
	$('input').on("click", function ()
	{
		$('#errorMsg_news').html('');
		$(this).css('border-color', 'rgb(204, 204, 204)');
	});
});