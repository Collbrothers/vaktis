<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php
global $pdo;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["csrf_token"]) || !verifyCsrfToken($_POST["csrf_token"])) {
        die;
    }

    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $_SESSION['error'] = "Vänligen fyll i alla fält.";
        header('Location: /login');
        exit;
    }

    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $pdo->prepare("SELECT id, name, password, is_admin FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if (!$user) {
        $_SESSION['error'] = "Fel e-post eller lösenord.";
        header('Location: /login');
        exit;
    }

    if (!password_verify($password, $user["password"])) {
        $_SESSION['error'] = "Fel e-post eller lösenord.";
        header('Location: /login');
        exit;
    }
    $_SESSION["user"] = [
            "id" => $user["id"],
            "name" => $user["name"],
            "email" => $email,
            "is_admin" => $user["is_admin"] ?? false
    ];
    session_regenerate_id(true); // Session fixation prevention hehe
    header("Location: /");
    exit;
}

if (empty($_SESSION["csrf_token"])) {
    generateRandomHexString();
}


?>
<?php require_once '../includes/header.php'; ?>
    <main>
        <div class="sign-up-card-container sign-in-card-top-margin">
            <?php if (!empty($error)): ?>
                <p class="error"><?= htmlspecialchars($error) ?></p>
            <?php endif; ?>
            <form class="sign-up-card sign-up-card-width" method="POST">
                <div id="h1-skapa-konto-container">
                    <h1>Logga In</h1>
                </div>
                <div class="sign-up-card-inputs">
                    <label for="sign-in-mail">Epost</label>
                    <input type="text" id="sign-in-mail" name="email" placeholder="example@email.com">
                </div>
                <div class="sign-up-card-inputs">
                    <label for="sign-in-psw">Lösenord</label>
                    <input type="password" id="sign-in-psw" name="password" placeholder="•••••••••••">
                </div>
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>">
                <div class="sign-up-card-btn-container">
                    <input type="submit" id="sign-up-create-btn" value="Logga In">
                </div>
            </form>
            <div>
    </main>
<?php require_once '../includes/footer.php'; ?>