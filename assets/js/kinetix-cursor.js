document.addEventListener('DOMContentLoaded', () => {
    if (!window.matchMedia('(pointer: fine)').matches) {
        return;
    }

    document.querySelectorAll('[class^="kinetix-cursor-"], [class*=" kinetix-cursor-"], .kinetix-magnetic-cursor').forEach((element) => {
        element.remove();
    });

    if (document.body.classList.contains('kinetix-cursor-style-none')) {
        return;
    }

    const cursor = document.createElement('div');
    cursor.className = 'kinetix-magnetic-cursor';
    document.body.appendChild(cursor);
    document.documentElement.classList.add('kinetix-custom-cursor-ready');
    document.body.classList.add('kinetix-custom-cursor-ready');

    let mouseX = -100;
    let mouseY = -100;
    let cursorX = -100;
    let cursorY = -100;
    let targetX = mouseX;
    let targetY = mouseY;
    let targetWidth = 16;
    let targetHeight = 16;
    let activeElement = null;

    window.addEventListener('mousemove', (event) => {
        mouseX = event.clientX;
        mouseY = event.clientY;
        cursor.style.opacity = '1';
    }, { passive: true });

    const magneticSelector = 'a, button, input, .btn, .kinetix-nav-link, .kinetix-card, .btn-kinetix-crimson, [role="button"]';

    document.addEventListener('mouseover', (event) => {
        const target = event.target instanceof Element ? event.target.closest(magneticSelector) : null;
        if (target) {
            activeElement = target;
            cursor.classList.add('is-snapped');
        }
    });

    document.addEventListener('mouseout', (event) => {
        const target = event.target instanceof Element ? event.target.closest(magneticSelector) : null;
        if (target && (!event.relatedTarget || !target.contains(event.relatedTarget))) {
            activeElement = null;
            cursor.classList.remove('is-snapped');
        }
    });

    document.querySelectorAll('.card-style-spotlight').forEach((card) => {
        card.addEventListener('mousemove', (event) => {
            const rect = card.getBoundingClientRect();
            card.style.setProperty('--mouse-x', `${event.clientX - rect.left}px`);
            card.style.setProperty('--mouse-y', `${event.clientY - rect.top}px`);
        });
    });

    function animate() {
        if (activeElement) {
            const rect = activeElement.getBoundingClientRect();
            targetWidth = rect.width + 12;
            targetHeight = rect.height + 12;
            targetX = rect.left + rect.width / 2;
            targetY = rect.top + rect.height / 2;
            cursor.style.borderRadius = window.getComputedStyle(activeElement).borderRadius || '9999px';
        } else {
            targetWidth = 16;
            targetHeight = 16;
            targetX = mouseX;
            targetY = mouseY;
            cursor.style.borderRadius = '9999px';
        }

        cursorX += (targetX - cursorX) * 0.22;
        cursorY += (targetY - cursorY) * 0.22;
        cursor.style.width = `${targetWidth}px`;
        cursor.style.height = `${targetHeight}px`;
        cursor.style.transform = `translate3d(${cursorX - targetWidth / 2}px, ${cursorY - targetHeight / 2}px, 0)`;
        window.requestAnimationFrame(animate);
    }

    document.addEventListener('mouseleave', () => {
        cursor.style.opacity = '0';
    });
    document.addEventListener('mouseenter', () => {
        cursor.style.opacity = '1';
    });

    window.requestAnimationFrame(animate);
});
