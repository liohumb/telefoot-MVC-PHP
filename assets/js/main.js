/* MODAL NAVBAR */
const modal = document.querySelector('.nav__modal')
const button = document.querySelector('.nav__burger i')
function toggleModal() {
    modal.classList.toggle('nav__modal-active')
    if (button.classList.contains('bx-menu')) {
        button.classList.remove('bx-menu')
        button.classList.add('bx-x')
    } else {
        button.classList.add('bx-menu')
        button.classList.remove('bx-x')
    }
}
window.addEventListener('click', () => {
    toggleModal()
})
window.addEventListener('scroll', () => {
    modal.classList.remove('nav__modal-active')
    button.classList.add('bx-menu')
    button.classList.remove('bx-x')
})

/* ACTIVE LINK */
const section = document.querySelectorAll('section')
const navLinks = document.querySelectorAll('.nav__menu-link')
const navMobileLinks = document.querySelectorAll('.nav__modal ul li a')

window.onscroll = () => {
    section.forEach(sec => {
        let top = window.scrollY
        let offset = sec.offsetTop - 150
        let height = sec.offsetHeight
        let id = sec.getAttribute('id')
        if (top >= offset && top < offset + height) {
            navLinks.forEach(links => {
                links.classList.remove('nav__menu-active')
                document.querySelector('.nav__menu-link[href*='+id+']').classList.add('nav__menu-active')
            })
            navMobileLinks.forEach(links => {
                links.classList.remove('nav__menu-active')
                document.querySelector('.nav__modal ul li a[href*='+id+']').classList.add('nav__menu-active')
            })
        }
    })
}