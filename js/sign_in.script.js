/* sign in page script */
$(function(){
    $('#btnLoginPerson').click(function(){
        $('#firstStepLogin').fadeOut();
        $('#loginPerson').fadeIn();
    });

    $('#btnLoginVoluntary').click(function(){
        $('#firstStepLogin').fadeOut();
        $('#secondStepLoginVoluntary').fadeIn(function(){
            $('#btnLoginVoluntaryPf').click(function(){
                $('#secondStepLoginVoluntary').fadeOut();
                $('#loginVoluntaryPf').fadeIn();;
            });

            $('#btnLoginVoluntaryPj').click(function(){
                $('#secondStepLoginVoluntary').fadeOut();
                $('#loginVoluntaryPj').fadeIn();
            })
        });
    });
});
