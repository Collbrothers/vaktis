<?php require_once '../includes/header.php'; ?>
<main>
    <div class="index-filter-container">
        <div class="index-dropdown">
            <button onclick="kommunFunction()" class="index-dropdown-btn">Kommun</button>
            <div id="kommun-dorpdown" class="index-dropdown-content">
                <input type="text" placeholder="Sök..." oninput="filterFunction()">
                <a href="#">Karlsborg</a>
                <a href="#">Hjo</a>
                <a href="#">Mariestad</a>
                <a href="#">Tibro</a>
                <a href="#">Götborg</a>
                <a href="#">Skövde</a>
            </div>
        </div>
        <div class="index-dropdown">
            <button onclick="animalFunction()" class="index-dropdown-btn">Djur</button>
            <div id="animal-dorpdown" class="index-dropdown-content">
                <input type="text" placeholder="Sök..." oninput="filterFunctionAnimal()">
                <a href="#">Cat</a>
                <a href="#">Dog</a>
                <a href="#">Elephant</a>
                <a href="#">Tiger</a>
                <a href="#">Penguin</a>
                <a href="#">Giraffe</a>
            </div>
        </div>
    </div>
    <div class="index-container">
        <!--Card-->
        <div class="index-card">
            <!--<img class="index-card-image"
                src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                alt="Bild över husdjuret">-->
            <div class="index-card-image-placeholder">Ingen Bild</div> <!--När det inte finns någon bild-->

            <div class="index-text">
                <h2>Lasse</h2> <!--Namn på djur-->
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p> <!--Kort sammanfattning av beskrivningen-->
            </div>

            <div class="index-button-container"> <!---->
                <a class="index-button" href="">Läs mer→</a>
            </div>
        </div>

        <!--Card-->
        <div class="index-card">
            <!--<img class="index-card-image"
                src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                alt="Bild över husdjuret">-->
            <div class="index-card-image-placeholder">Ingen Bild</div> <!--När det inte finns någon bild-->

            <div class="index-text">
                <h2>Lasse</h2> <!--Namn på djur-->
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p> <!--Kort sammanfattning av beskrivningen-->
            </div>

            <div class="index-button-container"> <!---->
                <a class="index-button" href="">Läs mer→</a>
            </div>
        </div>

        <!--Card-->
        <div class="index-card">
            <!--<img class="index-card-image"
                src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                alt="Bild över husdjuret">-->
            <div class="index-card-image-placeholder">Ingen Bild</div> <!--När det inte finns någon bild-->

            <div class="index-text">
                <h2>Lasse</h2> <!--Namn på djur-->
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p> <!--Kort sammanfattning av beskrivningen-->
            </div>

            <div class="index-button-container"> <!---->
                <a class="index-button" href="">Läs mer→</a>
            </div>
        </div>

        <!--Card-->
        <div class="index-card">
            <!--<img class="index-card-image"
                src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                alt="Bild över husdjuret">-->
            <div class="index-card-image-placeholder">Ingen Bild</div> <!--När det inte finns någon bild-->

            <div class="index-text">
                <h2>Lasse</h2> <!--Namn på djur-->
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p> <!--Kort sammanfattning av beskrivningen-->
            </div>

            <div class="index-button-container"> <!---->
                <a class="index-button" href="">Läs mer→</a>
            </div>
        </div>

        <!--Card-->
        <div class="index-card">
            <!--<img class="index-card-image"
                src="https://www.borrowmydoggy.com/_next/image?url=https%3A%2F%2Fcdn.sanity.io%2Fimages%2F4ij0poqn%2Fproduction%2Fe24bfbd855cda99e303975f2bd2a1bf43079b320-800x600.jpg&w=1080&q=80"
                alt="Bild över husdjuret">-->
            <div class="index-card-image-placeholder">Ingen Bild</div> <!--När det inte finns någon bild-->

            <div class="index-text">
                <h2>Lasse</h2> <!--Namn på djur-->
                <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quia ipsa ad optio, natus ex debitis sed id
                    minus? Velit saepe quasi aperiam quo accusamus quis, laborum quidem nostrum voluptates magnam.</p> <!--Kort sammanfattning av beskrivningen-->
            </div>

            <div class="index-button-container"> <!---->
                <a class="index-button" href="">Läs mer→</a>
            </div>
        </div>
    </div>
</main>

<?php require_once '../includes/footer.php'; ?>