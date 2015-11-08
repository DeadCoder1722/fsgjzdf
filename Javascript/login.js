$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.register-content').hide();
    
    $('.register-link').click(function(){
         $('.login-content').hide();
         $('.register-content').show();
    });
    
    
    $('.login-link').click(function(){
        $('.register-content').hide();
         $('.login-content').show();
     });
    // trigger modal
    $('.modal-trigger').leanModal();
    
    
    // $('#password, #passwordConfirmation').on('keyup', function () {
    //     if ($('#password').val() == $('#passwordConfirmation').val()) {
    //         $('#message').html('Matching').css('color', 'green');
    //     } else 
    //         $('#message').html('Not Matching').css('color', 'red');
            
    //     debugger;
    // });
    
  });
         
var str = (document.URL);
var n = str.indexOf("accountgood");
if (n > 0) {
	Materialize.toast('Account Created </br> (ツ) </br> Login Now', 5000, 'invalidcred');
}   