$(document).ready(function() {
    'use strict';

       $("#submit").click(function(e){
           e.preventDefault();
           $('#submit').html('<img src='+ '/dashboard_assets/ajax-loader.gif />&nbsp; Retieving Data...').prop('disabled', true);
           $('select').prop('disabled', true);

           var token = $("input[name='_token']").val();
           var year = $("select[name='year']").val();


           $.ajax({
               url: "/admin/results/pgd",
               type:'POST',
               dataType: "json",
               data: {
                   _token : token,
                   year : year
               },
               cache: false,

           }).done(function(data){
               console.log(data.success);



              }).fail(function(){
                      $(".print-error-msg").html('An UnExpected Error Occured. Please Reload Page and try again.');
                   $('#submit').html('Submit').prop('disabled', false);
                   $('.print-error-msg').fadeIn(1000).delay(4000).fadeOut(1000, function () {
                   $(".print-error-msg").css('display','none');

               });

              });


       });

});
