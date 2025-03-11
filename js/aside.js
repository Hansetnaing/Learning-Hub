const hamburger = document.getElementById('hamburger');
const sidebar = document.getElementById('sidebar');

    hamburger.addEventListener('click', (event) => {
        sidebar.classList.toggle('active');

        if (sidebar.classList.contains('active')) {
            hamburger.innerHTML = '<i class="fa-solid fa-times"></i>';
        } else {
            hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
        }

        event.stopPropagation(); // Prevent closing when clicking the hamburger
    });

    document.addEventListener('click', (event) => {
        if (!sidebar.contains(event.target) && !hamburger.contains(event.target)) {
            sidebar.classList.remove('active');
            hamburger.innerHTML = '<i class="fa-solid fa-bars"></i>';
        }
    });