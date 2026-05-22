<?php require_once '../includes/session.php'; ?>
<?php require_once '../includes/header.php'; ?>
<main>
    <button class="index-filter-toggle-btn" onclick="toggleMobileFilters()">
        <span>Filter</span>
        <span class="index-filter-toggle-chevron" id="filter-toggle-chevron"></span>
    </button>
    <div class="index-filter-container" id="index-filter-container">
        <div class="index-filter-group">
            <label class="index-filter-label">Kommun</label>
            <div class="index-dropdown">
                <button onclick="kommunFunction()" class="index-dropdown-btn">
                    <span class="index-dropdown-btn-text">Kommuner</span>
                    <span class="index-dropdown-chevron"></span>
                </button>
                <div id="kommun-dorpdown" class="index-dropdown-content">
                    <input type="text" placeholder="Sök..." oninput="filterFunctionKommun()">
                    <div class="index-dropdown-scroll">
                        <a href="#">Karlsborg</a>
                        <a href="#">Hjo</a>
                        <a href="#">Mariestad</a>
                        <a href="#">Tibro</a>
                        <a href="#">Göteborg</a>
                        <a href="#">Skövde</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="index-filter-group">
            <label class="index-filter-label">Tjänst</label>
            <div class="index-dropdown">
                <button onclick="tjanstFunction()" class="index-dropdown-btn">
                    <span class="index-dropdown-btn-text">Tjänster</span>
                    <span class="index-dropdown-chevron"></span>
                </button>
                <div id="tjanst-dorpdown" class="index-dropdown-content">
                    <input type="text" placeholder="Sök..." oninput="filterFunctionTjanst()">
                    <a href="#">Hundpromenad</a>
                    <a href="#">Hundpassning</a>
                    <a href="#">Kattvakt</a>
                    <a href="#">Husdjursvakt</a>
                    <a href="#">Inackordering</a>
                </div>
            </div>
        </div>
        <div class="index-filter-group">
            <label class="index-filter-label">Djurtyp</label>
            <div class="index-dropdown">
                <button onclick="djurtypFunction()" class="index-dropdown-btn">
                    <span class="index-dropdown-btn-text">Djurtyper</span>
                    <span class="index-dropdown-chevron"></span>
                </button>
                <div id="djurtyp-dorpdown" class="index-dropdown-content">
                    <input type="text" placeholder="Sök..." oninput="filterFunctionDjurtyp()">
                    <a href="#">Hund</a>
                    <a href="#">Katt</a>
                    <a href="#">Kanin</a>
                    <a href="#">Fågel</a>
                    <a href="#">Reptil</a>
                    <a href="#">Gnagare</a>
                </div>
            </div>
        </div>
        <div class="index-filter-group">
            <label class="index-filter-label">Storlek</label>
            <div class="index-dropdown">
                <button onclick="storlekFunction()" class="index-dropdown-btn">
                    <span class="index-dropdown-btn-text">Storlekar</span>
                    <span class="index-dropdown-chevron"></span>
                </button>
                <div id="storlek-dorpdown" class="index-dropdown-content">
                    <a href="#">Liten <br>(0-10 kg)</a>
                    <a href="#">Mellan <br>(10-25 kg)</a>
                    <a href="#">Stor <br>(25+ kg)</a>
                </div>
            </div>
        </div>
        <div class="index-filter-group">
            <label class="index-filter-label">Pris</label>
            <div class="index-dropdown">
                <button onclick="prisFunction()" class="index-dropdown-btn">
                    <span class="index-dropdown-btn-text" id="pris-btn-text">140kr - 270kr</span>
                    <span class="index-dropdown-chevron"></span>
                </button>
                <div id="pris-dorpdown" class="index-dropdown-content index-dropdown-content--slider">
                    <div class="index-price-slider-wrapper" id="pris-slider-wrapper">
                        <div class="index-price-track">
                            <div class="index-price-range" id="pris-range"></div>
                        </div>
                        <div class="index-price-thumb" id="pris-thumb-min" tabindex="0" role="slider" aria-label="Minimipris"></div>
                        <div class="index-price-thumb" id="pris-thumb-max" tabindex="0" role="slider" aria-label="Maximipris"></div>
                    </div>
                    <div class="index-price-labels">
                        <span id="pris-min-display">140kr</span>
                        <span id="pris-max-display">270kr</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="index-filter-group">
            <label class="index-filter-label">Datum</label>
            <input type="date" class="index-filter-date" id="datum-input">
        </div>
        <div class="index-filter-actions">
            <button class="index-filter-btn-apply">Filtrera</button>
            <button onclick="clearFilters()" class="index-filter-btn-clear">Rensa</button>
        </div>
    </div>
    <div class="index-container">
        <!--Card-->
        <div class="index-card">
            <div class="index-card-image-placeholder">Ingen Bild</div>
            <div class="index-text">
                <h2>Lasse</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p>
            </div>
            <div class="index-button-container">
                <a class="index-button" href="/read-more">Läs mer→</a>
            </div>
        </div>
        <!--Card-->
        <div class="index-card">
            <div class="index-card-image-placeholder">Ingen Bild</div>
            <div class="index-text">
                <h2>Lasse</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p>
            </div>
            <div class="index-button-container">
                <a class="index-button" href="/read-more">Läs mer→</a>
            </div>
        </div>
        <!--Card-->
        <div class="index-card">
            <div class="index-card-image-placeholder">Ingen Bild</div>
            <div class="index-text">
                <h2>Lasse</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p>
            </div>
            <div class="index-button-container">
                <a class="index-button" href="/read-more">Läs mer→</a>
            </div>
        </div>
        <!--Card-->
        <div class="index-card">
            <div class="index-card-image-placeholder">Ingen Bild</div>
            <div class="index-text">
                <h2>Lasse</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p>
            </div>
            <div class="index-button-container">
                <a class="index-button" href="/read-more">Läs mer→</a>
            </div>
        </div>
        <!--Card-->
        <div class="index-card">
            <div class="index-card-image-placeholder">Ingen Bild</div>
            <div class="index-text">
                <h2>Lasse</h2>
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p>
            </div>
            <div class="index-button-container">
                <a class="index-button" href="/read-more">Läs mer→</a>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>