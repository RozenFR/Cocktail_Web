<?php
if (isset($_SESSION['username'])) {
    $connected = true;
} 
else {
    $connected = false;
}
?>
<head>
    <style>
        @import url('/CSS/header.css');
    </style>
    <script src="/JS/navbar.js"></script>
</head>
<header id="Topbar">
    <a href="/index.php" class="Links" name="Link">
        Navigation
    </a>
    <a href="/favourites.php" class="Links" name="Link">
        Favoris
    </a>
    <form action="/search.php" method="GET" id="Search">
        <input placeholder="Rechercher un cocktail, ingrédient, ..." title="Search" name="content"/>
        <svg viewBox="0 0 24 24" title="Lens" fill="none">
            <path
                d="M11 19C15.4183 19 19 15.4183 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M21 20.9999L16.65 16.6499" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </form>
    <?php if (!$connected) { ?>
        <span title="Login/Register">
                <a href="/login.php" class="Links" name="Link">Connexion</a>
                <a href="/register.php" class="Links" name="Link">S'inscrire</a>
        </span>
    <?php } else { ?>
        <span title="Login/Register">
                <a href="/profile.php" class="Links" name="Link">Profil</a>
                <a href="/disconnect.php" class="Links">Déconnecter</a>
        </span>
    <?php } ?>
    <div id="Open_Profile" onclick="openProfile();" title="Avatar">
        <svg viewBox="0 0 24 24" fill="none">
            <path d="M12 15a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a1.998 1.998 0 0 1 0 2.83 1.998 1.998 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-4 0v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a1.998 1.998 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 1 1 0-4h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 1 1 2.83-2.83l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 1 1 4 0v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 3.417 1.415 2 2 0 0 1-.587 1.415l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 0 4h-.09a1.65 1.65 0 0 0-1.51 1v0Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </div>
    <div id="Close_Profile" onclick="closeProfile();" title="Close_Profile">
        <svg viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6L6 18" />
            <path d="M6 6L18 18" />
        </svg>
    </div>
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/HTML/profile_box.html";
        include_once($path);
    ?>
    <?php 
        $path = $_SERVER['DOCUMENT_ROOT'];
        $path .= "/HTML/theme.html";
        include_once($path);
    ?>
</header>