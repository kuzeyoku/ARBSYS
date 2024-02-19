let navbar = document.querySelector('.header .navbar');

document.querySelector('#menu-btn').onclick = () => {
    navbar.classList.toggle('active');
}

window.oncroll = () => {
    navbar.classList.remove('active');
}



$(document).ready(function () {
    $('#step-2').hide();
    $('#step-3').hide();
    $('#step-4').hide();
})

function step1() {
    $('#step-1').show();
    $('#step-2').hide();
    $('#step-3').hide();
    $('#step-4').hide();
}

function step2() {
    $('#step-1').hide();
    $('#step-2').show();
    $('#step-3').hide();
    $('#step-4').hide();
}

function step3() {
    $('#step-1').hide();
    $('#step-2').hide();
    $('#step-3').show();
    $('#step-4').hide();
}

function step4() {
    $('#step-1').hide();
    $('#step-2').hide();
    $('#step-3').hide();
    $('#step-4').show();
}

AOS.init({
    duration: 800,
    offset: 150,
});

// Wrap every letter in a span
var textWrapper = document.querySelector('.letters');
textWrapper.innerHTML = textWrapper.textContent.replace(/\S/g, "<span class='letter'>$&</span>");

anime.timeline({ loop: true })
    .add({
        targets: '.letter',
        translateY: ["1.1em", 0],
        translateZ: 0,
        duration: 750,
        delay: (el, i) => 50 * i
    }).add({
        targets: '.letter',
        opacity: 0,
        duration: 1000,
        easing: "easeOutExpo",
        delay: 1000
    });