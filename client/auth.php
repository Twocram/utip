<!DOCTYPE html>

<?php
session_start();

if (isset($_SESSION['auth']['user'])) {
    header('Location: http://localhost/utip-test/client/index.php');
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auth Page</title>
    <link rel="stylesheet" href="./styles/style.css">
</head>

<body>


    <?php require "./components/header.php"; ?>

    <div class="container">


        <div class="form-container">
            <div class="slider">
                <div class="btns">
                    <button class="login">Login</button>
                    <button class="signup">Signup</button>
                </div>
                <div class="slide">
                    <div class="auth-slide__section">
                        <div class="auth-box box-login">
                            <input type="email" id="email-login" class="email ele" placeholder="youremail@email.com">
                            <input type="password" id="password-login" class="password ele" placeholder="password">
                            <button id="login-btn" class="clkbtn">Login</button>
                        </div>
                        <div class="auth-box box-signup">
                            <input type="email" id="email-reg" class="email ele" placeholder="youremail@email.com">
                            <input type="password" id="password-reg" class="password ele" placeholder="password">
                            <button id="reg-btn" class="clkbtn">Signup</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!--         
        <div class="form-container">

            <div class="slider"></div>
            <div class="btn">
                <button class="login">Login</button>
                <button class="signup">Signup</button>
            </div>

            <div class="form-section">

                <div class="login-box">
                    <input type="email" id="email-login" class="email ele" placeholder="youremail@email.com">
                    <input type="password" id="password-login" class="password ele" placeholder="password">
                    <button id="login-btn" class="clkbtn">Login</button>
                </div>

                <div class="login-box">
                    <input type="email" id="email-reg" class="email ele" placeholder="youremail@email.com">
                    <input type="password" id="password-reg" class="password ele" placeholder="password">
                    <button id="reg-btn" class="clkbtn">Signup</button>
                </div>
            </div>
        </div> -->
    </div>


    <script src="./scripts/auth.js"></script>
    <script src="./scripts/logout.js"></script>
    <script src="./scripts/switch.js"></script>
</body>

</html>