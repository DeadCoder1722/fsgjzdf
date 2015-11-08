$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.preferences-content').hide();
    
    $('.preferences-link').click(function(){
         $('.dashboard-content').hide();
         $('.cardz').hide();
         $('.preferences-content').show();
    });
    
    
    $('.dashboard-link').click(function(){
        $('.preferences-content').hide();
        $('.cardz').show();
         $('.dashboard-content').show();
     });
    
  });