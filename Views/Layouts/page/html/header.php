<div id="header">
    <?php $userIsLoggedIn = false?>
</div>
<div id="menu">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse" data-aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <span class="header-logo"></span><a class="navbar-home" href="/"><strong>SOFY</strong></a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="option <?= $containerClass == 'homepage' ? 'selected' : '' ?>"><a href="/">Home</a></li>
                    <li class="option <?= $containerClass == 'features' ? 'selected' : '' ?>"><a href="/about/index">Features</a></li>
                    <li class="option <?= $containerClass == 'about-us' ? 'selected' : '' ?>"><a href="/about/index">About us</a></li>
                    <li class="option <?= $containerClass == 'contact'  ? 'selected' : '' ?>"><a href="/contact/index">Contact</a></li>
                    <li class="dropdown" style="float:right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           data-aria-expanded="false"><span class="carety" id="user-account"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (!$isLoggedIn):?>
                                <li><a href="/user/login">Login</a></li>
                                <li><a href="/user/login">Registration</a></li>
                            <?php else:?>
                                <li><a href="/account/index">My account</a></li>
                                <li><a href="/account/repositories">My Repositories</a></li>
                                <li><a href="/account/settings">Personal Data</a></li>
                                <li><a href="/account/logout">Logout</a></li>
                            <?php endif?>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</div>