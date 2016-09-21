$(document).ready(function ()
{
	//alert('ready');
	$('.commentsDiv').hide();

	$('.likes').on("click", function (e)
	{
		e.preventDefault();
		var postID = $(this).attr('data-id');
		//alert(postID);

		$.post("pages/like.php", {pid : postID})
		.done(function(e)
		{
			//alert(e);
			window.location.replace("index.php");
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

		$.post("pages/comment.php", {pid : postID, uid: userID, cid: comment})
			.done(function(e)
			{
				//alert(e);
				window.location.replace("index.php");
			});

		// alert(formID);
		// alert(postID +"PID");
		// alert(userID +"UID");
		// alert(comment +"comment");

	});

	$('.deleteComment').on("click", function (e)
	{
		e.preventDefault();
		var commentID = $(this).attr('data-id');
		alert(commentID);
		$.post("pages/deleteComment.php", {cid: commentID})
			.done(function(e)
			{
				//alert(e);
				window.location.replace("index.php");
			});

	});

});

