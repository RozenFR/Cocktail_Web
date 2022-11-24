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
    <span title="Login/Register">
            <a href="/login.php" class="Links" name="Link">Connexion</a>
            <a href="/register.php" class="Links" name="Link">S'inscrire</a>
    </span>
    <div id="Open_Profile" onclick="openProfile();" title="Avatar">
        <svg viewBox="0 0 24 24" fill="none">
            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m8-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
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