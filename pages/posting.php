<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/header.php'; ?>
<main>
    <div class="posting-container">
        <form class="posting-card" id="posting-form">
            <div class="posting-card-content-1">
                <!--<img class="posting-card-image"
                    src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                    alt="Bild över husdjuret">-->
                <div class="posting-card-image-placeholder">
                    <label class="posting-uploade-image-btn" for="posting-file-hide">Ladda up bild</label>
                    <input id="posting-file-hide" type="file">
                </div>
            </div>
            <div class="posting-card-content-2">
                <h1 class="posting-skapa-annanos">Skapa annons</h1>
                <div class="posting-text">
                    <div class="posting-two-row">
                        <!--Input dog name-->
                        <div class="posting-optin-container">
                            <label class="posting-no-wrap" for="posting-dog-name">Djur namn:</label>
                            <input class="posting-input" id="posting-dog-name" type="text">
                        </div>
                        <!--END-->
                        <!--Services dropdown-->
                        <div class="posting-optin-container">
                            <label for="services">Tjänster:</label>
                            <div class="posting-dropdown">
                                <select name="" id="services" form="posting-form">
                                    <option value="Hundpromenad">Hundpromenad</option>
                                    <option value="Hundpassning">Hundpassning</option>
                                    <option value="Kattvakt">Kattvakt</option>
                                    <option value="Husdjursvakt">Husdjursvakt</option>
                                    <option value="Inackordering">Inackordering</option>
                                </select>
                            </div>
                        </div>
                        <!--END-->
                    </div>
                    <div class="posting-two-row">
                        <!--Payment-->
                        <div class="posting-optin-container">
                            <label for="option-payment">Ersättning:</label>
                            <input class="posting-input-number" type="number">kr
                        </div>
                        <!--END-->
                        <!--Kommun dropdown-->
                        <div class="posting-optin-container">
                            <label for="kommun">Kommun:</label>
                            <div class="posting-dropdown">
                                <select name="" id="kommun" form="posting-form">
                                    <option value="skovde">Skövde</option>
                                    <option value="mariestad">Maritestad</option>
                                    <option value="tibro">Tibro</option>
                                    <option value="arvika">Arvika</option>
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
                                <select name="" id="djurtyp" form="posting-form">
                                    <option value="hund">Hund</option>
                                    <option value="katt">Katt</option>
                                    <option value="kanin">Kanin</option>
                                    <option value="fagel">Fågel</option>
                                    <option value="reptil">Reptil</option>
                                    <option value="gnagare">Gnagare</option>
                                </select>
                            </div>
                        </div>
                        <!--END-->
                        <!--Storlek dropdown-->
                        <div class="posting-optin-container">
                            <label for="storlek">Storlek:</label>
                            <div class="posting-dropdown">
                                <select name="" id="storlek" form="posting-form">
                                    <option value="liten">Liten (0-10 kg)</option>
                                    <option value="mellan">Mellan (10-25 kg)</option>
                                    <option value="stor">Stor (25+ kg)</option>
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
                                <input type="date" class="index-filter-date" id="datum-input">
                            </div>
                        </div>
                    </div>
                    <!--END-->
                </div>
                <div class="posting-form-container">
                    <h2>Övrig info</h2>
                    <textarea id="posting-text" rows="8"></textarea>
                    <input id="posting-btn" type="button" value="Publicera">
                </div>
            </div>
        </form>
    </div>
</main>
<?php require_once '../includes/footer.php'; ?>