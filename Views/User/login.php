<h2 class="text-center" id="title">SOFY - Software Online Repository</h2>
<hr>
<div class="content login-register">
    <div class="col-sm-6">
        <h3>Create an account:</h3>
        <form action="/action_page.php" method="post">
            <div class="fieldset required">
                <label for="name">Name</label>
                <input type="text" id="name" class="form-control" placeholder="Email address" name="name">
            </div>
            <div class="fieldset required">
                <label for="email">Email address</label>
                <input type="text" id="email" class="form-control" placeholder="Email address" name="email">
            </div>
            <div class="fieldset required">
                <label for="password">Password</label>
                <input type="password" id="password" class="form-control" placeholder="Password" name="password"
                       minlength="8" required>
            </div>
            <div class="fieldset required">
                <label for="confirm-password">Confirm password</label>
                <input type="password" id="confirm-password" class="form-control" placeholder="Password" name="confirm-password"
                       minlength="8" required>
            </div>
            <input type="submit" class="btn btn-md" value="Sign In">
        </form>
    </div>
    <div class="col-sm-6">
        <h3>Login with existing account:</h3>
        <form action="/action_page.php" method="post">
            <div class="fieldset required">
                <label for="email_login">Email address</label>
                <input type="text" id="email_login" class="form-control" placeholder="Email address" name="email">
            </div>
            <div class="fieldset required">
                <label for="password_login">Password</label>
                <input type="password" id="password_login" class="form-control" placeholder="Password" name="password"
                       minlength="8" required>
            </div>
            <input type="submit" class="btn btn-md" value="Sign Up">
        </form>
   </div>
</div>
