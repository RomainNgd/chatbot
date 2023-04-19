<?php
 include '../include/header.php';
 include '../include/inc.php';
?>

<navbar>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.22 48" class="logo"><defs><style>.cls-1{fill:#fff;}.cls-2,.cls-3,.cls-4{stroke:#fff;stroke-miterlimit:10;}.cls-3{fill:none;}.cls-4{fill:#ffbf85;stroke-width:2px;}</style></defs><g id="fond_icone"><path class="cls-2" d="M33.65,3.72H14.88C7.11,3.72,.81,10.02,.81,17.8v4.21c0,4.82,2.43,9.08,6.13,11.61v7.38l7.73-4.93c.07,0,.15,.01,.22,.01h18.77c7.77,0,14.07-6.3,14.07-14.07v-4.21c0-7.77-6.3-14.07-14.07-14.07Z"/><ellipse class="cls-2" cx="24" cy="42.47" rx="4.19" ry="1.91"/></g><g id="Calque_2"><rect class="cls-3" x="4.88" y="12.15" width="38.17" height="16.98" rx="8.49" ry="8.49"/><g><g><circle class="cls-4" cx="12.76" cy="19.36" r="3.32"/><circle class="cls-4" cx="35.17" cy="19.36" r="3.32"/></g><path class="cls-1" d="M19.02,24.34c3.62,1.81,6.48,2.04,9.89,0-1.93,4.07-7.81,3.77-9.89,0h0Z"/></g></g></svg>
    <h1>Billy</h1>
</navbar>

<main>
    <h2>Couleurs</h2>
    <h3>Sélection d'une palette de couleur:</h3>
    <div class="d-flex">
        <form action="#" method="POST" id="form-palette">
            <div id="select-palette">
                <label for="palette-1" class="palette">
                    <div>
                        <input type="radio" value="1" id="palette-1" name="palette"> Palette 1
                    </div>
                    <div class="block-palette">
                        <div class="dark-maincolor palette-color"></div>
                        <div class="main-color palette-color"></div>
                        <div class="light-color palette-color"></div>
                        <div class="gray-color palette-color"></div>
                    </div>
                </label>
                <label for="palette-2" class="palette">
                    <div>
                        <input type="radio" value="2" id="palette-2" name="palette"> Palette 2
                    </div>
                    <div class="block-palette">
                        <div class="dark-maincolor palette-color"></div>
                        <div class="main-color palette-color"></div>
                        <div class="light-color palette-color"></div>
                        <div class="gray-color palette-color"></div>
                    </div>
                </label>
                <label for="palette-3" class="palette">
                    <div>
                        <input type="radio" value="3" id="palette-3" name="palette"> Palette 3
                    </div>
                    <div class="block-palette">
                        <div class="dark-maincolor palette-color"></div>
                        <div class="main-color palette-color"></div>
                        <div class="light-color palette-color"></div>
                        <div class="gray-color palette-color"></div>
                    </div>
                </label>
                <label for="palette-4" class="palette">
                    <div>
                        <input type="radio" value="4" id="palette-4" name="palette"> Palette 4
                    </div>
                    <div class="block-palette">
                        <div class="dark-maincolor palette-color"></div>
                        <div class="main-color palette-color"></div>
                        <div class="light-color palette-color"></div>
                        <div class="gray-color palette-color"></div>
                    </div>
                </label>
            </div>

            <button class="btn btn-validation">Modifier</button>
        </form>
        <div id="preview-chatbot">
            <div id="preview-head-chatbot" class="d-flex align-item-center">
                <div class="d-flex align-item-center">
                    <div class="round"></div>
                    <label>Billy</label>
                </div>
            </div>
            <div class="d-flex preview-content-chatbot">
                <div class="round"></div>
                <div id="preview-bot" class="preview-content"></div>
            </div>
            <div class="d-flex preview-content-chatbot">
                <div id="preview-user" class="preview-content"></div>
                <div class="round"></div>
            </div>
        </div>
    </div>
    <h2>Mots-clés:</h2>
</main>