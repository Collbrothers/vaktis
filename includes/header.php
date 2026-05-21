<?php require_once "../includes/session.php"; ?>
    <!DOCTYPE html>
    <html lang="sv">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>vaktis</title>
        <link rel="stylesheet" href="/public/style.css">
        <script src="/public/main.js" defer></script>
    </head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px"
                         fill="blacik">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </a></li>
            <li><a href="/index">Annonser</a></li>
            <li><a href="/report">Rapportera</a></li>
            <li><a href="/about">Om Oss</a></li>
            <?php if (isset($_SESSION["user"]["email"])): ?>
                <li><a href="/profile">Min Profil</a></li>
            <?php else: ?>
                <li><a href="/signup">Skapa Konto</a></li>
                <li><a href="/login">Logga In</a></li>
            <?php endif; ?>
        </ul>
        <ul>
            <li><a class="logo-click-on-phone" href="/"><img src="/public/vaktis-logga.png"
                                                             alt="A logo that with a dog paw followed by the text vaktis"></a>
            </li>
            <li class="hideOnMobile nav-button"><a href="/index">Annonser</a></li>
            <li class="hideOnMobile nav-button"><a href="/report">Rapportera</a></li>
            <li class="hideOnMobile nav-button"><a href="/about">Om Oss</a></li>
            <?php if (isset($_SESSION["user"]["email"])): ?>
                <li class="hideOnMobile nav-button-important"><a href="/profile">Min Profil</a></li>
            <?php else: ?>
                <li class="hideOnMobile nav-button-important"><a href="/signup">Skapa Konto</a></li>
                <li class="hideOnMobile nav-button-important"><a href="/login">Logga In</a></li>
            <?php endif; ?>
            <li class="menu-button" onclick="showSidebar()"><a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px"
                         fill="#f5f0e8">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                    </svg>
                </a></li>
        </ul>
    </nav>
<?php require_once '../includes/cookie.php' ?>