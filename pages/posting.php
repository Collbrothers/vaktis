<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/auth.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php require_once '../includes/csrf.php'; ?>
<?php
global $pdo;
$error = $_SESSION['error'] ?? null;
unset($_SESSION['error']);


$stmt = $pdo->prepare("SELECT * FROM municipalities");
$stmt->execute();
$municipalities = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM services");
$stmt->execute();
$services = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM animal_types");
$stmt->execute();
$animal_types = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM sizes");
$stmt->execute();
$sizes = $stmt->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (empty($_POST["csrf_token"]) || !verifyCsrfToken($_POST["csrf_token"])) {
        die;
    }

    if (empty($_POST['name']) || empty($_POST['service']) || empty($_POST['pay']) || empty($_POST['municipality']) || empty($_POST['animal_type']) || empty($_POST['size']) || empty($_POST['date']) || empty($_POST['other'])) {
        $_SESSION['error'] = "Vänligen fyll i alla fält.";
        header('Location: /posting');
        exit;
    }

    $name = $_POST['name'];
    $service = $_POST['service'];
    $pay = $_POST['pay'];
    $municipality = $_POST['municipality'];
    $animal_type = $_POST['animal_type'];
    $size = $_POST['size'];
    $date = $_POST['date'];
    $other = $_POST['other'];

    // check title length (no longer than 100) and ohter (no longer than 500)
    if (strlen($name) > 100) {
        $_SESSION['error'] = "Djur namn får inte vara längre än 100 tecken.";
        header('Location: /posting');
        exit;
    }

    if (strlen($other) > 500) {
        $_SESSION['error'] = "Beskrivning får inte vara längre än 500 tecken.";
        header('Location: /posting');
        exit;
    }

    if (!is_numeric($pay) || $pay < 0) {
        $_SESSION['error'] = "Ersättning måste vara ett positivt nummer.";
        header('Location: /posting');
        exit;
    }

    if ($pay >= 2147483647) {
        $_SESSION['error'] = "Ersättning måste vara mindre än 2147483647.";
        header('Location: /posting');
        exit;
    }

    if (strtotime($date) === false) {
        $_SESSION['error'] = "Ogiltigt datum.";
        header('Location: /posting');
        exit;
    }

    // check if the POSTed service id, municlipality id etc exists in the fetched data

    if (!in_array($service, array_column($services, 'id'))) {
        $_SESSION['error'] = "Ogiltig tjänst.";
        header('Location: /posting');
        exit;
    } elseif (!in_array($animal_type, array_column($animal_types, 'id'))) {
        $_SESSION['error'] = "Ogiltig djurtyp.";
        header('Location: /posting');
        exit;
    } elseif (!in_array($size, array_column($sizes, 'id'))) {
        $_SESSION['error'] = "Ogiltig storlek.";
        header('Location: /posting');
        exit;
    } elseif (!in_array($municipality, array_column($municipalities, 'id'))) {
        $_SESSION['error'] = "Ogiltig kommun.";
        header('Location: /posting');
        exit;
    }


    $stmt = $pdo->prepare("INSERT INTO job_postings (title, service_id, pay, municipality_id, animal_type_id, size_id, date_needed, description, owner_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
            $name,
            $service,
            $pay,
            $municipality,
            $animal_type,
            $size,
            $date,
            $other,
            $_SESSION["user"]['id']
    ]);

    header('Location: /');
    exit;

}

if (empty($_SESSION["csrf_token"])) {
    generateRandomHexString();
}
?>
<?php require_once '../includes/header.php'; ?>
    <main>
        <div class="posting-container">
            <form class="posting-card" id="posting-form" method="POST" action="/posting">
                <div class="posting-card-content-1">
                    <!--<img class="posting-card-image"
                        src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                        alt="Bild över husdjuret">-->
                    <div class="posting-card-image-placeholder">
                        <label class="posting-uploade-image-btn" for="posting-file-hide">Ladda up bild</label>
                        <input name="photo" id="posting-file-hide" type="file">
                    </div>
                </div>
                <div class="posting-card-content-2">
                    <h1 class="posting-skapa-annanos">Skapa annons</h1>
                    <div class="posting-text">
                        <div class="posting-two-row">
                            <!--Input dog name-->
                            <div class="posting-optin-container">
                                <label class="posting-no-wrap" for="posting-dog-name">Djur namn:</label>
                                <input name="name" class="posting-input" id="posting-dog-name" type="text" required>
                            </div>
                            <!--END-->
                            <!--Services dropdown-->
                            <div class="posting-optin-container">
                                <label for="services">Tjänster:</label>
                                <div class="posting-dropdown">
                                    <select name="service" id="services" form="posting-form" required>
                                        <?php foreach ($services as $service): ?>
                                            <option value="<?= $service['id']; ?>"><?= $service['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--END-->
                        </div>
                        <div class="posting-two-row">
                            <!--Payment-->
                            <div class="posting-optin-container">
                                <label for="option-payment">Ersättning:</label>
                                <input name="pay" class="posting-input-number" type="number" required>kr
                            </div>
                            <!--END-->
                            <!--Kommun dropdown-->
                            <div class="posting-optin-container">
                                <label for="kommun">Kommun:</label>
                                <div class="posting-dropdown">
                                    <select name="municipality" id="kommun" form="posting-form" required>
                                        <?php foreach ($municipalities as $municipality): ?>
                                            <option value="<?= $municipality['id']; ?>"><?= $municipality['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--END-->
                        </div>
                        <div class="posting-two-row">
                            <!--Djurtyp dropdown-->
                            <div class="posting-optin-container">
                                <label for="djurtyp">Djurtyp:</label>
                                <div class="posting-dropdown">
                                    <select name="animal_type" id="djurtyp" form="posting-form" required>
                                        <?php foreach ($animal_types as $animal_type): ?>
                                            <option value="<?= $animal_type['id']; ?>"><?= $animal_type['name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--END-->
                            <!--Storlek dropdown-->
                            <div class="posting-optin-container">
                                <label for="storlek">Storlek:</label>
                                <div class="posting-dropdown">
                                    <select name="size" id="storlek" form="posting-form" required>
                                        <?php foreach ($sizes as $size): ?>
                                            <option value="<?= $size['id']; ?>"><?= $size['name']; ?>
                                                (<?= $size["weight_min_kg"] ?>-<?= $size["weight_max_kg"] ?> kg)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <!--END-->
                        </div>
                        <!--Date form/to-->
                        <div class="posting-date-container">
                            <div class="posting-optin-date-container">
                                <label for="datum-input">Datum:</label>
                                <div class="posting-align">
                                    <input name="date" type="date" class="index-filter-date" id="datum-input" required>
                                </div>
                            </div>
                        </div>
                        <!--END-->
                    </div>
                    <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION["csrf_token"]) ?>">
                    <div class="posting-form-container">
                        <h2>Övrig info</h2>
                        <textarea name="other" id="posting-text" rows="8" required></textarea>
                        <input id="posting-btn" type="submit" value="Publicera">
                    </div>
                </div>
            </form>
        </div>
    </main>
<?php require_once '../includes/footer.php'; ?>