document.addEventListener('DOMContentLoaded', () => {
    const avatarLabels = document.querySelectorAll('.avatar-label');

    function updateBorders() {
        avatarLabels.forEach(label => {
            const input = document.getElementById(label.getAttribute('for'));
            const img = label.querySelector('img');

            if (input && input.checked) {
                img.classList.add('border', 'border-primary', 'border-3');
            } else {
                img.classList.remove('border', 'border-primary', 'border-3');
            }
        });
    }

    avatarLabels.forEach(label => {
        const input = document.getElementById(label.getAttribute('for'));
        if (input) {
            input.addEventListener('change', updateBorders);
        }
    });

    updateBorders();
});
