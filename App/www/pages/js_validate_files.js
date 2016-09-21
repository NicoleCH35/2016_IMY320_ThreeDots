$(document).ready(function () 
{
	tooBig = false;
	
	$('#submit_files').on("click", function (e)
	{
		e.preventDefault();
		//alert("clicked");
		var isError = false;
		var emptyInput;
		
		$('#form_files input:not(#submit_files)').each( function(index) //for each input except formSubmit
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
			$('#errorMsg_files').html('Please fill in all the form fields').css('color', 'red');
			$(emptyInput).css('border-color', 'red');
			//return false; //do not submit as there are empty fields
		}
		else //all fields were filled therefore validate
		{
			//if all fields filled then check them using php
			if (tooBig == true)
			{
				$('#errorMsg_files').html('File is too large. Max file size is 8000kB.');
				//return false;
			}
			else //everything is fine and form can be submitted and uploaded
			{
				var type_i = $("#type_files").val();
				var name_i = $("#name_files").val();
				
				$.post("validate_files.php", {type : type_i, name : name_i})
				.done(function(resultMsg) 
				{
					var fd = new FormData();
					fd.append('file', document.getElementById('file_files').files[0]);
					var xhr = new XMLHttpRequest();
					xhr.addEventListener("load", uploadComplete, false);
					xhr.open("POST", "validate_files_upload.php");
					xhr.send(fd);
					
					
					
					function uploadComplete(e)
					{
						//alert(resultMsg);
						window.location.replace("../index.php");
					}
				});
			}
		}
	});
	
	$("#file_files").bind("change", function()
	{
		$('#errorMsg__files').html('');
		var size = this.files[0].size;
		if (size > 8000000)
		{
			$('#errorMsg__files').html('File is too large. Max file size is 8000kB.');
			tooBig = true;
		}
		else
		{
			tooBig = false;
		}
	});
	
	$('input').on("click", function ()
	{
		$('#errorMsg__files').html('');
		$(this).css('border-color', 'rgb(204, 204, 204)');
	});
});