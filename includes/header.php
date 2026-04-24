<?php
session_start();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>vaktis</title>
    <link rel="stylesheet" href="../public/style.css">
    <script src="../public/main.js"></script>
</head>
<body>
    <nav>
        <ul class="sidebar">
            <li onclick=hideSidebar()><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="blacik"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
            <li><a href="../pages/index.php">Annonser</a></li>
            <li><a href="../pages/report.php">Rapportera</a></li>
            <li><a href="../pages/about.php">Om Oss</a></li>
            <li><a href="../pages/signup.php">Skapa Konto</a></li>
            <li><a href="../pages/signin.php">Logga in</a></li>
        </ul>
        <ul>
            <li><a class="logo-click-on-phone" href="index.php"><img src="../public/vaktis-logga.png" alt="A logo that with a dog paw followed by the text vaktis"></a></li>
            <li class="hideOnMobile nav-button"><a href="../pages/index.php">Annonser</a></li>
            <li class="hideOnMobile nav-button"><a href="../pages/report.php">Rapportera</a></li>
            <li class="hideOnMobile nav-button"><a href="../pages/about.php">Om Oss</a></li>
            <li class="hideOnMobile nav-button-important"><a href="../pages/signup.php">Skapa Konto</a></li>
            <li class="hideOnMobile nav-button-important"><a href="../pages/signin.php">Logga In</a></li>
            <li class="menu-button" onclick="showSidebar()" ><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="26px" viewBox="0 -960 960 960" width="26px" fill="#f5f0e8"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>
