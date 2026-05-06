<?php require_once '../includes/header.php'; ?>
<main>
    <div class="sign-up-card-container">
        <form class="login-card sign-up-card-width" action="post">
            <div id="h1-skapa-konto-container">
                <h1>Skapa Konto</h1>
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-name">Namn</label>
                <input type="text" id="sign-up-name" placeholder="Anna Svensson">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-mail">Epost</label>
                <input type="text" id="sign-up-mail" placeholder="example@email.com">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-psw">Lösenord</label>
                <input type="password" id="sign-up-psw" placeholder="Minst 8 tecken">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-psw-confirm">Bekräfta Lösenord</label>
                <input type="password" id="sign-up-psw-confirm" placeholder="Minst 8 tecken">
            </div>
            <div class="sign-up-card-btn-container">
                <input type="button" id="sign-up-create-btn" value="Skapa Konto">
            </div>
        </form>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>
