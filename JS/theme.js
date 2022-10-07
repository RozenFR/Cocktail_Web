const themeMap = {
    dark: "light",
    light: "dark"
};
  
const theme = localStorage.getItem('theme') || (temp = Object.keys(themeMap)[0], localStorage.setItem('theme', temp), temp);

const bodyClass = document.body.classList;
bodyClass.add(theme);
  
function toggleTheme() {
    const current = localStorage.getItem('theme');
    const next = themeMap[current];
  
    bodyClass.replace(current, next);
    localStorage.setItem('theme', next);
}
  
document.getElementById('theme-button').onclick = toggleTheme; 

function openTheme() {
    document.getElementById('Theme_Box').style.display = "block";
}

function closeTheme() {
    document.getElementById('Theme_Box').style.display = "none";
}