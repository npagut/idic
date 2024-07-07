document.addEventListener('DOMContentLoaded', function() {
    if (localStorage.getItem('access_token')) {
        localStorage.removeItem('access_token');
    }
});
