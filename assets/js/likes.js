//~ $( "#likes" ).click(function( event )
//~ {
	//~ event.preventDefault();
	
	//~ alert(postID);
	//~ //$.post("like.php", {pid: postID});
	//~ //$.ajax({url: "like.php", type:"post",data:{pid:postID}});
	
	//~ $.post("like.php", {pid : postID})
		//~ .done(function(resultMsg) 
		//~ {
			//~ alert(resultMsg);
		//~ });
	
	//~ alert("after");
//~ });

$(document).ready(function () 
{
	alert('ready');
	
	$('.likes').on("click", function (e)
	{
		e.preventDefault();
		postID = $(this).attr('data-id');
		
		$.post("like.php", {pid : postID})
		.done(function(resultMsg) 
		{
			alert(resultMsg);
		});
		
		//alert("clicked");
		alert(postID);
	});
});

function addLike(postID)
{
	//~ alert(postID);
	//~ //$.post("like.php", {pid: postID});
	//~ //$.ajax({url: "like.php", type:"post",data:{pid:postID}});
	
	//~ $.post("like.php", {pid : postID})
		//~ .done(function(resultMsg) 
		//~ {
			//~ alert(resultMsg);
		//~ });
	
	//~ alert("after");
}
