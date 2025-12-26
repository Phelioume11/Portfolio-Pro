console.log("bulle nav chargée");

/* ===============================
   BULLE – effet inertiel au scroll
================================ */

const bulle = document.querySelector(".bulle-nav");

let lastScrollY = window.scrollY;
let currentOffset = 0;
let targetOffset = 0;

function animateBulle() {
    currentOffset += (targetOffset - currentOffset) * 0.12;

    bulle.style.transform = `
        translateX(-50%)
        translateY(${currentOffset}px)
    `;

    targetOffset *= 0.85;
    requestAnimationFrame(animateBulle);
}

window.addEventListener("scroll", () => {
    const currentScrollY = window.scrollY;
    const velocity = currentScrollY - lastScrollY;

    targetOffset = Math.max(Math.min(-velocity * 0.4, 10), -10);
    lastScrollY = currentScrollY;
});

animateBulle();

/* ===============================
   SECTION ACTIVE (FIABLE)
================================ */

const sections = Array.from(document.querySelectorAll("section"));
const navLinks = Array.from(document.querySelectorAll(".bulle-link"));

function updateActiveSection() {
    let currentSection = "home";
    const scrollPos = window.scrollY + window.innerHeight * 0.35;

    for (let section of sections) {
        if (scrollPos >= section.offsetTop) {
            currentSection = section.id;
        }
    }

    navLinks.forEach(link => {
        link.classList.toggle(
            "active",
            link.dataset.section === currentSection
        );
    });
}

window.addEventListener("scroll", updateActiveSection);
updateActiveSection();

/* ===============================
   CLICK → SCROLL FLUIDE
================================ */

navLinks.forEach(link => {
    link.addEventListener("click", e => {
        const target = link.dataset.section;
        if (!target) return;

        e.preventDefault();

        if (target === "home") {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
            return;
        }

        const section = document.getElementById(target);
        if (!section) return;

        section.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    });
});
