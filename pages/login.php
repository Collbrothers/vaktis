<?php require_once '../includes/header.php'; ?>
<main>
    <div class="sign-up-card-container sign-in-card-top-margin">
        <form class="sign-up-card sign-up-card-width" action="post">
            <div id="h1-skapa-konto-container">
                <h1>Logga In</h1>
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-in-mail">Epost</label>
                <input type="text" id="sign-in-mail" placeholder="example@email.com">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-in-psw">Lösenord</label>
                <input type="password" id="sign-in-psw" placeholder="•••••••••••">
            </div>
            <div class="sign-up-card-btn-container">
                <input type="button" id="sign-up-create-btn" value="Logga In">
            </div>
        </form>
    </main>
</div><?php require_once '../includes/footer.php'; ?>