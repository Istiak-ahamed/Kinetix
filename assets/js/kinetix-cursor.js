document.addEventListener('DOMContentLoaded', () => {
    const cards = document.querySelectorAll('.aceternity-spotlight-card');
    cards.forEach((card) => {
        card.addEventListener('mousemove', (event) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${event.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${event.clientY - rect.top}px`);
        });
    });

    if (!window.matchMedia('(pointer: fine)').matches) {
        return;
    }

    const cursorStyle = document.body.className.match(/kinetix-cursor-style-([a-z-]+)/);
    if (cursorStyle && cursorStyle[1] === 'none') {
        return;
    }

    const dot = document.createElement('div');
    dot.className = 'kinetix-cursor-dot';
    document.body.appendChild(dot);

    const ring = document.createElement('div');
    ring.className = 'kinetix-cursor-ring';
    document.body.appendChild(ring);

    window.addEventListener('mousemove', (e) => {
        dot.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0) translate(-50%, -50%)`;
        ring.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0) translate(-50%, -50%)`;
    });

    document.querySelectorAll('a, button, input, textarea, select').forEach((element) => {
        element.addEventListener('mouseenter', () => ring.classList.add('is-hovering'));
        element.addEventListener('mouseleave', () => ring.classList.remove('is-hovering'));
    });
});