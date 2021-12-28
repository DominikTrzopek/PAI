<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateAccount.css">
    <title>CREATE ACCOUNT</title>
</head>
<body>
    <div class="container">
        <div class="login-container">           
            <form action="createAccount" method="POST">
                <p>Welcome to Edival! Let's get started.</p>
                <img src="public/img/logo.svg" id="logo2">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $msg)
                            echo $msg;
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email">
                <input name="password" type="password" placeholder="password">
                <input name="passwordRepeat" type="password" placeholder="confirm password">
                <button type="submit">SIGN UP</button>
                <p>Already have account?</p>
                <button type="button" onclick="location.href='/index';">SIGN IN</button>
            </form>
        </div>
    </div>
</body>