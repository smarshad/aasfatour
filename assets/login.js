$(document).on("click", ".login" , function(e) {
    var formname = $(this).data('form');
  e.preventDefault();
   var formdata = $("#"+formname+" :input").serialize();
   // console.log('formdata '+formdata);
   $.ajax({
     type    : "POST",
     url     : base_url+"Api/login/signin",
     data    : formdata,
     success : function(resData){
            //alert(resData);
            console.log(resData);
            var response = jQuery.parseJSON(resData);
            if (response['Response-Validate'] === true) {
                if(response['Response-Status']  == true){
                    $.toaster(response['Response-Message'], 'Success', 'success');
                    $('input[type=text],select').val('');
                    window.setTimeout(function() {
                        window.location.href = base_url+'dashboard';
                    }, 5000);
                }else if(response['Response-Status'] == false){
                    $.toaster(response['Response-Message'], 'Error', 'danger');
                    return false;
                }
            }
            else{
                $.each(response['Response-Message'], function(key, value) {
                    if(value!=''){
                        $.toaster(value, 'Error', 'danger');
                        $("#"+key).focus();
                        return false;
                    }

                });
            }
         },error: function(){
    }
   });
   event.preventDefault();
   return false;  //stop the actual form post !important!
});
