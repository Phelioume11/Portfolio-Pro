console.log("bulle nav chargée");

const bulle = document.querySelector('.bulle-nav');

let lastScrollY = window.scrollY;
let velocity = 0;
let currentOffset = 0;
let targetOffset = 0;

function animate() {
    // interpolation douce
    currentOffset += (targetOffset - currentOffset) * 0.1;

    bulle.style.transform = `
        translateX(-50%)
        translateY(${currentOffset}px)
    `;

    // retour progressif à la position initiale
    targetOffset *= 0.85;

    requestAnimationFrame(animate);
}

window.addEventListener('scroll', () => {
    const currentScrollY = window.scrollY;
    velocity = currentScrollY - lastScrollY;

    // sens inversé + mouvement subtil
    targetOffset = Math.max(Math.min(velocity * -0.4, 10), -10);

    lastScrollY = currentScrollY;
});

animate();








const sections = document.querySelectorAll("section");
const navLinks = document.querySelectorAll(".bulle-link");

function onScroll() {
    let currentSection = "";

    sections.forEach(section => {
        const sectionTop = section.offsetTop;
        const sectionHeight = section.offsetHeight;

        if (scrollY >= sectionTop - sectionHeight / 3) {
            currentSection = section.getAttribute("id");
        }
    });

    navLinks.forEach(link => {
        link.classList.remove("active");
        if (link.dataset.section === currentSection) {
            link.classList.add("active");
        }
    });
}

window.addEventListener("scroll", onScroll);
