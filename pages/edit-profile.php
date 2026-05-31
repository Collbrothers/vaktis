<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php
global $pdo;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (empty($_POST["csrf_token"]) || !verifyCsrfToken($_POST["csrf_token"])) {
        die;
    }

    if (!isset($_POST["description"])) {
        $_SESSION['error'] = "Vänligen fyll i alla fält.";
        header('Location: /edit-profile');
        exit;
    }

    if (strlen($_POST["description"]) > 100) {
        $_SESSION['error'] = "Beskrivningen kan inte vara längre än 100 tecken.";
        header('Location: /edit-profile');
        exit;
    }

    $stmt = $pdo->prepare("UPDATE users SET description = ? WHERE id = ?");
    $stmt->execute([$_POST["description"], $_SESSION["user"]["id"]]);
    header("Location: /profile");
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION["user"]["id"]]);
$user = $stmt->fetch();

$stmt = $pdo->prepare("
    SELECT jp.*, COUNT(a.id) AS application_count
    FROM job_postings jp
    LEFT JOIN applications a ON a.posting_id = jp.id
    WHERE jp.owner_id = ?
    GROUP BY jp.id
");
$stmt->execute([$user["id"]]);
$job_postings = $stmt->fetchAll();

if (empty($_SESSION["csrf_token"])) {
    generateRandomHexString();
}

?>
<?php require_once '../includes/header.php'; ?>
<main>
    <div class="profile-container">
        <div class="profile-card">
            <div class="profile-card-picture">
                <img src="/public/avatar-icon.png" alt="">
            </div>
            <div class="profile-card-text">
                <div class="justify-content-center">
                    <h2><?= htmlspecialchars($user["name"]) ?></h2>
                </div>
                <div class="profile-description">
                    <label>Beskrivning:</label>
                    <form method="post" action="/edit-profile">
                        <textarea name="description" id="" rows="8"></textarea>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                        <input class="edit-profile-submit-btn" type="submit" value="Spara">
                    </form>
                </div>
                <div class="profile-mail">
                    <label for="">Epost:</label>
                    <div class="wrapper">
                        <p class="green-box"><?= htmlspecialchars($user["email"]) ?></p>
                        <div id="mail-cover-box" class="profile-overlay"></div>
                    </div>
                </div>
                <div class="profile-account-created">
                    <p>Konto Skapades:</p>
                    <p class="green-box"><?= date("Y-m-d", strtotime($user["created_at"])) ?></p>
                </div>
            </div>
            <div class="profile-post-container">
                <h3>Mina Annonser:</h3>
                <div class="profile-posts-scrollbar">
                    <?php foreach ($job_postings as $job_posting) : ?>
                    <div class="wrapper">
                        <div class="profile-active-posts-container">
                            <div class="profile-active-posts">
                                <div class="profile-active-posts-small-container">
                                    <label for="">Annons:</label>
                                    <p><?= htmlspecialchars($job_posting["title"]) ?></p>
                                </div>
                                <div class="profile-active-posts-small-container">
                                    <label class="profile-hide-on-mobile" for="">Ansökninger:</label>
                                    <p class="profile-important"><?= htmlspecialchars($job_posting["application_count"]) ?></p>
                                </div>
                            </div>
                        </div>
                        <a class="profile-overlay-2" href="/read-more?id=<?= $job_posting["id"] ?>"></a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>