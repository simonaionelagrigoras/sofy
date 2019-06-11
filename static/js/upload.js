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
        $('.step-' + currentStep).addClass('active');
        $('button.next').attr('data-step', nextStep);
        if($('.step-'+ currentStep + ' input[type="radio"]:checked').length == 0){
            $('button.next').attr('disabled', 'disabled');
        }

        $('button.next').show();
        if(typeof prevStep != 'undefined'){
            $('button.prev').attr('data-step', prevStep);
            $('.step-' + prevStep).removeClass('active');
            $('.step-' + prevStep).hide();
        }
    }

    function backStep(currentStep, nextStep, prevStep)
    {
        $('.step-' + currentStep).toggle(300);
        $('.step-' + currentStep).addClass('active');
        $('button.next').attr('data-step', nextStep);
        if(currentStep != 4){
            $('button.next').prop("disabled", false);
        }else{
            $('button.next').prop("disabled", true);
            $('p.uploaded_file span').remove();
        }

        if(typeof nextStep != 'undefined'){
            $('.step-' + nextStep).removeClass('active');
            $('.step-' + nextStep).hide();
        }
        if(prevStep > 0){
            $('button.prev').attr('data-step', prevStep);
            $('button.prev').show();
        }else{
            $('button.prev').hide()
        }
    }


    function parseAvailableRepo(repositories)
    {
        if(typeof repositories != 'undefined' && repositories.length) {
            $.each(repositories, function (index, element) {
                var radioBtn = '<input type="radio" name="repository_name" value="' + element.repository_name + '">';
                $('.available-repos').append(
                    $('<p>')
                        .addClass("repo-option option")
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
                        .addClass("repo-version-option option")
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
                        .addClass("repo-app-option option")
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
                        .addClass("repo-app-option option")
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
                $('.create-repo').append( $('<p>', {"text":response.message}).addClass('repo-created'));
            }
            $('.create-repo-container').toggle();
            cleanSteps();
        }
    }

    function cleanSteps()
    {
        $("[class^=repo-][class$=option]").remove();
        $('p.uploaded_file').empty();
        $('#steps input[type="text"]').val('');
        $('div.repo-step').removeClass('active').hide();
        $('button.prev').attr('data-step', 1).hide();
        resetProgressBar();
    }

    $(document).on('click', '#create-repo-btn', function(){
        if($('p.repo-created').length){
            $('p.repo-created').remove();
            makeRequest('/repositories/getAvailableRepositories', 'step1');
        }else{
            if($('.available-repos p').length == 0){
                makeRequest('/repositories/getAvailableRepositories', 'step1');
            }
        }
        $('.create-repo-container').toggle(300);
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
                if($('.step-'+step).find('p.option').length){
                    $('.step-'+step).find('p.option').remove();
                }
                var repoName = $("input[name='repository_name']:checked").val();
                makeRequest('/repositories/getAvailableVersions/repository_name/' + repoName, 'step2');
                break;
            case 3:
                if($('.step-'+step).find('p.option').length) {
                    $('.step-'+step).find('p.option').remove();
                }
                var repoName = $("input[name='repository_name']:checked").val();
                var repoVersion = $("input[name='repository_version']:checked").val();
                makeRequest('/repositories/getAvailableApps/?repository_version=' + repoVersion + '&repository_name=' + repoName, 'step3');
                break;
            case 4:
                if(!$('.step-'+step).find('p.option').length) {
                    var repoApp = typeof $("input[name='repository_app']:checked").val() != "undefined" ? $("input[name='repository_app']:checked").val() != "undefined" : '';
                    var newApp = $("input[name='new_app']").val();
                    var repoName = $("input[name='repository_name']:checked").val();
                    var repoVersion = $("input[name='repository_version']:checked").val();
                    var postData = {
                        'repository_app': repoApp,
                        'new_app': newApp,
                        'repository_name': repoName,
                        'repository_version': repoVersion
                    };
                    makeRequest('/repositories/chooseApp', 'step4', postData);
                }else{
                    updateStep(4, 5, 3);
                }
                break;
            case 5:
                var file   =  $("input[name='file_for_repo']").val();
                var repoId = $("#repository_id").val();
                var repoTags = $("input[name='repository_tags']").val();
                var postData = {'repository_id': repoId, 'repository_file': file, 'repository_tags': repoTags};
                makeRequest('/repositories/createRepo', 'step5', postData);
                break;
            default:
        }
    });
    $(document).on('click', 'button.prev', function(el){
        previousStep();
        var currentStep = parseInt($(el.target).attr('data-step'));
        var nextStep    = currentStep+1;
        var prevStep    = currentStep-1;
        backStep(currentStep, nextStep, prevStep);
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
                        $(".add-tags .uploaded_file").append('<span>Your file has been successfully uploaded: '+ data.file_uploaded +'</span>');
                        $("input[name='file_for_repo']").val(data.file_uploaded);
                        nextStep();
                        updateStep(5, undefined, 4);
                        $('button.next').prop("disabled", false);
                    }
                    $("#userFile").val("");
                },
                error:function (data){
                    if(data.responseText){
                        var response = JSON.parse(data.responseText)
                        $('.upload-app .fileUpload').after('<p class="upload-error">'+ data.error + '</p>').show();
                    }else{
                        $('.upload-app .customer-personalization:first-child').after('<p class="upload-error">An error occurred</p>');
                    }
                    $("#userFile").val("");
                },
            });
        }

    });

    var step = 'step1';

    const step1 = document.getElementById('progress-step1');
    const step2 = document.getElementById('progress-step2');
    const step3 = document.getElementById('progress-step3');
    const step4 = document.getElementById('progress-step4');
    const step5 = document.getElementById('progress-step5');

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
            step = 'step4';
            step3.classList.remove("is-active");
            step3.classList.add("is-complete");
            step4.classList.add("is-active");

        } else if (step === 'step4') {
            step = 'step5';
            step4.classList.remove("is-active");
            step4.classList.add("is-complete");

        } else if (step === 'step5') {
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

    function previousStep() {
        if (step === 'step2') {
            step = 'step1';
            step2.classList.remove("is-active");
            step2.classList.remove("is-complete");
            step1.classList.remove("is-complete");
            step1.classList.add("is-active");

        } else if (step === 'step3') {
            step = 'step2';
            step3.classList.remove("is-active");
            step3.classList.remove("is-complete");
            step2.classList.remove("is-complete");
            step2.classList.add("is-active");

        } else if (step === 'step4') {
            step = 'step3';
            step4.classList.remove("is-active");
            step4.classList.remove("is-complete");
            step3.classList.remove("is-complete");
            step3.classList.add("is-active");

        } else if (step === 'step5') {
            step = 'step4';
            step5.classList.remove("is-active");
            step5.classList.remove("is-complete");
            step4.classList.remove("is-complete");
            step4.classList.add("is-active");

        } else if (step === 'complete') {
            step = 'step4';
            step4.classList.remove("is-complete");
            step3.classList.remove("is-complete");
            step2.classList.remove("is-complete");
            step1.classList.remove("is-complete");
            step4.classList.add("is-active");
        }
    }

    function resetProgressBar() {
        step = 'step1';
        step5.classList.remove("is-complete");
        step4.classList.remove("is-complete");
        step3.classList.remove("is-complete");
        step2.classList.remove("is-complete");
        step1.classList.remove("is-complete");
        step5.classList.remove("active");
        step4.classList.remove("active");
        step3.classList.remove("active");
        step2.classList.remove("active");
        step1.classList.remove("active");
    }

    var $loading = $('.loading-mask').hide();
    //Attach the event handler to any element
    $(document)
        .ajaxStart(function () {
            //ajax request went so show the loading image
            $loading.show();
        })
        .ajaxComplete(function () {
            //got response so hide the loading image
            $loading.hide();
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

    $(document).on('click', '#show-repos', function(){
       $('.repo-list').toggle(300);
    });


});