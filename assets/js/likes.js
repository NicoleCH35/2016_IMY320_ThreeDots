$( "#likes" ).click(function( event )
{
	event.preventDefault();
});

function addLike(postID)
{
	alert(postID);
	//$.post("like.php", {pid: postID});
	$.ajax({url: "like.php", type:"post",data:{pid:postID}});
	alert("after");
}
