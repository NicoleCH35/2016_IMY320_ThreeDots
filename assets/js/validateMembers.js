$(document).ready(function ()
{
	$(".hideDivs").hide();
	var id;

	$("#memberSelect").change(function()
	{
		//alert("in");
		$(".hideDivs").hide();
		id = $(this).find("option:selected").val();
		var userID = id+"div"
		$("#"+userID).show();
		//alert(id);
	});

	$('#submit_Change').on("click", function (e)
	{
		e.preventDefault();
		
		var isAdmin = $("#"+id+"isAdmin").is(':checked');
		var group = $("#"+id+"memberTeamSelect").find("option:selected").val();
		
		//alert(isAdmin + " g "+ group + " u "+id);
		$.post("editMember.php", {userID : id, admin: isAdmin, groupType: group})
			.done(function(e)
			{
				//alert(e);
				window.location.replace("../pages/admin.php");
			});
	});

	$('#submit_workgroups').on("click", function (e)
	{
		e.preventDefault();

		var group = $("#wgName").val();
		//alert(group);

		$.post("addWorkgroup.php", {groupType: group, test:1})
			.done(function(e)
			{
				alert(e);
				window.location.replace("../pages/admin.php");
		});
	});
});