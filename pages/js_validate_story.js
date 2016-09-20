$(document).ready(function () 
{
	tooBig = false;
	//alert("ready");
	///////////////////////////////////////////////////////////////////////////////////////////////////
	//POST_CREATION_VALIDATION
	$('#submit_story').on("click", function (e)
	{
		e.preventDefault();
		alert("clicked");
		var isError = false;
		var emptyInput;
		
		$('#form_story input:not(#submit_story)').each( function(index) //for each input except formSubmit
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
			$('#errorMsg_story').html('Please fill in all the form fields').css('color', 'red');
			$(emptyInput).css('border-color', 'red');
			//return false; //do not submit as there are empty fields
		}
		else //all fields were filled therefore validate
		{
			//if all fields filled then check them using php
			///////////////////////////////////////////////////////////////////////////////////////////////////
			//POST_CREATION_PHPCHECK
			//alert("gonna POST");
			if (tooBig == true)
			{
				$('#errorMsg_story').html('Image is too large. Max file size is 500kB.');
				//return false;
			}
			else //everything is fine and form can be submitted and uploaded
			{
				alert("gonna POST");
				var title = $("#title_story").val();
				var desc = $("#desc_story").val();
				var story = $("#story_story").val();
				
				//var image = $("#image").files[0];
				$.post("validate_story.php", {titleStory : title, descStory : desc, storyText : story})
				.done(function(resultMsg) 
				{
					var fd = new FormData();
					fd.append('image', document.getElementById('image_story').files[0]);
					var xhr = new XMLHttpRequest();
					xhr.addEventListener("load", uploadComplete, false);
					xhr.open("POST", "validate_image.php");
					xhr.send(fd);
					
					function uploadComplete(e)
					{
						window.location.replace("../index.php");
					}
				});
			}
		}
	});
	
	$("#image_story").bind("change", function()
	{
		$('#errorMsg_story').html('');
		var size = this.files[0].size;
		if (size > 500000)
		{
			$('#errorMsg_story').html('Image is too large. Max file size is 500kB.');
			tooBig = true;
		}
		else
		{
			tooBig = false;
		}
	});
	
	$('input').on("click", function ()
	{
		$('#errorMsg_story').html('');
		$(this).css('border-color', 'rgb(204, 204, 204)');
	});
});