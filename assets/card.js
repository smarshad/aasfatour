$(function () {
    var inputFile = $('input[name=excelFile]');
    var uploadURI = base_url+"Api/card/doupload";
    var progressBar = $('#progress-bar');
    var filename;
    $("#vform").submit(function (event) {
        $("#toaster").remove();
        event.preventDefault();
        if(!$('#excelFile').val()){
            $.toaster("No file selected", 'Error', 'danger');
            $("#excelFile").focus();
        }else{
            var fileToUpload = inputFile[0].files[0];
            // make sure there is file to upload
            if (fileToUpload != 'undefined') {
                $.ajax({
                    type: 'POST',
                    url: uploadURI,
                    data: new FormData($("#vform")[0]),
                    processData: false,
                    contentType: false,
                    complete: function(){
                        setTimeout(function(){$(".progress").fadeOut('slow');},1000);                        
                    },
                    success: function (resData) {
                        console.log(JSON.stringify(resData));
                        var response = jQuery.parseJSON(resData);
                        if (response['Response-Validate'] === true) {
                            if(response['Response-Status']  == true){
                                $.toaster(response['Response-Message'], 'Success', 'success');
                                filename = response['Response-Filename'];
                                showbtn(filename);
                            }else if(response['Response-Status'] == false){
                                $.toaster(response['Response-Message'], 'Error', 'danger');
                                return false;
                            }
                        }else{
                            $.each(response['Response-Message'], function(key, value) {
                                if(value!=''){
                                    $.toaster(value, 'Error', 'danger');
                                    $("#"+key).focus();
                                    return false;
                                }

                            });
                        }
                    },error: function(){
                        alert('err');
                    },
                    xhr: function () {
                        var xhr = new XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (event) {
                            if (event.lengthComputable) {
                                var percentComplete = Math.round((event.loaded / event.total) * 100);
                                // console.log(percentComplete);
                                $('.progress').show();
                                progressBar.css({width: percentComplete + "%"});
                                progressBar.text(percentComplete + '%');
                            }
                            ;
                        }, false);
                        return xhr;
                    }
                });
            }
        }
    });

    $('body').on('change.bs.fileinput', function (e) {
        $('.progress').hide();
        progressBar.text("0%");
        progressBar.css({width: "0%"});
    });
});

function showbtn(xlname){
    if(xlname==''){
        $("#pbtn").hide();
        $(".preveiw").data('file','');
    }else{
        $("#pbtn").show();
        $(".preveiw").data('file',xlname);
    }
}


$(document).on("click", ".preveiw" , function() {
    var ptype = $(this).data('type');
    $("#myLargeModalLabel").html('Preview '+($(this).data('type')).toUpperCase());
    $.ajax({
        type    : "POST",
        url     : base_url+"Api/card/getdetail/"+$(this).data('type'),
        data    : {"filename" : $(this).data('file')},
        success : function(resData){
            console.log(resData);
            var response = jQuery.parseJSON(resData);
            if (response['Response-Validate'] === true) {
                if(response['Response-Status']  == true){
                    $.toaster(response['Response-Message'], 'Success', 'success');
                    $('.modal-body').html(response['Response-Data']);
                    $("#bd-example-modal-lg").modal('show');
                    $("#print").attr('href',base_url+'card/print/'+ptype);
                    $("#print").html('Print '+ptype).css('text-transform','uppercase');
                    $("#closebtn").css('text-transform','uppercase');
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


function PrintElem(elem) { Popup($(elem).html()); }

function Popup(data) {
    var mywindow = window.open('', 'new div', 'height=400,width=600');
    mywindow.document.write('<html><head><title>my div</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');
    mywindow.print();
    mywindow.close();
    return true;
}