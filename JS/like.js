const dislike = Array.from(document.getElementsByClassName('dislike'));
const like = Array.from(document.getElementsByClassName('like'));

function getCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}

var temp = getCookie('tempLikes');

if(typeof temp !== "undefined") {
    var liked = temp.split(',');
}
else {
    var liked = [];
}

like.forEach((button, index) => {
    button.addEventListener("click", () => {
        var id = button.parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data;
        if(!liked.includes(id)) {
            liked.push(id);
        }
        dislike[index].style.display = "block";
        like[index].style.display = "none";

        liked.sort(function(a, b) {
            return a - b;
        });
        document.cookie = "tempLikes=" + liked;
    });
});

dislike.forEach((button, index) => {
    button.addEventListener("click", () => {
        var id = button.parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data;
        if(liked.includes(id)) {
            liked.splice(liked.indexOf(id), 1);
            liked.sort();
        }
        like[index].style.display = "block";
        dislike[index].style.display = "none";
    });
});

function loadLikes() {
    

    var cookie_str = getCookie("tempLikes");
    if(typeof cookie_str !== "undefined") {
        var url = document.location.href;
        var urlArray = url.split('/');
        var uri = urlArray[urlArray.length - 1];
        uri = uri.split('?')[0];
        console.log(cookie_str);
        var likes = cookie_str.split(',');
        console.log(likes);
        if(uri== "index.php") {
            likes.forEach(element => {
                dislike[element].style.display = "block";
                like[element].style.display = "none";
            });
        } else if(uri == "favourites.php") {
            for($i = 0; $i < likes.length; $i++) {
                dislike[$i].style.display = "block";
                like[$i].style.display = "none";
            }
        } 
    }
}

loadLikes();