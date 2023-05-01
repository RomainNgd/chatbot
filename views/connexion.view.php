<?php
 include '../include/header.php';
 include '../include/inc.php';
?>

<navbar>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48.22 48" class="logo"><defs><style>.cls-1{fill:#fff;}.cls-2,.cls-3,.cls-4{stroke:#fff;stroke-miterlimit:10;}.cls-3{fill:none;}.cls-4{fill:#ffbf85;stroke-width:2px;}</style></defs><g id="fond_icone"><path class="cls-2" d="M33.65,3.72H14.88C7.11,3.72,.81,10.02,.81,17.8v4.21c0,4.82,2.43,9.08,6.13,11.61v7.38l7.73-4.93c.07,0,.15,.01,.22,.01h18.77c7.77,0,14.07-6.3,14.07-14.07v-4.21c0-7.77-6.3-14.07-14.07-14.07Z"/><ellipse class="cls-2" cx="24" cy="42.47" rx="4.19" ry="1.91"/></g><g id="Calque_2"><rect class="cls-3" x="4.88" y="12.15" width="38.17" height="16.98" rx="8.49" ry="8.49"/><g><g><circle class="cls-4" cx="12.76" cy="19.36" r="3.32"/><circle class="cls-4" cx="35.17" cy="19.36" r="3.32"/></g><path class="cls-1" d="M19.02,24.34c3.62,1.81,6.48,2.04,9.89,0-1.93,4.07-7.81,3.77-9.89,0h0Z"/></g></g></svg>
    <h1>Billy</h1>
</navbar>

<form action="" method="POST" id="form-login">
    <div id="login">
        <label for="login">Login</label>
        <input type="text" name="login">
    </div>

    <div id="password">
        <label for="password">Mot de passe</label>
        <input type="password">
    </div>

    <button type="submit" class="btn btn-validation">Connexion</button>
</form>