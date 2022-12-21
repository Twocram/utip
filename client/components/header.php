<header id="header">
    <div class="container">
        <div class="header-nav">
            <div class="header-main__links">
                <a href="./index.php" class="header-main__link">Главная</a>
            </div>
            <div class="header-sub__links">
                <div class="user-info">
                    <?php echo $_SESSION['auth']['user']['email'] ?>
                </div>
                <a href="#" class="header-sub__link logout">Выйти</a>
            </div>
        </div>
    </div>

</header>