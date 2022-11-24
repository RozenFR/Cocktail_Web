var theme = localStorage.getItem('theme') || (temp = 'slate', localStorage.setItem('theme', temp), temp);
var accent = localStorage.getItem('accent') || (temp = 'orange-soda', localStorage.setItem('accent', temp), temp);
var accent_gradient = `${accent}` + "-gradient";
var bodyClass = document.body.classList;

async function onAccentSwitch() {
    const inputs = document.querySelectorAll("input[name='theme']")
    const root = document.querySelector(":root")
    root.style.setProperty("--accent", `var(--${accent})`);
    root.style.setProperty("--accent-gradient", `var(--${accent_gradient})`);
    for (const input of inputs) {
        if (input.value == accent) {
            input.setAttribute("checked", "true");
        }
        input.onchange = e => {
            var value = e.target.value;
            root.style.setProperty("--accent", `var(--${value})`);
            root.style.setProperty("--accent-gradient", `var(--${value}-gradient)`);
            localStorage.setItem('accent', `${value}`);
        }
    }
}

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