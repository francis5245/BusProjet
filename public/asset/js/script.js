document.addEventListener('DOMContentLoaded', function () {

    /* ================================
       1️⃣ Icônes calendrier
    ================================= */
    document.querySelectorAll('.calendar-icon').forEach(icon => {
        icon.addEventListener('click', () => {
            alert('Calendrier non implémenté dans ce prototype.');
        });
    });


    /* ================================
       2️⃣ Swap villes départ / arrivée
    ================================= */
    const swapIcon = document.querySelector('.swap-icon');
    if (swapIcon) {
        swapIcon.addEventListener('click', () => {
            const inputs = document.querySelectorAll('.from-to-input');
            if (inputs.length >= 2) {
                [inputs[0].value, inputs[1].value] = [inputs[1].value, inputs[0].value];
            }
        });
    }


    /* ================================
       3️⃣ Bouton rechercher billets
    ================================= */
    const findTicketsBtn = document.querySelector('.find-tickets-btn');
    if (findTicketsBtn) {
        findTicketsBtn.addEventListener('click', function (e) {
            e.preventDefault();

            const inputs = document.querySelectorAll('.from-to-input');
            const from = inputs[0]?.value.trim() || '';
            const to = inputs[1]?.value.trim() || '';
            const departure = document.getElementById('departureDate')?.value || '';
            const returnDate = document.getElementById('returnDate')?.value || '';

            if (!from || !to || !departure) {
                alert('Veuillez remplir tous les champs obligatoires.');
                return;
            }

            alert(
                `Recherche de billets :
De : ${from}
À : ${to}
Départ : ${departure}
${returnDate ? `Retour : ${returnDate}` : ''}`
            );
        });
    }


    /* ================================
       4️⃣ Carousel des trajets
    ================================= */
    const tripsWrapper = document.getElementById('tripsWrapper');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');

    if (tripsWrapper && prevBtn && nextBtn) {

        const cardWidth = 300;
        const gap = 15;
        let currentPosition = 0;
        let isDragging = false;
        let startX = 0;
        let startScrollLeft = 0;

        const totalCards = tripsWrapper.children.length;

        const getVisibleCards = () =>
            Math.max(1, Math.floor(window.innerWidth / (cardWidth + gap)));

        const updatePosition = () => {
            tripsWrapper.style.transform = `translateX(${currentPosition}px)`;
        };

        prevBtn.addEventListener('click', () => {
            currentPosition = Math.min(currentPosition + cardWidth + gap, 0);
            updatePosition();
        });

        nextBtn.addEventListener('click', () => {
            const maxScroll = -(totalCards - getVisibleCards()) * (cardWidth + gap);
            currentPosition = Math.max(currentPosition - cardWidth - gap, maxScroll);
            updatePosition();
        });

        // Drag souris / tactile
        const startDrag = (e) => {
            isDragging = true;
            startX = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            startScrollLeft = tripsWrapper.scrollLeft;
        };

        const drag = (e) => {
            if (!isDragging) return;
            const x = e.type.includes('touch') ? e.touches[0].clientX : e.clientX;
            tripsWrapper.scrollLeft = startScrollLeft - (x - startX);
        };

        const endDrag = () => isDragging = false;

        tripsWrapper.addEventListener('mousedown', startDrag);
        tripsWrapper.addEventListener('touchstart', startDrag);

        document.addEventListener('mousemove', drag);
        document.addEventListener('touchmove', drag);

        document.addEventListener('mouseup', endDrag);
        document.addEventListener('touchend', endDrag);

        window.addEventListener('resize', updatePosition);
    }


    /* ================================
       5️⃣ Pagination dots
    ================================= */
    const dots = document.querySelectorAll('.dot');
    if (dots.length) {
        dots.forEach(dot => {
            dot.addEventListener('click', function () {
                dots.forEach(d => d.classList.remove('active'));
                this.classList.add('active');
            });
        });
    }


    /* ================================
       6️⃣ Bouton retour en haut
    ================================= */
    const backToTopButton = document.getElementById('backToTop');
    if (backToTopButton) {

        window.addEventListener('scroll', () => {
            const visible = window.scrollY > 300;
            backToTopButton.style.opacity = visible ? '1' : '0';
            backToTopButton.style.visibility = visible ? 'visible' : 'hidden';
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

});
