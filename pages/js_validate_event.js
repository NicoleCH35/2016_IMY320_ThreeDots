$(document).ready(function () 
{
	tooBig = false;
	
	///////////////////////////////////////////////////////////////////////////////////////////////////
	//POST_CREATION_VALIDATION
	$('#submit_event').on("click", function (e)
	{
		e.preventDefault();
		//alert("clicked");
		var isError = false;
		var emptyInput;
		var errorMsg = '';
		
		$('#form_event input:not(#submit_event)').each( function(index) //for each input except formSubmit
		{
			if ($(this).val() == '') //check if empty and set flag
			{
				if (isError == false)
				{
					isError = true;
					emptyInput = $(this); //get first input with error
					errorMsg = 'Please fill in all the form fields';
				}
			}
			
			var startD = new Date($("#start_D_event").val());
			var startT = $("#start_T_event").val();
			var endD = new Date($("#end_D_event").val());
			var endT = $("#end_T_event").val();
			if (endD < startD) //end event before it even starts
			{
				isError = true;
				errorMsg = 'End date before start date';
				emptyInput = $("#end_D_event");
			}
			else if (endD.getTime() == startD.getTime()) //start and end on same day.. check time
			{
				if (endT < startT) //event ends before it starts
				{
					isError = true;
					errorMsg = 'End time before start time';
					emptyInput = $("#end_T_event");
				}
			}
			
		});
		
		if (isError == true)
		{
			$('#errorMsg_event').html(errorMsg).css('color', 'red');
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
				$('#errorMsg_event').html('Image is too large. Max file size is 500kB.');
				//return false;
			}
			else //everything is fine and form can be submitted and uploaded
			{
				//alert("gonna POST");
				var name = $("#name_event").val();
				var desc = $("#desc_event").val();
				var location = $("#location_event").val();
				var startD = $("#start_D_event").val();
				var startT = $("#start_T_event").val();
				var endD = $("#end_D_event").val();
				var endT = $("#end_T_event").val();
				
				$.post("validate_event.php", {eventName : name, descEvent : desc, locationEvent : location, startDEvent : startD, startTEvent : startT, endDEvent : endD, endTEvent : endT})
				.done(function(resultMsg) 
				{
					var fd = new FormData();
					fd.append('image', document.getElementById('image_event').files[0]);
					var xhr = new XMLHttpRequest();
					xhr.addEventListener("load", uploadComplete, false);
					xhr.open("POST", "validate_image_event.php");
					xhr.send(fd);
					
					//var postIDi = resultMsg;
					var numCheckedWG = $('input:checked').length;
					//alert(numCheckedWG);
					
					$('input:checked').each(function ()
					{
						var wg = $(this).val();
						$.post("validate_wg.php", {wgName : wg})
						.done(function(resultMsg) 
						{
							//alert(resultMsg);
						});
					});
					
					function uploadComplete(e)
					{
						window.location.replace("../index.php");
					}
					//alert(resultMsg);
				});
			}
		}
	});
	
	$("#image_event").bind("change", function()
	{
		$('#errorMsg_event').html('');
		var size = this.files[0].size;
		if (size > 500000)
		{
			$('#errorMsg_event').html('Image is too large. Max file size is 500kB.');
			tooBig = true;
		}
		else
		{
			tooBig = false;
		}
	});
	
	$('input').on("click", function ()
	{
		$('#errorMsg_event').html('');
		$(this).css('border-color', 'rgb(204, 204, 204)');
	});
});