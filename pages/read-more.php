<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php
global $pdo;

if (empty($_GET['id'])) {
    header('Location: /');
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT job_postings.*, pet_images.filename FROM job_postings LEFT JOIN pet_images ON pet_images.id = job_postings.id WHERE job_postings.id = ?");
$stmt->execute([$id]);
$job = $stmt->fetch();

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
                    <form method="POST">
                        <div class="read-more-form-container">
                            <h2>Meddelande</h2>
                            <textarea id="read-more-text" rows="8"></textarea>
                            <input id="read-more-btn" type="button" value="Ansök">
                        </div>
                    </form>
                    <div>

                    </div>
                </div>
            </div>
        </div>
    </main>


<?php require_once '../includes/footer.php'; ?>