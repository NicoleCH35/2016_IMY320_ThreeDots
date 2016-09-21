$(document).ready(function ()
{
	//alert('ready');
	$('.commentsDiv').hide();

	$('.likes').on("click", function (e)
	{
		e.preventDefault();
		var postID = $(this).attr('data-id');
		//alert(postID);

		$.post("like.php", {pid : postID})
		.done(function(e)
		{
			//alert(e);
			window.location.replace("stories.php");
		});

		
		//alert("clicked");
		//alert("after");
	});

	$('.comments').on("click", function (e)
	{
		e.preventDefault();
		var divID = $(this).attr('data-id');
		$("#"+divID).show();
	});

	$('.postComment').on("click", function (e)
	{
		e.preventDefault();
		var formID = $(this).attr('data-id');

		var postID = $("#"+formID).attr('data-id');
		var userID = $("#"+postID+"userID").val();
		var comment = $("#"+postID+"commentText").val();

		$.post("comment.php", {pid : postID, uid: userID, cid: comment})
			.done(function(e)
			{
				//alert(e);
				window.location.replace("stories.php");
			});
		

	});

	$('.deleteComment').on("click", function (e)
	{
		e.preventDefault();
		var commentID = $(this).attr('data-id');
		alert(commentID);
		$.post("deleteComment.php", {cid: commentID})
			.done(function(e)
			{
				//alert(e);
				window.location.replace("stories.php");
			});

	});

});

