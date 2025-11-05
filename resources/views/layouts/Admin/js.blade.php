<script>
    // Notification Dropdown
    const notificationButton = document.getElementById('notificationButton');
    const notificationDropdown = document.getElementById('notificationDropdown');

    notificationButton.addEventListener('click', function(e) {
        e.stopPropagation();
        notificationDropdown.classList.toggle('hidden');
        // Close other dropdowns
        messageDropdown.classList.add('hidden');
        profileDropdown.classList.add('hidden');
    });

    // Message Dropdown
    const messageButton = document.getElementById('messageButton');
    const messageDropdown = document.getElementById('messageDropdown');

    messageButton.addEventListener('click', function(e) {
        e.stopPropagation();
        messageDropdown.classList.toggle('hidden');
        // Close other dropdowns
        notificationDropdown.classList.add('hidden');
        profileDropdown.classList.add('hidden');
    });

    // Profile Dropdown
    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    profileButton.addEventListener('click', function(e) {
        e.stopPropagation();
        profileDropdown.classList.toggle('hidden');
        // Close other dropdowns
        notificationDropdown.classList.add('hidden');
        messageDropdown.classList.add('hidden');
    });

    // WhatsApp Tooltip
    const whatsappButton = document.querySelector('a[href*="wa.me"]');
    const whatsappTooltip = document.getElementById('whatsappTooltip');

    whatsappButton.addEventListener('mouseenter', function() {
        whatsappTooltip.classList.remove('opacity-0');
        whatsappTooltip.classList.add('opacity-100');
    });

    whatsappButton.addEventListener('mouseleave', function() {
        whatsappTooltip.classList.remove('opacity-100');
        whatsappTooltip.classList.add('opacity-0');
    });

    // Close all dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!notificationButton.contains(event.target) && !notificationDropdown.contains(event.target)) {
            notificationDropdown.classList.add('hidden');
        }
        if (!messageButton.contains(event.target) && !messageDropdown.contains(event.target)) {
            messageDropdown.classList.add('hidden');
        }
        if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
            profileDropdown.classList.add('hidden');
        }
    });

    // Prevent dropdowns from closing when clicking inside
    notificationDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    messageDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });
    profileDropdown.addEventListener('click', function(e) {
        e.stopPropagation();
    });

    // Remove bounce animation after 3 seconds
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            whatsappButton.classList.remove('animate-bounce');
        }, 3000);
    });
</script>