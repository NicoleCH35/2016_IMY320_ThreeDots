$(document).ready(function () 
{
	//alert("ready");
	
	$('#cal_submit').on("click", function (e)
	{
		e.preventDefault();
		//alert("changed");
		
		var iMonth = $("#cal_month").val();
		var iYear = new Date().getFullYear();
		
		//var image = $("#image").files[0];
		$.post("calender.php", {month : iMonth, year : iYear})
		.done(function(resultMsg) 
		{
			$("#calender_spot").html(resultMsg);
		});
	});
});

$(document).on('click', '.calendar-day', function() 
{
	//alert('showModal');
	
	var dayID = $(this).children("div").html();
	var iMonth = $("#cal_month").val();
	var iYear = new Date().getFullYear();
	
	var modal = document.getElementById('calender_modal');
	
	$.post("calender_event_modal.php", {month : iMonth, year : iYear, day : dayID})
	.done(function(resultMsg) 
	{
		//alert(resultMsg);
		if (resultMsg != 'No')
		{
			$("#calender_modal").html(resultMsg);
			modal.style.display = "block";
			
			var span = document.getElementsByClassName("close")[0];
			span.onclick = function() 
			{
			    modal.style.display = "none";
			}
		}	
	});
});

var modal = document.getElementById('calender_modal');
window.onclick = function(event) 
{
	if (event.target == modal) 
	{
		modal.style.display = "none";
	}
}

