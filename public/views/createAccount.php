<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateAccount.css">
    <script type="text/javascript" src="./public/js/mark.js" defer></script>
    <script type="text/javascript" src="./public/js/registration.js" defer></script>
    <title>CREATE ACCOUNT</title>
</head>
<body>
    <div class="container">
        <div class="login-container">           
            <form name="formJS" action="createAccount" method="POST">
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
                <input name="email" type="text" placeholder="email" required>
                <input name="password" type="password" placeholder="password" required>
                <input name="passwordRepeat" type="password" placeholder="confirm password" required>
                <button type="submit">SIGN UP</button>
                <p>Already have account?</p>
                <button type="button" onclick="location.href='/index';">SIGN IN</button>
            </form>
        </div>
    </div>
</body>