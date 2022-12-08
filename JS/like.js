const dislike = Array.from(document.getElementsByClassName('dislike'));
const like = Array.from(document.getElementsByClassName('like'));

// ? Function getCookie takes in the name of the cookie, loops over all cookies split them by the delimiter ';' and returns the part after ${name}=
function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

// ? If the cookie tempLikes exist, set the array liked to it, otherwise set it to the empty array
var temp = getCookie('tempLikes');
if(typeof temp !== "undefined") {
    var liked = JSON.parse(temp);
}
else {
    var liked = [];
}


// ? For each element in like, add an onclick event, when event is triggered, add the index of the element to liked (if not already present) then changes style accordingly, sort the array numerically and set the cookie tempLikes
like.forEach((button, index) => {
    button.addEventListener("click", () => {
        var id = Number (button.parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data);
        if(!liked.includes(id)) {
            liked.push(id);
            liked.sort(function(a, b) { return a - b; });
        }
        dislike[index].style.display = "block";
        like[index].style.display = "none";
        
        document.cookie = "tempLikes=" + JSON.stringify(liked);
    });
});

// ? For each element in like, add an onclick event, when event is triggered, add the index of the element to liked (if not already present) then changes style accordingly, sort the array numerically
dislike.forEach((button, index) => {
    button.addEventListener("click", () => {
        var id = Number (button.parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data);
        if(liked.includes(id)) {
            liked.splice(liked.indexOf(id), 1);
            liked.sort(function(a, b) { return a - b; });
        }
        like[index].style.display = "block";
        dislike[index].style.display = "none";

        document.cookie = "tempLikes=" + JSON.stringify(liked);
    });
});

// ? Get the string in the cookie tempLikes, if this string isn't undefined, if not convert it to an array by splitting with the delimiter ',' then check which page we're on
// ? - if we're on index, loop over each element in the like array and check if it's index is the same as in the Recettes array and apply the style
// ? - if we're on favourites, loop over all elements in the array like and apply the style.
function loadLikes() {
    var cookie_str = JSON.parse(getCookie("tempLikes"));
    if(typeof cookie_str !== "undefined") {
        var url = document.location.href;
        var urlArray = url.split('/');
        var uri = urlArray[urlArray.length - 1];
        uri = uri.split('?')[0];

        console.log(cookie_str);
        if(uri == "index.php") {
            loadIndex(cookie_str);
        } else if(uri == "favourites.php") {
            loadFavourites(cookie_str);
        } else if(uri == "search.php") {
            loadSearch(cookie_str);
        }
    }
}

function loadIndex(likes) {
    console.log(like);
    likes.forEach(element => {
        dislike[element].style.display = "block";
        like[element].style.display = "none";
    });
}

function loadFavourites(likes) {
    for($i = 0; $i < likes.length; $i++) {
        dislike[$i].style.display = "block";
        like[$i].style.display = "none";
    }
}

function loadSearch(likes) {
    for($z = 0; $z < dislike.length; $z++) {
        var id = Number (dislike[$z].parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data);
        if(likes.includes(id)) {
            console.log(true);
            dislike[$z].style.display = "block";
            like[$z].style.display = "none";
        }
    }
}

loadLikes();