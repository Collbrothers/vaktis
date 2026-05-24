<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/db.php'; ?>
<?php
global $pdo;

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

$conditions = [];
$params = [];

if (!empty($_GET['kommun']))  { $conditions[] = 'municipality_id = ?'; $params[] = (int)$_GET['kommun']; }
if (!empty($_GET['tjanst']))  { $conditions[] = 'service_id = ?';      $params[] = (int)$_GET['tjanst']; }
if (!empty($_GET['djurtyp'])) { $conditions[] = 'animal_type_id = ?';  $params[] = (int)$_GET['djurtyp']; }
if (!empty($_GET['storlek'])) { $conditions[] = 'size_id = ?';         $params[] = (int)$_GET['storlek']; }
if (!empty($_GET['pris_min'])){ $conditions[] = 'pay >= ?'; $params[] = (int)$_GET['pris_min']; }
if (!empty($_GET['pris_max'])){ $conditions[] = 'pay <= ?'; $params[] = (int)$_GET['pris_max']; }
if (!empty($_GET['datum']))   { $conditions[] = 'date_needed = ?'; $params[] = $_GET['datum']; }

$sql = 'SELECT job_postings.*, pet_images.filename FROM job_postings LEFT JOIN pet_images ON pet_images.posting_id = job_postings.id';
if ($conditions) {
    $sql .= ' WHERE ' . implode(' AND ', $conditions);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$job_postings = $stmt->fetchAll();

$selected = [
        'kommun'  => $_GET['kommun']  ?? null,
        'tjanst'  => $_GET['tjanst']  ?? null,
        'djurtyp' => $_GET['djurtyp'] ?? null,
        'storlek' => $_GET['storlek'] ?? null,
        'pris_min'=> $_GET['pris_min']?? null,
        'pris_max'=> $_GET['pris_max']?? null,
        'datum'   => $_GET['datum']   ?? null,
];

?>
<?php require_once '../includes/header.php'; ?>
    <main>
        <button class="index-filter-toggle-btn" onclick="toggleMobileFilters()">
            <span>Filter</span>
            <span class="index-filter-toggle-chevron" id="filter-toggle-chevron"></span>
        </button>
        <form method="GET" action="">
            <input type="hidden" name="kommun"   id="filter-kommun"   value="<?= htmlspecialchars($selected['kommun']  ?? '') ?>">
            <input type="hidden" name="tjanst"   id="filter-tjanst"   value="<?= htmlspecialchars($selected['tjanst']  ?? '') ?>">
            <input type="hidden" name="djurtyp"  id="filter-djurtyp"  value="<?= htmlspecialchars($selected['djurtyp'] ?? '') ?>">
            <input type="hidden" name="storlek"  id="filter-storlek"  value="<?= htmlspecialchars($selected['storlek'] ?? '') ?>">
            <input type="hidden" name="pris_min" id="filter-pris-min" value="<?= htmlspecialchars($selected['pris_min']?? '') ?>">
            <input type="hidden" name="pris_max" id="filter-pris-max" value="<?= htmlspecialchars($selected['pris_max']?? '') ?>">

            <div class="index-filter-container" id="index-filter-container">
                <div class="index-filter-group">
                    <label class="index-filter-label">Kommun</label>
                    <div class="index-dropdown">
                        <button type="button" onclick="kommunFunction()" class="index-dropdown-btn">
                            <span class="index-dropdown-btn-text">Kommuner</span>
                            <span class="index-dropdown-chevron"></span>
                        </button>
                        <div id="kommun-dorpdown" class="index-dropdown-content">
                            <input type="text" placeholder="Sök..." oninput="filterFunctionKommun()">
                            <div class="index-dropdown-scroll">
                                <?php foreach ($municipalities as $municipality): ?>
                                    <a href="#" data-value="<?= $municipality["id"] ?>"><?= htmlspecialchars($municipality['name']) ?></a>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="index-filter-group">
                    <label class="index-filter-label">Tjänst</label>
                    <div class="index-dropdown">
                        <button type="button" onclick="tjanstFunction()" class="index-dropdown-btn">
                            <span class="index-dropdown-btn-text">Tjänster</span>
                            <span class="index-dropdown-chevron"></span>
                        </button>
                        <div id="tjanst-dorpdown" class="index-dropdown-content">
                            <input type="text" placeholder="Sök..." oninput="filterFunctionTjanst()">
                            <?php foreach ($services as $service): ?>
                                <a href="#" data-value="<?= $service["id"] ?>"><?= htmlspecialchars($service['name']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="index-filter-group">
                    <label class="index-filter-label">Djurtyp</label>
                    <div class="index-dropdown">
                        <button type="button" onclick="djurtypFunction()" class="index-dropdown-btn">
                            <span class="index-dropdown-btn-text">Djurtyper</span>
                            <span class="index-dropdown-chevron"></span>
                        </button>
                        <div id="djurtyp-dorpdown" class="index-dropdown-content">
                            <input type="text" placeholder="Sök..." oninput="filterFunctionDjurtyp()">
                            <?php foreach ($animal_types as $animal_type): ?>
                                <a href="#" data-value="<?= $animal_type["id"] ?>"><?= htmlspecialchars($animal_type['name']) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="index-filter-group">
                    <label class="index-filter-label">Storlek</label>
                    <div class="index-dropdown">
                        <button type="button" onclick="storlekFunction()" class="index-dropdown-btn">
                            <span class="index-dropdown-btn-text">Storlekar</span>
                            <span class="index-dropdown-chevron"></span>
                        </button>
                        <div id="storlek-dorpdown" class="index-dropdown-content">
                            <?php foreach ($sizes as $size): ?>
                                <a href="#" data-value="<?= $size["id"] ?>"><?= htmlspecialchars($size['name']) ?> <br> (<?= htmlspecialchars($size["weight_min_kg"]) ?>-<?= $size["weight_max_kg"] ?> kg)</a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="index-filter-group">
                    <label class="index-filter-label">Pris</label>
                    <div class="index-dropdown">
                        <button type="button" onclick="prisFunction()" class="index-dropdown-btn">
                            <span class="index-dropdown-btn-text" id="pris-btn-text">140kr - 270kr</span>
                            <span class="index-dropdown-chevron"></span>
                        </button>
                        <div id="pris-dorpdown" class="index-dropdown-content index-dropdown-content--slider">
                            <div class="index-price-slider-wrapper" id="pris-slider-wrapper">
                                <div class="index-price-track">
                                    <div class="index-price-range" id="pris-range"></div>
                                </div>
                                <div class="index-price-thumb" id="pris-thumb-min" tabindex="0" role="slider"
                                     aria-label="Minimipris"></div>
                                <div class="index-price-thumb" id="pris-thumb-max" tabindex="0" role="slider"
                                     aria-label="Maximipris"></div>
                            </div>
                            <div class="index-price-labels">
                                <span id="pris-min-display">140kr</span>
                                <span id="pris-max-display">270kr</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="index-filter-group">
                    <input type="date" name="datum" class="index-filter-date" id="datum-input"
                           value="<?= htmlspecialchars($selected['datum'] ?? '') ?>">

                </div>
                <div class="index-filter-actions">
                    <button type="submit" class="index-filter-btn-apply">Filtrera</button>
                    <button type="button" onclick="clearFilters()" class="index-filter-btn-clear">Rensa</button>
                </div>
            </div>
        </form>
        <div class="index-container">
            <?php foreach ($job_postings as $job_posting): ?>
            <div class="index-card">
                <div class="index-card-image-placeholder">
                    <?php if ($job_posting['filename']): ?>
                        <img src="/public/uploads/<?= htmlspecialchars($job_posting['filename']) ?>" alt="Bild på husdjur">
                    <?php else: ?>
                        Ingen Bild
                    <?php endif; ?>
                </div>
                <div class="index-text">
                    <h2><?= $job_posting["title"] ?></h2>
                    <p><?= $job_posting["description"] ?></p>
                </div>
                <div class="index-button-container">
                    <a class="index-button" href="/read-more?id=<?= $job_posting["id"] ?>">Läs mer→</a>
                </div>
            </div>
            <?php endforeach; ?>

            <?php if (empty($job_postings)): ?>
                <p>Inga jobb hittades. Försök att ändra dina filterinställningar.</p>
            <?php endif; ?>

        </div>
    </main>

<?php require_once '../includes/footer.php'; ?>