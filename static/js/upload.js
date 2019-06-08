$('document').ready(function(){

    //form validation
    $('#account-repository').on('click', function(e){
        $('.profile').hide();
        $('.repo-upload').show();

    })

    $('body').on('click','p.folder>a', function(e){
        e.preventDefault();
        var folder = e.target.getAttribute('href');
        $.ajax({
            url: 'app/listFiles.php',
            type: 'POST',
            dataType: 'json',
            data: JSON.stringify({ 'folder': folder}),
            success: function(response) {
                var result = '';

                if(typeof response.error != 'undefined'){
                    alert(response.error);
                }
                $('div.existent-repo').find('.folder').remove()
                $.each( response, function( key, value ) {
                    $('div.existent-repo').append('<p class="folder"><a href="repo/centos-2">' + value.name + '</a></p>');
                });
            },
            error: function(response) {
                var result = '';
                response = response.responseJSON;

                if(typeof response.error != 'undefined'){
                    alert(response.error);
                }
            }
        });
    });

    jQuery(document).on('click', '#create-repo-btn', function(){
        jQuery('.chose-repo').toggle(300);
    });

    jQuery(document).on('click', '.available-repos-select', function(){
        var repo = $('select.available-repos option:selected').val();
        if(!repo.length){
            jQuery('.chose-repo p.error').show();
        }else{
            jQuery('.chose-repo p.error').hide();
            jQuery('.repo-upload-box').toggle(200);
            $('select.available-repos').attr('disabled', 'disabled');
        }
    });

    jQuery(document).on("change", "#userFile", function() {
        jQuery('.upload-error').hide();
        var file_data = jQuery("#userFile").prop("files");   // Getting the properties of file from file field
        var existing_files = jQuery('.uploaded-values').length;
        var repo = $('select.available-repos option:selected').val();

        var form_data = new FormData();

        form_data.append('file',  $('#userFile')[0].files[0]);

        form_data.append("repo", repo);

        //var file_name = jQuery("#userFile").prop("files")[0].name;
        //var file_type = jQuery("#userFile").prop("files")[0].type;
        //var file_size = jQuery("#userFile").prop("files")[0].size;

        if(jQuery('#userFile').val()) {
            //e.preventDefault();
            jQuery('#loader-icon').show();
            if(jQuery(".upload-error").length){
                jQuery(".upload-error").hide();
            }
            jQuery.ajax({
                url: "app/upload",
                dataType: 'json',
                cache: false,
                /*enctype: 'multipart/form-data',*/
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                target:   '#targetLayer',
                beforeSubmit: function() {
                    jQuery("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){
                    jQuery("#progress-bar").width(percentComplete + '%');
                    jQuery("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                success:function (data){
                    if(data.error){
                        jQuery('.repo-upload-box .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                        jQuery('#loader-icon').hide();
                    }else{
                        jQuery('#loader-icon').hide();
                        jQuery(".preview").append('<div>'+ data.file_uploaded +'<div class="delete_file"></div></div>');
                    }
                },
                error:function (data){
                    if(data.responseText){
                        var response = JSON.parse(data.responseText)
                        jQuery('.repo-upload-box .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                        jQuery('#loader-icon').hide();
                    }else{
                        jQuery('#loader-icon').hide();
                        jQuery('.repo-upload-box .customer-personalization:first-child').after('<p class="upload-error">An error occurred</p>');
                    }
                },
                resetForm: true
            });
            return false;
        }

    })

});