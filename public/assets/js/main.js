
// function to set a given theme/color-scheme
function setTheme(themeName) {
    localStorage.setItem('xton_theme', themeName);
    document.documentElement.className = themeName;
}
// // function to toggle between light and dark theme
// function toggleTheme() {
//     if (localStorage.getItem('xton_theme') === 'theme-dark') {
//         setTheme('theme-light');
//     } else {
//         setTheme('theme-dark');
//     }
// }
// // Immediately invoked function to set the theme on initial load
// document.addEventListener("DOMContentLoaded", function() {
//     (function () {
//         var slider = document.getElementById('slider');
//         if (localStorage.getItem('xton_theme') === 'theme-dark') {
//             setTheme('theme-dark');
//             if (slider) {
//                 slider.checked = false;
//             }
//         } else {
//             setTheme('theme-light');
//             if (slider) {
//                 slider.checked = true;
//             }
//         }
//     })();
// });

