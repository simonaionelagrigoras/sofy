<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="static/css/main.css" />
    <script src="static/js/main.js"></script>
    <!-- Used for responsive design in order to control dimensions and scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('settings.php');?>
</head>
<body>
    <?php require_once (getDir('page\html\header.php'))?>

    <div class="container">
        <h2 class="text-center" id="title">SOFY - Software Online Repository</h2>
        <hr>
        <div class="content login-register">
            <div class="col-sm-6">
                <h3>Create an account:</h3>
                <form action="/action_page.php" method="post">
                    <div class="fieldset required">
                        <label for="email">Name</label>
                        <input type="text" class="form-control" placeholder="Email address" name="email">
                    </div>
                    <div class="fieldset required">
                        <label for="email">Email address</label>
                        <input type="text" class="form-control" placeholder="Email address" name="email">
                    </div>
                    <div class="fieldset required">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password"
                               minlength="8" required>
                    </div>
                    <div class="fieldset required">
                        <label for="confirm-password">Confirm password</label>
                        <input type="password" class="form-control" placeholder="Password" name="confirm-password"
                               minlength="8" required>
                    </div>
                    <input type="submit" class="btn btn-md" value="Sign In">
                </form>
            </div>
            <div class="col-sm-6">
                <h3>Login with existing account:</h3>
				<form action="/action_page.php" method="post">
					<label for="email">Email address</label>
					<input type="text" class="form-control" placeholder="Email address" name="email">
					<label for="password">Password</label>
					<input type="password" class="form-control" placeholder="Password" name="password"
						   minlength="8" required>
					<input type="submit" class="btn btn-md" value="Sign Up">
				</form>
		   </div>
        </div>

        <?php require_once (getDir('page\html\footer.php'))?>
    </div>
</body>
</html>
