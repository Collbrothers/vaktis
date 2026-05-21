<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php
global $pdo;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["csrf_token"]) || !verifyCsrfToken($_POST["csrf_token"])) {
        die();
    }


    if (empty($_POST["username"]) || empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["password_confirm"])) {
        $_SESSION['error'] = "Vänligen fyll i alla fält.";
        header('Location: /signup');
        exit;
    }

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $password_confirm = $_POST["password_confirm"];

    if ($password != $password_confirm) {
        $_SESSION['error'] = "Lösenorden matchar inte.";
        header('Location: /signup');
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "E-postaddressen är inte giltig.";
        header('Location: /signup');
        exit;
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Lösenordet måste vara minst 8 tecken långt.";
        header('Location: /signup');
        exit;
    }

    if (strlen($username) > 50) {
        $_SESSION['error'] = "Namnet får inte vara längre än 50 tecken.";
        header('Location: /signup');
        exit;
    }

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "E-postadressen är redan registrerad.";
        header('Location: /signup');
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_ARGON2ID);
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->execute([$username, $email, $hashedPassword]);

    if ($stmt->rowCount() > 0) {
        $_SESSION["user"] = [
                "name" => $username,
                "email" => $email,
                "is_admin" => false
        ];
        header('Location: /');
    } else {
        header("Location: /login");
    }

    exit;
}
if (empty($_SESSION["csrf_token"])) {
    generateRandomHexString();
}

?>
<?php require_once '../includes/header.php'; ?>
<main>
    <div class="sign-up-card-container">

        <div id="form-error" class="form-error" <?= $error ? "" : "hidden" ?>>
            <p><?= htmlspecialchars($error) ?></p>
        </div>
        <form class="sign-up-card sign-up-card-width sign-up-card-top-margin" method="POST" id="sign-up-form">
            <div id="h1-skapa-konto-container">
                <h1>Skapa Konto</h1>
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-name">Namn</label>
                <input type="text" id="sign-up-name" name="username" placeholder="Anna Svensson">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-mail">Epost</label>
                <input type="email" id="sign-up-mail" name="email" placeholder="example@email.com">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-psw">Lösenord</label>
                <input type="password" id="sign-up-psw" name="password" placeholder="Minst 8 tecken">
            </div>
            <div class="sign-up-card-inputs">
                <label for="sign-up-psw-confirm">Bekräfta Lösenord</label>
                <input type="password" id="sign-up-psw-confirm" name="password_confirm" placeholder="Minst 8 tecken">
            </div>
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">
            <div class="sign-up-card-btn-container">
                <input type="submit" id="sign-up-create-btn" value="Skapa Konto">
            </div>
        </form>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>
