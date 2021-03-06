<div class="col-sm-3" id="account-navigation">
    <?php require_once ('html\left_navigation.php')?>
</div>
<div class="col-sm-9">
    <div class="repo-upload">

        <div id="show-repos">
            <a id="list-repos" class="btn btn-md">Your repositories</a>
            <form method="GET" action="/repositories/searchResult" id="search-form" autocomplete="off">
                <input type="text" name="search_key" id="search" required="required" placeholder="Search by tag or name" class="form-control">
                <button type="submit" class="form-submit"><span>Submit</span></button>
            </form>
        </div>
        <div class="repo-list">
            <div id="existent-repo"></div>
            <input type="submit" class="btn btn-md" id="view-all" value="View all repositories data"
                   onclick="window.location='/repositories/listAll';" />
        </div>

        <div id="search-result">
            <p class="close">X</p>
        </div>

        <div class="loading-mask hidden" data-role="loader">
            <div class="loader">
                <img alt="Se incarca..." src="/static/media/images/loadloop.gif">
            </div>
        </div>

        <div class="create-repo">
            <div id="create-repository">
                <a id="create-repo-btn" class="btn btn-md">Create repository</a>
            </div>

            <div class="create-repo-container hidden">
            <div class="progress visible">
                <div class="progress-track"></div>
                <div class="progress-step" id="progress-step1">Select OS</div>
                <div class="progress-step" id="progress-step2">Select Version</div>
                <div class="progress-step" id="progress-step3">Select Software</div>
                <div class="progress-step" id="progress-step4">Upload File</div>
                <div class="progress-step" id="progress-step5">Add Tags</div>
            </div>
            <div class="loading-mask hidden" data-role="loader">
                <div class="loader">
                    <img alt="Se incarca..." src="/static/media/images/loadloop.gif">
                </div>
            </div>
            <div id="steps">

                <div class="chose-repo repo-step step-1">
                    <div class="available-repos">

                    </div>
    <!--                <span class="available-repos-select">  <span tooltip="Click to select repository" class="tooltip"></span></span>-->
                    <p class="error hidden">Please select a repository</p>
                </div>

                <div class="choose-version repo-step step-2">
                    <div class="available-versions">

                    </div>
                    <p class="error hidden">Please select a repository</p>
                </div>

                <div class="choose-app repo-step step-3">
                    <div class="available-apps">

                    </div>
                    <label>Create a new application</label>
                    <input type="text" name="new_app" />
                    <p class="error hidden">Please select a repository</p>
                </div>

                <div class="upload-app repo-step step-4">
                    <div class="fileUpload btn-primary">
                        <span class="upload-text">Select files to upload</span>
                        <input name="userFile" id="userFile" multiple="" max="1" type="file" class="upload" />
                        <input name="repository_id" id="repository_id" type="hidden"  />
                    </div>
                    <button  type="button" class="hidden" id="delete-file">Delete File</button>
                    <div id="targetLayer"></div>
                    <div class="uploaded_files_elements"></div>
                </div>

                <div class="add-tags repo-step step-5">
                    <p class="uploaded_file"></p>
                        <div class="fieldset">
                        <label>Description</label>
                            <input type="text" name="description" />
                    </div>

                    <div class="fieldset required">
                    <label>Version</label>
                    <input type="text" name="version" />
                    </div>
                    <div class="fieldset">
                    <label>Official Site</label>
                    <input type="text" name="official_site" />
                    </div>
                    <div class="fieldset">
                    <label>Tags (separated by ,)</label>
                    <input type="text" name="repository_tags" />
                    </div>
                </div>

                <input type="hidden" name="file_for_repo" />
            </div>

            <button id="prev" data-step="1" class="hidden prev" disabled="disabled">Previous</button>
            <button id="next" data-step="1" class="hidden next" disabled="disabled">Next</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('document').ready(function() {

    });
</script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/jstree.min.js"></script>

<script src="<?= $baseUrl ?>/static/js/createJsonTree.js"></script>
<script src="<?= $baseUrl ?>/static/js/upload.js"></script>

