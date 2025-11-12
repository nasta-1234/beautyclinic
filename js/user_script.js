// ===== USER MENU DROPDOWN =====
const userBtn = document.getElementById('user-btn');
const profileBox = document.querySelector('.profile');

if (userBtn && profileBox) {
    userBtn.addEventListener('click', (e) => {
        e.stopPropagation(); // mencegah klik bubble
        profileBox.classList.toggle('active');
    });

    // Klik di luar dropdown akan menutup
    document.addEventListener('click', (e) => {
        if (!profileBox.contains(e.target) && !userBtn.contains(e.target)) {
            profileBox.classList.remove('active');
        }
    });
}

// ===== SEARCH FORM TOGGLE =====
const searchBtn = document.getElementById('search-btn');
const searchForm = document.querySelector('.search-from');

if (searchBtn && searchForm) {
    searchBtn.addEventListener('click', () => {
        searchForm.classList.toggle('active');
    });

    // Klik di luar search form akan menutup
    document.addEventListener('click', (e) => {
        if (!searchForm.contains(e.target) && !searchBtn.contains(e.target)) {
            searchForm.classList.remove('active');
        }
    });
}

// ===== MOBILE MENU TOGGLE =====
const menuBtn = document.getElementById('menu-btn');
const navbar = document.querySelector('.navbar');

if (menuBtn && navbar) {
    menuBtn.addEventListener('click', () => {
        navbar.classList.toggle('active');
    });

    // Klik di luar navbar akan menutup (opsional)
    document.addEventListener('click', (e) => {
        if (!navbar.contains(e.target) && !menuBtn.contains(e.target)) {
            navbar.classList.remove('active');
        }
    });
}

//slide section

"use strict"
const leftArrow= document.querySelector('.left-arrow .bxs-left-arrow');
const rightArrow= document.querySelector('.right-arrow .bxs-right-arrow');
const slider= document.querySelector('.slider');

//scroll to right

function scrollRight(){
    if (slider.scrollWidth - slider.clientWidth === slider.scrollLeft){
        slider.scrollTo({
            left: 0,
            behavior: "smooth"
        })
    }else{
        slider.scrollBy({
            left: window.innerWidth,
            behavior: "smooth"
        })
    }
}

//scroll to left
function scrollLeft(){
    slider.scrollBy({
        left: -window.innerWidth,
        behavior: "smooth"
    })
}

//auto slider
let timeId = setInterval(scrollRight, 7000);
//reset timer
function resetTimer(){
    clearInterval(TimeId);
    timeId = setInterval(scrollRight, 7000);
}

//scroll events
slider.addEventListener('click', function(ev){
    if (ev.target === leftArrow){
        scrollLeft();
        resetTimer();
    }
})

slider.addEventListener('click', function(ev){
    if (ev.target === RightArrow){
        scrollRight();
        resetTimer();
    }
})

//accordian section

  const labels = document.querySelectorAll('.label');
        labels.forEach(label => {
            label.addEventListener('click', () => {
                const contentBox = label.parentElement;
                contentBox.classList.toggle('active');
            });
        });
  