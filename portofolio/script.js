window.addEventListener('DOMContentLoaded', () => {
    const skills = document.querySelectorAll('.skill');

    skills.forEach(skill => {
        const level = skill.querySelector('.skill-level');
        const percent = skill.querySelector('.skill-percent');
        const target = parseInt(percent.getAttribute('data-percent'));

        // Animasi skill bar
        setTimeout(() => {
            level.style.width = target + '%';
        }, 100); // delay kecil supaya transisi berjalan

        // Animasi persentase
        let current = 0;
        const increment = target / 100; // 100 step
        const interval = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(interval);
            }
            percent.textContent = Math.round(current) + '%';
        }, 20);
    });
});

// Ambil semua link di navbar
const navLinks = document.querySelectorAll('nav ul li a');

navLinks.forEach(link => {
  link.addEventListener('click', function(e) {
    e.preventDefault(); // cegah default klik
    const targetID = this.getAttribute('href').slice(1); // ambil ID section
    const targetSection = document.getElementById(targetID);

    // Scroll smooth ke section
    targetSection.scrollIntoView({ behavior: 'smooth' });

    // Jalankan animasi setelah scroll selesai
    setTimeout(() => {
      // Cari elemen di section yang punya animasi
      targetSection.querySelectorAll('.fadeUp, .fadeLeft, .fadeRight').forEach(el => {
        el.style.opacity = 1;
        el.style.transform = 'translateX(0) translateY(0)';
      });
    }, 400); // delay supaya scroll dulu
  });
});
