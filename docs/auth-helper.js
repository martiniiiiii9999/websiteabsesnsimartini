document.addEventListener('DOMContentLoaded', function() {
    const isLoggedIn = localStorage.getItem('isLoggedIn');
    const authLink = document.querySelector('a[href="login.html"]');
    
    if (authLink) {
        if (isLoggedIn) {
            authLink.textContent = 'Logout';
            authLink.href = '#';
            authLink.classList.remove('btn-outline-light');
            authLink.classList.add('btn-danger', 'text-white');
            
            authLink.addEventListener('click', function(e) {
                e.preventDefault();
                localStorage.removeItem('isLoggedIn');
                localStorage.removeItem('userEmail');
                window.location.href = 'login.html';
            });
        }
    }
});
