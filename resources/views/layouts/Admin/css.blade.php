<style>
    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    .animate-bounce {
        animation: bounce 1s ease-in-out 3;
    }

    /* Smooth transitions for dropdowns */
    #notificationDropdown, #messageDropdown, #profileDropdown {
        transition: all 0.2s ease-in-out;
        transform-origin: top right;
    }

    #notificationDropdown:not(.hidden),
    #messageDropdown:not(.hidden),
    #profileDropdown:not(.hidden) {
        animation: fadeInUp 0.2s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }
</style>