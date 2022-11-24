const dislike = Array.from(document.getElementsByClassName('dislike'));
const like = Array.from(document.getElementsByClassName('like'));

var liked = [];

like.forEach((button, index) => {
    button.addEventListener("click", () => {
        var id = button.parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data;
        if(!liked.includes(id)) {
            liked.push(id);
        }
        console.log(liked);
        dislike[index].style.display = "block";
        like[index].style.display = "none";
    });
});

dislike.forEach((button, index) => {
    button.addEventListener("click", () => {
        var id = button.parentNode.parentNode.childNodes[1].childNodes[1].childNodes[0].data;
        if(liked.includes(id)) {
            liked.splice(liked.indexOf(id), 1);
        }
        console.log(liked);
        like[index].style.display = "block";
        dislike[index].style.display = "none";
    });
});