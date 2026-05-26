<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php
global $pdo;

if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Location: /');
    exit;
}

$id = $_GET['id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["csrf_token"]) || !verifyCsrfToken($_POST["csrf_token"])) {
        die();
    }
    if (!isset($_SESSION['user'])) {
        header('Location: /login');
        exit;
    }

    $message = trim($_POST['message'] ?? '');

    if (empty($message)) {
        header("Location: /read-more?id=$id");
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO applications (posting_id, applicant_id, message) VALUES (?, ?, ?)");
    $stmt->execute([$id, $_SESSION['user']['id'], $message]);

    header("Location: /read-more?id=$id");
    exit;
}

$stmt = $pdo->prepare("SELECT job_postings.*, pet_images.filename FROM job_postings LEFT JOIN pet_images ON pet_images.id = job_postings.id WHERE job_postings.id = ?");
$stmt->execute([$id]);
$job = $stmt->fetch();

if (!$job) {
    header('Location: /');
    exit;
}

$applications = [];

$is_logged_in = isset($_SESSION['user']);

if ($is_logged_in && $_SESSION['user']['id'] === $job['owner_id']) {
    $stmt = $pdo->prepare("SELECT * FROM applications WHERE posting_id = ?");
    $stmt->execute([$job['id']]);
    $applications = $stmt->fetchAll();
}

if (empty($_SESSION["csrf_token"])) {
    generateRandomHexString();
}

?>
<?php require_once '../includes/header.php'; ?>


    <main>
        <div class="read-more-container">
            <div class="read-more-card">
                <div class="read-more-card-content-1">
                    <?php if ($job["filename"]): ?>
                        <img class="read-more-card-image"
                             src="/public/uploads/<?= htmlspecialchars($job["filename"]) ?>"
                             alt="Bild över husdjuret">
                    <?php else: ?>
                        <div class="index-card-image-placeholder">
                            Ingen Bild
                        </div>
                    <?php endif; ?>
                </div>
                <div class="read-more-card-content-2">
                    <div class="index-text">
                        <h2><?= $job["title"] ?></h2>
                        <p><?= $job["description"] ?></p>
                    </div>
                    <?php if (!$is_logged_in): ?>
                        <div class="read-more-form-container">
                            <p>Logga in för att se ansökningsformuläret.</p>
                        </div>
                    <?php else: ?>
                        <?php if ($_SESSION['user']['id'] !== $job['owner_id']): ?>
                            <form method="POST">
                                <div class="read-more-form-container">
                                    <h2>Meddelande</h2>
                                    <textarea id="read-more-text" name="message" rows="8" required></textarea>
                                    <input type="hidden" name="csrf_token" value="<?= $_SESSION["csrf_token"] ?>">
                                    <input id="read-more-btn" type="submit" value="Ansök">
                                </div>
                            </form>
                        <?php else: ?>
                            <div class="read-more-form-container">
                                <h2>Ansökningar:</h2>
                                <?php if (count($applications) > 0): ?>
                                    <ul>
                                        <?php foreach ($applications as $application): ?>
                                            <li><?= htmlspecialchars($application['message']) ?></li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php else: ?>
                                    <p>Inga ansökningar än.</p>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </main>


<?php require_once '../includes/footer.php'; ?>