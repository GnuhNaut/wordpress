document.addEventListener('DOMContentLoaded', function() {
    const fabToggle = document.getElementById('jse-fab-toggle');
    const fabWrapper = document.getElementById('jse-fab-wrapper'); 

    if (!fabToggle || !fabWrapper) return;

    const iconSupport = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20"><path fill="currentColor" d="M10 14.5a2 2 0 0 1-1.994-1.84A6.002 6.002 0 0 1 10 1a6 6 0 0 1 5.98 5.5a.47.47 0 0 1-.48.5a.54.54 0 0 1-.525-.5a5 5 0 1 0-6.79 5.16A2 2 0 1 1 10 14.5M5.009 12H5.1a7 7 0 0 0 2.033 1.388A3 3 0 0 0 12.959 12H15a2 2 0 0 1 2 2c0 1.691-.833 2.966-2.135 3.797C13.583 18.614 11.855 19 10 19s-3.583-.386-4.865-1.203C3.833 16.967 3 15.69 3 14c0-1.113.903-2 2.009-2M14 7a4 4 0 0 1-1.87 3.387A3 3 0 0 0 10 9.5a3 3 0 0 0-2.13.887a4 4 0 0 1-1.638-2.042A4 4 0 0 1 6 7a4 4 0 1 1 8 0"/></svg>`;
    
    const iconClose = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="currentColor" d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12 19 6.41z"/></svg>`;

    const fabIconWrapper = fabToggle.querySelector('.fab-icon');

    fabToggle.addEventListener('click', function(e) {
        e.preventDefault(); // Ngăn chặn hành vi mặc định nếu là thẻ a, dù ở đây là button
        const isActive = fabWrapper.classList.toggle('active');
        
        if (isActive) {
            fabIconWrapper.innerHTML = iconClose;
        } else {
            fabIconWrapper.innerHTML = iconSupport;
        }
    });
});