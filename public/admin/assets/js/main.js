document.addEventListener("DOMContentLoaded", function () {
    const alerts = document.querySelectorAll('.auto-fade-alert');
    
    alerts.forEach(function (alert) {
        alert.style.transition = "opacity 0.6s ease-out";
        setTimeout(function() {
            alert.style.opacity = "0";
            setTimeout(function() { 
                alert.remove(); 
            }, 600); 
        }, 3000); 
    });
});
