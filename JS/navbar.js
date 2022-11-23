function Open_Nav() {
    document.getElementById("Nav").style.marginLeft = "0px";
}

function Close_Nav() {
    document.getElementById("Nav").style.marginLeft = "-320px";
}

function dropdown() {
    document.getElementById("dropdown").classList.toggle("show");
    var drop = document.getElementById('drop');
    if (drop.style.transform == "") {
        drop.style.transform = "rotate(180deg)";
    }
    else {
        drop.style.transform = "";
    }
}

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
    urlArray = url.split('/');
    var href = urlArray[urlArray.length - 1];

    switch (href) {
        case '':
            document.getElementsByName('Link')[0].id = 'active';
            break;
        case 'index.php':
            console.log(document.getElementsByName('Link'));
            document.getElementsByName('Link')[0].id = 'active';
            break;
        case 'favourites.php':
            document.getElementsByName('Link')[1].id = 'active';
            break;
    }
}