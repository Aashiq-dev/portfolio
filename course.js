// script.js
document.addEventListener('DOMContentLoaded', function () {
    const prevButton = document.querySelector('.carousel-control-prev');
    const nextButton = document.querySelector('.carousel-control-next');
    const items = document.querySelectorAll('.carousel-item');
    let currentIndex = 0;

    function showItem(index) {
        items[currentIndex].classList.remove('active');
        currentIndex = (index + items.length) % items.length;
        items[currentIndex].classList.add('active');
    }

    prevButton.addEventListener('click', function () {
        showItem(currentIndex - 1);
    });

    nextButton.addEventListener('click', function () {
        showItem(currentIndex + 1);
    });

    // Initialize the first item as active
    showItem(0);
});