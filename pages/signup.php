<?php require_once '../includes/header.php'; ?>
<div class="sign-up-card-container">
    <form class="sign-up-card sign-up-card-width" action="post">
        <h1>Skapa Konto</h1>
        <div class="sign-up-card-inputs">
            <label for="sign-up-name">Namn</label>
            <input type="text" id="sign-up-name">
        </div>
        <div class="sign-up-card-inputs">
            <label for="sign-up-mail">Epost</label>
            <input type="text" id="sign-up-mail">
        </div>
        <div class="sign-up-card-inputs">
            <label for="sign-up-psw">Lösenord</label>
            <input type="password" id="sign-up-psw">
        </div>
        <div class="sign-up-card-inputs">
            <label for="sign-up-psw-confirm">Bekräfta Lösenord</label>
            <input type="password" id="sign-up-psw-confirm">
        </div>
        <div class="sign-up-card-btn-container">
            <input type="button" id="sign-up-cancle-btn" value="Avbryt" onclick="location.href='index.php'">
            <input type="button" id="sign-up-create-btn" value="Skapa Konto">
        </div>
    </form>
</div>
<?php require_once '../includes/footer.php'; ?>
