/*========== dark light mode ==========*/
let darkModeIcon = document.querySelector('#darkMode-icon');
// let sql = document.querySelector('.sql');

darkModeIcon.onclick = () => {
  darkModeIcon.classList.toggle('bx-sun');
  document.body.classList.toggle('dark-mode');
  // sql.classList.toggle('sql-dark');
};

const sections = document.querySelectorAll('section[id]')

function scrollActive() {
  const scrollY = window.scrollY;

  sections.forEach(current => {
    const sectionHeight = current.offsetHeight,
      sectionTop = current.offsetTop - 50,
      sectionId = current.getAttribute('id')

    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {

      document.querySelector('.navbar a[href*=' + sectionId + ']').classList.add('active')

    } else {

      document.querySelector('.navbar a[href*=' + sectionId + ']').classList.remove('active')

    }
  })
}

window.addEventListener('scroll', scrollActive)

//mobile menu
const hamburgerMenu = document.getElementById('hamburger-menu');
const navbar = document.querySelector('.navbar');

hamburgerMenu.addEventListener('click', () => {
  navbar.classList.toggle('active');
});
