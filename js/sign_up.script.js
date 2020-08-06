/* sign up page script */
$(function(){
    $('#btnPerson').click(function(){
        $('#firstStep').fadeOut();
        $('#secondStepPerson').fadeIn();
    });

    $('#btnVoluntary').click(function(){
        $('#firstStep').fadeOut();
        $('#secondStepVoluntary').fadeIn(function(){
            $('#btnPf').click(function(){
                $('#secondStepVoluntary').fadeOut();
                $('#thirdStepVoluntaryPf').fadeIn();
            });
    
            $('#btnPj').click(function(){
                $('#secondStepVoluntary').fadeOut();
                $('#thirdStepVoluntaryPj').fadeIn();
            })
        });
    });

});
