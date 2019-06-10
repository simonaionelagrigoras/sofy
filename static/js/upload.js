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
                    case 'step5':
                        showCreatedRepo(response);
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

    function updateStep(currentStep, nextStep, prevStep)
    {
        $('.step-' + currentStep).toggle(300);
        $('button.next').attr('data-step', nextStep);
        $('button.next').attr('disabled', 'disabled');
        $('button.next').show();
        if(typeof prevStep != 'undefined'){
            $('.step-' + prevStep).hide();
        }
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
            updateStep(1, 2);
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

            updateStep(2, 3, 1);
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

            updateStep(3, 4, 2);
        }
    }

    function showUpload(response)
    {
        if(typeof response != 'undefined' ){
            if(response.new_app){
                var radioBtn = '<input type="radio" name="repository_app" value="' + response.new_app + '">';
                $('.available-apps').append(
                    $('<p>')
                        .addClass("repo-app-option")
                        .append([radioBtn, $('<span/>',{ "text": response.new_app })])
                );
                $('input[name="repository_app"][value="' + response.new_app + '"]').attr('checked', true);
                $("input[name='new_app']").val('');
            }
            $('#repository_id').val(response.repository_id);

            updateStep(4, 5, 3);
        }
    }

    function showCreatedRepo(response)
    {
        if(typeof response != 'undefined' ){
            if(response.message){
                $('.create-repo').append( $('<p>'), {"text":response.message});
            }
            $('#steps').hide();
            $('button.next').attr('data-step', 1).hide();
            $('button.prev').attr('data-step', 1).hide();
        }
    }

    $(document).on('click', '#create-repo-btn', function(){
        makeRequest('/repositories/getAvailableRepositories', 'step1');
        $('.progress').removeClass('hidden').addClass('visible');
    });

    $(document).on('click', 'button.next', function(el){
        var step = parseInt($(el.target).attr('data-step'));
        $('button.prev').prop("disabled", false);
        $('button.prev').show();
        nextStep();
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
            case 5:
                var file   =  $("input[name='file_for_repo']").val();
                var repoId = $("#repository_id").val();
                var postData = {'repository_id': repoId, 'repository_file': file};
                makeRequest('/repositories/createRepo', 'step5', postData);
                break;
            default:
        }
    });

    $(document).on('click', 'input[name="repository_name"]', function(el){
        $('button.next').prop("disabled", false);
    });

    $(document).on('change', 'input[type="radio"]', function(el){
        $('button.next').prop("disabled", false);
    });

    $(document).on('keyup','input[name="new_app"]', function(){
        if ($(this).val())
        {
            $('button.next').prop("disabled", false);
        }
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
        var repoId      = $("#repository_id").val();
        var repoName    = $("input[name='repository_name']:checked").val();
        var repoVersion = $("input[name='repository_version']:checked").val();
        var repoApp     = $("input[name='repository_app']:checked").val();

        var form_data = new FormData();

        form_data.append("repository_id", repoId);
        form_data.append("repository_name", repoName);
        form_data.append("repository_version", repoVersion);
        form_data.append("repository_app", repoApp);

        form_data.append('file',  $('#userFile')[0].files[0]);


        if($('#userFile').val()) {
            //e.preventDefault();
            $('#loader-icon').show();
            if($(".upload-error").length){
                $(".upload-error").hide();
            }
            $.ajax({
                url: "/repositories/uploadApp",
                dataType: 'json',
                cache: false,
                /*enctype: 'multipart/form-data',*/
                contentType: false,
                processData: false,
                data: form_data,
                type: 'POST',
                target:   '#targetLayer',
                beforeSubmit: function() {
                    $("#progress-bar").width('0%');
                },
                success:function (data){
                    if(data.error){
                        $('.upload-app .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                    }else{
                        $(".preview").append('<div>'+ data.file_uploaded +'<div class="delete_file"></div></div>');
                        $("input[name='file_for_repo']").val(data.file_uploaded);
                        nextStep();
                        $('button.next').prop("disabled", false)
                    }
                },
                error:function (data){
                    if(data.responseText){
                        var response = JSON.parse(data.responseText)
                        $('.upload-app .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                    }else{
                        $('.upload-app .customer-personalization:first-child').after('<p class="upload-error">An error occurred</p>');
                    }
                    //$('#userFile').reset();
                },
            });
        }

    })

    var step = 'step1';

    const step1 = document.getElementById('progress-step1');
    const step2 = document.getElementById('progress-step2');
    const step3 = document.getElementById('progress-step3');
    const step4 = document.getElementById('progress-step4');

    function nextStep() {
        if (step === 'step1') {
            step = 'step2';
            step1.classList.remove("is-active");
            step1.classList.add("is-complete");
            step2.classList.add("is-active");

        } else if (step === 'step2') {
            step = 'step3';
            step2.classList.remove("is-active");
            step2.classList.add("is-complete");
            step3.classList.add("is-active");

        } else if (step === 'step3') {
            step = 'step4d';
            step3.classList.remove("is-active");
            step3.classList.add("is-complete");
            step4.classList.add("is-active");

        } else if (step === 'step4d') {
            step = 'complete';
            step4.classList.remove("is-active");
            step4.classList.add("is-complete");

        } else if (step === 'complete') {
            step = 'step1';
            step4.classList.remove("is-complete");
            step3.classList.remove("is-complete");
            step2.classList.remove("is-complete");
            step1.classList.remove("is-complete");
            step1.classList.add("is-active");
        }
    }

    var $loading = $('.loading-mask').hide();
    //Attach the event handler to any element
    $(document)
        .ajaxStart(function () {
            //ajax request went so show the loading image
            $loading.show();
        })
        .ajaxStop(function () {
            //got response so hide the loading image
            $loading.hide();
        });

});