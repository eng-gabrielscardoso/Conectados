(function($){
  $(function(){
    // Device custom
    $('.sidenav').sidenav();

    // Custom Javascript of SIGN UP
    $('#btnRegisterBeneficiary').click(function(){
      $('#firstStep').fadeOut();
      $('#registrationBeneficiary').fadeIn(function(){
        $("#submitRegistrationBeneficiary").click(function(){
          var passwordBeneficiary = $("#passwordBeneficiary").val();
          var confirmationBeneficiary = $("#passwordConfirmBeneficiary").val();
          if(passwordBeneficiary != confirmationBeneficiary){
            event.preventDefault();
            alert("As senhas não são iguais!");
          }
        });
      });
    });

    $(document).ready(function(){
      $('select').formSelect();
    });

    $('#btnRegisterVoluntary').click(function(){
      $('#firstStep').fadeOut();
      $('#secondStep').fadeIn(function(){
        $('#btnRegisterVoluntaryPf').click(function(){
          $('#secondStep').fadeOut();
          $('#registrationVoluntaryPf').fadeIn(function(){
            $("#submitRegistrationVoluntaryPf").click(function(){
              var passwordVoluntaryPf = $("#passwordVoluntaryPf").val();
              var confirmationVoluntaryPf = $("#passwordConfirmVoluntaryPf").val();
              if(passwordVoluntaryPf != confirmationVoluntaryPf){
                event.preventDefault();
                alert("As senhas não são iguais!");
              }
            });
          });
        });
        $('#btnRegisterVoluntaryPj').click(function(){
          $('#secondStep').fadeOut();
          $('#registrationVoluntaryPj').fadeIn(function(){
            $("#submitRegistrationVoluntaryPj").click(function(){
              var passwordVoluntaryPj = $("#passwordVoluntaryPj").val();
              var confirmationVoluntaryPj = $("#passwordConfirmVoluntaryPj").val();
              if(passwordVoluntaryPj != confirmationVoluntaryPj){
                event.preventDefault();
                alert("As senhas não são iguais!");
              }
            });
          });
        });
      });
    });

    // Custom JavaScript of SIGN IN
    $('#btnLoginBeneficiary').click(function(){
      $('#firstStepLogin').fadeOut();
      $('#loginBeneficiary').fadeIn();
    });

    $('#btnLoginVoluntary').click(function(){
      $('#firstStepLogin').fadeOut();
      $('#secondStepLogin').fadeIn(function(){
        $('#btnLoginVoluntaryPf').click(function(){
          $('#secondStepLogin').fadeOut();
          $('#loginVoluntaryPf').fadeIn();
        });
        $('#btnLoginVoluntaryPj').click(function(){
          $('#secondStepLogin').fadeOut();
          $('#loginVoluntaryPj').fadeIn();
        });
      });
    });

  }); // end of document ready
})(jQuery); // end of jQuery name space
