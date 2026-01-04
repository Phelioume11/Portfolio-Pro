console.log("bulle nav chargée");

if (document.querySelector(".error-404")) {
    const bulle = document.querySelector(".bulle-nav");
    if (bulle) bulle.style.display = "none";
}


/* ===============================
   BULLE NAV — EFFET INERTIEL
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
    const scrollY = window.scrollY;
    const velocity = scrollY - lastScrollY;

    targetOffset = Math.max(Math.min(-velocity * 0.4, 10), -10);
    lastScrollY = scrollY;
});

animateBulle();

/* ===============================
   SECTION ACTIVE
================================ */

const sections = document.querySelectorAll("section");
const links = document.querySelectorAll(".bulle-link");

function updateActiveLink() {
    let current = "";

    sections.forEach(section => {
        const offset = section.offsetTop;
        const height = section.offsetHeight;

        if (window.scrollY >= offset - height / 3) {
            current = section.id;
        }
    });

    links.forEach(link => {
        link.classList.toggle(
            "active",
            link.dataset.section === current
        );
    });
}

window.addEventListener("scroll", updateActiveLink);
updateActiveLink();

/* ===============================
   CLICK → SCROLL FLUIDE
================================ */

links.forEach(link => {
    link.addEventListener("click", e => {
        const targetId = link.dataset.section;
        if (!targetId) return;

        e.preventDefault();

        const target = document.getElementById(targetId);
        if (!target) return;

        target.scrollIntoView({
            behavior: "smooth",
            block: "start"
        });
    });
});

/* ===============================
   MASQUER LA BULLE AU FOOTER
================================ */

const footer = document.getElementById("footer");

function toggleBulleOnFooter() {
    const footerTop = footer.getBoundingClientRect().top;
    const windowHeight = window.innerHeight;

    if (footerTop < windowHeight - 80) {
        bulle.classList.add("hidden");
    } else {
        bulle.classList.remove("hidden");
    }
}

window.addEventListener("scroll", toggleBulleOnFooter);
toggleBulleOnFooter();
