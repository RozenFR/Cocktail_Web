var theme = localStorage.getItem('theme') || (temp = 'slate', localStorage.setItem('theme', temp), temp);
const bodyClass = document.body.classList;

async function onThemeSwitch() {
    bodyClass.add(theme);
    switch (theme) {
        case 'light':
            document.getElementsByName('Light')[0].id = 'active';
            document.getElementsByName('Dark')[0].removeAttribute('id');
            document.getElementsByName('Slate')[0].removeAttribute('id');
            break;
        case 'dark':
            document.getElementsByName('Dark')[0].id = 'active';
            document.getElementsByName('Light')[0].removeAttribute('id');
            document.getElementsByName('Slate')[0].removeAttribute('id');
            break;
        case 'slate':
            document.getElementsByName('Slate')[0].id = 'active';
            document.getElementsByName('Dark')[0].removeAttribute('id');
            document.getElementsByName('Light')[0].removeAttribute('id');
            break;

    }
}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function openTheme() {
    document.getElementById('Theme_Box').style.display = "block";
}

function switchLight() {
    if (theme != 'light') {
        theme = 'light';
        localStorage.setItem('theme', theme);
        bodyClass.remove("dark", "slate");
        bodyClass.add(theme);
        onThemeSwitch();
    }
}

function switchDark() {
    if (theme != 'dark') {
        theme = 'dark';
        localStorage.setItem('theme', theme);
        bodyClass.remove("light", "slate");
        bodyClass.add(theme);
        onThemeSwitch();
    }
}

function switchSlate() {
    if (theme != 'slate') {
        theme = 'slate';
        localStorage.setItem('theme', theme);
        bodyClass.remove("dark", "light");
        bodyClass.add(theme);
        onThemeSwitch();
    }
}

function closeTheme() {
    document.getElementById('Theme_Box').style.display = "none";
}