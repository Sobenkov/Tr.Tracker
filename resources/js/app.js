

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {

    const timers = document.querySelectorAll('.timer');

    timers.forEach(timer => {

        const startedAt = Number(timer.dataset.start);

        function updateTimer() {

            const elapsed = Math.floor(Date.now() / 1000) - startedAt;

            const hours = Math.floor(elapsed / 3600);
            const minutes = Math.floor((elapsed % 3600) / 60);
            const seconds = elapsed % 60;

            timer.textContent =
                `${String(hours).padStart(2, '0')}:` +
                `${String(minutes).padStart(2, '0')}:` +
                `${String(seconds).padStart(2, '0')}`;

        }

        updateTimer();

        setInterval(updateTimer, 1000);

    });

});
