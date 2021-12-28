<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/styleCreateAccount.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <form action="login" method="POST">
                <img src="public/img/logo.svg" id="logo">
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
                <button type="submit">SIGN IN</button>
                <button>SIGN UP</button>
            </form>
        </div>
    </div>
</body>