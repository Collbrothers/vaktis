<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php
global $pdo;

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
                    <p class="green-box"><?= $user["description"] ? htmlspecialchars($user["description"]) : "Ingen beskrivning" ?></p>
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
            <a href="/edit-profile" class="edit-profile-anchor">Redigera Profil</a>
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