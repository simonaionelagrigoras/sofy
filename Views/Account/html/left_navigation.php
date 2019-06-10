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
                <li class="<?= $accMenu == 'profile' ? 'active' : ''?>"><a href="/account/index">Profile</a></li>
                <li class="<?= $accMenu == 'repositories' ? 'active' : ''?>"><a href="/account/repositories">My Repositories</a></li>
                <li class="<?= $accMenu == 'settings' ? 'active' : ''?>"><a href="/account/settings">Account settings</a></li>
                <li class="<?= $accMenu == 'messages' ? 'active' : ''?>"><a href="/account/messages">Messages <span class="badge">2</span></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>