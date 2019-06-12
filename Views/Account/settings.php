<div class="col-sm-3" id="account-navigation">
    <?php require_once ('html\left_navigation.php')?>
</div>
<div class="col-sm-9">
    <div class="settings">
        <h2>Account Settings</h2>
        <form action="/user/changeAccountDetails" method="post">
            <table>
                <tr>
                    <td class="fieldset required">
                        <label for="name">Name</label>
                    </td>
                    <td class="fieldset required">
                        <input type="text" id="name" class="form-control" placeholder="Email address" value="<?= $userName ?>" name="name">
                    </td>
                </tr>
                <tr>
                    <td class="fieldset required">
                        <label for="email">Email address</label>
                    </td>
                    <td class="fieldset required">
                        <input type="text" id="email" class="form-control" placeholder="Email address" value="<?= $email ?>"  name="email">
                    </td>
                </tr>
                <tr>
                    <td class="fieldset required">
                        <label for="password">Enter Password to Confirm</label>
                    </td>
                    <td class="fieldset required">
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password"
                               minlength="8" required>
                    </td>
                </tr>
            </table>
            <br/>
            <input type="submit" class="btn btn-md" value="Submit Changes">
        </form>
        <hr class="account-settings-separator" />
        <form action="/user/changePassword" method="post">
            <table>
                <tr>
                    <td class="fieldset required">
                        <label for="password">Enter Current Password</label>
                    </td>
                    <td class="fieldset required">
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password"
                               minlength="8" required>
                    </td>
                </tr>
                <tr>
                    <td class="fieldset required">
                        <label for="password">Enter New Password</label>
                    </td>
                    <td class="fieldset required">
                        <input type="password" id="password" class="form-control" placeholder="Password" name="password_change"
                               minlength="8" required>
                    </td>
                </tr>
            </table>
            <br/>
            <input type="submit" class="btn btn-md" value="Submit Changes">
        </form>
    </div>
</div>