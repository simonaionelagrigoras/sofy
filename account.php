<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="static/css/main.css" />
    <link rel="stylesheet" href="static/css/upload.css" />
    <script src="static/js/main.js"></script>
    <script src="static/js/upload.js"></script>
    <!-- Used for responsive design in order to control dimensions and scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('settings.php');?>
</head>
<body>
<?php require_once (getDir('page\html\header.php'))?>

<div class="container  my-account">
    <div class="content">
            <div class="col-sm-3" id="account-navigation">
                <div class="sidebar-nav">
                    <div class="navbar navbar-default account" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="account-navbar-toggle" data-toggle="collapse" data-aria-expanded="false"
                                    data-target=".sidebar-navbar-collapse-account">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="visible-xs navbar-brand">My Account</span>
                        </div>
                        <div class="navbar-collapse collapse sidebar-navbar-collapse-account">
                            <ul class="nav navbar-nav account">
                                <li class="active"><a href="#">Profile</a></li>
                                <li id="account-repository"><a href="#">My Repositories</a></li>
                                <li><a href="#">Account settings</a></li>
                                <li><a href="#">Messages <span class="badge">2</span></a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <div class="profile">
                    <h3>John</h3>
                    <div class="profile-photo">
                        <img src="static/media/images/profile.jpg" width="100">
                    </div>
                    <p><strong>Repositories updates:</strong> 3</p>
                    <p><strong>Content size:</strong> 464 KB</p>
                </div>
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
                            <div id="loader-icon" style="display: none;"><img src="static/media/images/loader.gif"></div>
                            <div><div class="delete_file"></div></div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
    <?php require_once (getDir('page\html\footer.php'))?>
</div>
</body>
</html>