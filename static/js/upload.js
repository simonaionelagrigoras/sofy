$('document').ready(function(){

    function makeRequest(url, step, data){
        var reqType = typeof data != 'undefined' ? 'POST' : 'GET';
        $.ajax({
            url: url,
            type: reqType,
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
                    case 'step3':
                        parseAvailableApps(response);
                        break;
                    case 'step4':
                        showUpload(response);
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
        if(typeof repositories != 'undefined' && repositories.length) {
            $.each(repositories, function (index, element) {
                var radioBtn = '<input type="radio" name="repository_name" value="' + element.repository_name + '">';
                $('.available-repos').append(
                    $('<p>')
                        .addClass("repo-option")
                        .append([radioBtn, $('<span/>',{ "text":element.repository_name })])
                );
            });
            $('.chose-repo').toggle(300);
            $('button.next').attr('data-step', 2);
            $('button.next').show();
        }
    }

    function parseAvailableVersions(versions)
    {
        if(typeof versions != 'undefined' && versions.length){
            $.each(versions, function (index, element) {
                var radioBtn = $('<input type="radio" name="repository_version" value="' + element.version + '" />');
                $('.available-versions').append(
                    $('<p>')
                        .addClass("repo-version-option")
                        .append([radioBtn, $('<span/>',{ "text": element.version })])
                );
            });

            $('.choose-version').toggle(300);
            $('.step-1').hide();
            $('button.next').attr('data-step', 3);
            $('button.next').show();
        }
    }

    function parseAvailableApps(apps)
    {
        if(typeof apps != 'undefined' ){
            $.each(apps, function (index, element) {
                var radioBtn = '<input type="radio" name="repository_app" value="' + element + '" />';
                $('.available-apps').append(
                    $('<p>')
                        .addClass("repo-app-option")
                        .append([radioBtn, $('<span/>',{ "text": element })])
                );
            });
            $('.choose-app').toggle(300);
            $('.step-2').hide();
            $('button.next').attr('data-step', 4);
            $('button.next').show();
        }
    }

    function showUpload(response)
    {
        if(typeof response != 'undefined' ){
            if(response.new_app){
                var newApp = '<input type="radio" name="repository_app" value="' + response.new_app + '">'+ response.new_app + '<br>\n';
                $(newApp).insertAfter( $('.available-apps input[name="repository_app"]:last-of-type') );
                $('input[name="repository_app"][value="' + response.new_app + '"]').attr('checked', true);
                $("input[name='new_app']").val('');
            }
            $('.upload-app').toggle(300);
            $('.step-3').hide();
            $('button.next').attr('data-step', 5);
            $('button.next').show();
        }
    }

    $(document).on('click', '#create-repo-btn', function(){
        makeRequest('/repositories/getAvailableRepositories', 'step1');
    });

    $(document).on('click', 'button.next', function(el){
        var step = parseInt($(el.target).attr('data-step'));
        switch(step) {
            case 1:
                break;
            case 2:
                var repoName = $("input[name='repository_name']:checked").val();
                makeRequest('/repositories/getAvailableVersions/repository_name/' + repoName, 'step2');
                break;
            case 3:
                var repoName    = $("input[name='repository_name']:checked").val();
                var repoVersion = $("input[name='repository_version']:checked").val();
                makeRequest('/repositories/getAvailableApps/?repository_version=' + repoVersion + '&repository_name=' + repoName, 'step3');
                break;
            case 4:
                var repoApp = typeof $("input[name='repository_app']:checked").val() != "undefined" ? $("input[name='repository_app']:checked").val() != "undefined" : '';
                var newApp  = $("input[name='new_app']").val();
                var repoName    = $("input[name='repository_name']:checked").val();
                var repoVersion = $("input[name='repository_version']:checked").val();
                var postData = {'repository_app': repoApp, 'new_app': newApp, 'repository_name': repoName, 'repository_version':repoVersion};
                makeRequest('/repositories/chooseApp', 'step4', postData);
                break;
            default:
                text = "I have never heard of that fruit...";
        }
    });
    $(document).on('click', 'input[name="repository_name"]', function(el){
        $('button.next').prop("disabled", false)
    });

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
            $('.upload-app').toggle(200);
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
                        $('.upload-app .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                        $('#loader-icon').hide();
                    }else{
                        $('#loader-icon').hide();
                        $(".preview").append('<div>'+ data.file_uploaded +'<div class="delete_file"></div></div>');
                    }
                },
                error:function (data){
                    if(data.responseText){
                        var response = JSON.parse(data.responseText)
                        $('.upload-app .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                        $('#loader-icon').hide();
                    }else{
                        $('#loader-icon').hide();
                        $('.upload-app .customer-personalization:first-child').after('<p class="upload-error">An error occurred</p>');
                    }
                },
                resetForm: true
            });
            return false;
        }

    })

});