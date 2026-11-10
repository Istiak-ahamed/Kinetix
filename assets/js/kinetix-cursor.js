// Kinetix custom follower cursor.

document.addEventListener('DOMContentLoaded', () => {
    if (!window.matchMedia('(pointer: fine)').matches) return;

    const dot = document.createElement('div');
    dot.className = 'kinetix-cursor-dot';
    document.body.appendChild(dot);

    const style = document.createElement('style');
    style.innerHTML = `
        .kinetix-cursor-dot {
            position: fixed;
            top: 0;
            left: 0;
            width: 8px;
            height: 8px;
            background: #ff2a2a;
            border-radius: 50%;
            pointer-events: none;
            z-index: 999999;
            transform: translate(-50%, -50%);
            box-shadow: 0 0 12px rgba(255, 42, 42, 0.8);
            transition: opacity 0.2s ease;
        }
    `;
    document.head.appendChild(style);

    window.addEventListener('mousemove', (e) => {
        dot.style.transform = `translate3d(${e.clientX}px, ${e.clientY}px, 0) translate(-50%, -50%)`;
    });
});