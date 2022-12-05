function openProfile() {
    document.getElementById("Profile_Box").style.display = "block";
    document.getElementById("Open_Profile").style.display = "none";
    document.getElementById("Close_Profile").style.display = "block";
}

function closeProfile() {
    document.getElementById("Profile_Box").style.display = "none";
    document.getElementById("Open_Profile").style.display = "block";
    document.getElementById("Close_Profile").style.display = "none";
    document.getElementById("Theme_Box").style.display = "none";
}

function active() {
    var url = document.location.href;
    var urlArray = url.split('/');
    var uri = urlArray[urlArray.length - 1];
    uri = uri.split('?')[0];

    switch (uri) {
        case '':
            document.getElementsByName('Link')[0].id = 'active';
            break;
        case 'index.php':
            document.getElementsByName('Link')[0].id = 'active';
            break;
        case 'favourites.php':
            document.getElementsByName('Link')[1].id = 'active';
            break;
        case 'login.php':
            document.getElementsByName('Link')[2].id = 'active';
            break;
        case 'register.php':
            document.getElementsByName('Link')[3].id = 'active';
            break;
        case 'search.php':
            console.log(document.querySelector('[title="Search"]'));
            document.querySelector('[title="Search"]').id = 'active';
            break;
    }
}