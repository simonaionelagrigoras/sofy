<div class="col-sm-3" id="account-navigation">
    <?php require_once ('html\left_navigation.php')?>
</div>
<div class="col-sm-9">
    <div class="repo-upload">
        <p>Your repositories</p>
        <div class="existent-repo">
            <p class="folder"><a href="repo/centos-2">centos-2</a></p>
            <p class="folder"><a href="repo/centos-3">centos-3</a></p>
        </div>
        <div class="create-repo">
            <a id="create-repo-btn" class="btn btn-md">Create repository</a>

            <div class="chose-repo hidden">
                <select class="available-repos">
                    <option value=""><i>Select repo to upload</i></option>
                    <option value="centos-2">centos-2</option>
                    <option value="centos-3">centos-3</option>
                </select>
                <span class="available-repos-select">  <span tooltip="Click to select repository" class="tooltip"></span></span>
                <p class="error hidden">Please select a repository</p>
            </div>

            <div class="repo-upload-box hidden">
                <div class="fileUpload btn-primary">
                    <span class="upload-text">Select files to upload</span>
                    <input name="userFile" id="userFile" multiple="" max="3" type="file" class="upload">
                </div>
                <button  type="button" class="hidden" id="delete-file">Delete File</button>

                <!--<div id="progress-div"><div id="progress-bar"></div></div>-->
                <div id="targetLayer"></div>
                <div class="uploaded_files_elements"></div>
            </div>

            <div class="preview">
                <div id="loader-icon" style="display: none;"><img src="<?= $baseUrl?>/static/media/images/loader.gif"></div>
                <div><div class="delete_file"></div></div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function() {
        function getUserRepositories() {
            $.ajax({
                url: '/repositories/getList',
                type: 'POST',
                dataType: 'json',
                success: function (response) {
                    var result = '';

                    if (typeof response.error != 'undefined') {
                        alert(response.error);
                    }
                    $.each(response, function (index, element) {
                        console.log(data);
                        $('.existent-repo')
                    })
                },
                error: function (response) {
                    var result = '';
                    response = response.responseJSON;

                    if (typeof response.error != 'undefined') {
                        alert(response.error);
                    }
                }
            });
        }
        getUserRepositories();
    });
</script>