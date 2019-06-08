$('document').ready(function(){

    function makeGet(url, step, data){

        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: data,
            success: function (response) {
                if (typeof response.error != 'undefined') {
                    return [];
                }
                switch (step){
                    case 'step1':
                        parseAvailableRepo(response);
                        break;
                    case 'step2':
                        parseAvailableVersions(response);
                        break;
                }
                return response;
            },
            error: function (response) {
                response = response.responseJSON;

                if (typeof response.error != 'undefined') {
                    return [];
                }
            }
        });
    }

    function parseAvailableRepo(repositories)
    {
        var availableRepositories = '';
        $.each(repositories, function (index, element) {
            var radioOption = '<input type="radio" name="repository_name" value="' + element.repository_name + '">'+ element.repository_name + '<br>\n';
            availableRepositories = availableRepositories + radioOption
        });
        $('.available-repos').html(availableRepositories)
        $('.chose-repo').toggle(300);
        $('button.next').attr('data-step', 2);
        $('button.next').show();
    }

    function parseAvailableVersions(versions)
    {
        var availableVersions = '';
        /*$.each(repositories, function (index, element) {
            var radioOption = '<input type="radio" name="repository_name" value="' + element.repository_name + '">'+ element.repository_name + '<br>\n';
            availableRepositories = availableRepositories + radioOption
        });
        $('.available-repos').html(availableRepositories)
        $('.chose-repo').toggle(300);*/
        $('button.next').attr('data-step', 3);
        $('button.next').show();
    }

    $(document).on('click', '#create-repo-btn', function(){
        makeGet('/repositories/getAvailableRepositories', 'step1');
    });

    $(document).on('click', 'button.next', function(el){
        var step = parseInt($(el.target).attr('data-step'));
        switch(step) {
            case 1:
                break;
            case 2:
                var repoName = $("input[name='repository_name']:checked").val();
                makeGet('/repositories/getAvailableVersions', 'step2', {'respository_name': repoName});
                break;
            case "Apple":
                text = "How you like them apples?";
                break;
            default:
                text = "I have never heard of that fruit...";
        }
    });
    $(document).on('click', 'input[name="repository_name"]', function(el){
        $('button.next').prop("disabled", false)
    });
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

    $(document).on('click', '.available-repos-select', function(){
        var repo = $('select.available-repos option:selected').val();
        if(!repo.length){
            $('.chose-repo p.error').show();
        }else{
            $('.chose-repo p.error').hide();
            $('.repo-upload-box').toggle(200);
            $('select.available-repos').attr('disabled', 'disabled');
        }
    });

    $(document).on("change", "#userFile", function() {
        $('.upload-error').hide();
        var file_data = $("#userFile").prop("files");   // Getting the properties of file from file field
        var existing_files = $('.uploaded-values').length;
        var repo = $('select.available-repos option:selected').val();

        var form_data = new FormData();

        form_data.append('file',  $('#userFile')[0].files[0]);

        form_data.append("repo", repo);

        //var file_name = $("#userFile").prop("files")[0].name;
        //var file_type = $("#userFile").prop("files")[0].type;
        //var file_size = $("#userFile").prop("files")[0].size;

        if($('#userFile').val()) {
            //e.preventDefault();
            $('#loader-icon').show();
            if($(".upload-error").length){
                $(".upload-error").hide();
            }
            $.ajax({
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
                    $("#progress-bar").width('0%');
                },
                uploadProgress: function (event, position, total, percentComplete){
                    $("#progress-bar").width(percentComplete + '%');
                    $("#progress-bar").html('<div id="progress-status">' + percentComplete +' %</div>')
                },
                success:function (data){
                    if(data.error){
                        $('.repo-upload-box .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                        $('#loader-icon').hide();
                    }else{
                        $('#loader-icon').hide();
                        $(".preview").append('<div>'+ data.file_uploaded +'<div class="delete_file"></div></div>');
                    }
                },
                error:function (data){
                    if(data.responseText){
                        var response = JSON.parse(data.responseText)
                        $('.repo-upload-box .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                        $('#loader-icon').hide();
                    }else{
                        $('#loader-icon').hide();
                        $('.repo-upload-box .customer-personalization:first-child').after('<p class="upload-error">An error occurred</p>');
                    }
                },
                resetForm: true
            });
            return false;
        }

    })

});