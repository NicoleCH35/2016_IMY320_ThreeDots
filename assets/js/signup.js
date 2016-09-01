$(".SUinput").click(function()
{
    $(this).css('border-color','transparent');

});

function validateSignup()
{
    var done = true;

    $(".SUinput").each(function(){
        if($(this).val() == '')
        {
            $(this).css('border-color','red');
            done=false;
        }

    });

    if(done)
    {

        var areNoErrors = true;

        var emailM = $("#email");
        var email=emailM .val().search(/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/);

        var passMain = $("#passwords");
        var pass = passMain.val();

        var conPass = $("#passwordC");
        
        
        if(email!=0)
        {
            emailM.css('border-color','red');
            areNoErrors = false;
        }
        
        
        if(conPass.val()!= pass)
        {

            conPass.css('border-color','red');
            areNoErrors = false;
        }

        if(!areNoErrors)
        {
            return false;
        }
        else
        {
            return true;
        }
    }
    else
    {
        return false;
    }

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////