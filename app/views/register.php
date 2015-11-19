<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/2.3.2/css/bootstrap.min.css">
</head>

<body>
    <form class="form-horizontal" action="/register" method="POST">
        <fieldset>
            <div id="legend">
                <legend class="">Register</legend>
            </div>
            <div class="control-group">
                <!-- Username -->
                <label class="control-label" for="username">Username</label>
                <div class="controls">
                    <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
                    <p class="help-block">Username can contain any letters or numbers, without spaces</p>
                </div>
            </div>
            <div class="control-group">
                <!-- Password-->
                <label class="control-label" for="password">Password</label>
                <div class="controls">
                    <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
                    <p class="help-block">Password should be at least 4 characters</p>
                </div>
            </div>
            <div class="control-group">
                <!-- Password -->
                <label class="control-label" for="password_confirm">Password (Confirm)</label>
                <div class="controls">
                    <input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge">
                    <p class="help-block">Please confirm password</p>
                </div>
            </div>
            <div class="control-group">
                <!-- Button -->
                <div class="controls">
                    <button class="btn btn-success">Register</button>
                </div>
            </div>
        </fieldset>
    </form>
</body>

</html>
