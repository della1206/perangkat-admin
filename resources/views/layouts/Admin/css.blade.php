<style>
    /* CSS untuk memastikan sidebar benar-benar di luar layar saat HP */
    @media (max-width: 768px) {
        aside {
            position: fixed !important;
            left: 0 !important;
            transform: translateX(-100%) !important; /* Paksa geser ke kiri luar layar */
            z-index: 9999 !important;
        }

        /* Saat Alpine.js memberikan class translate-x-0 (menu dibuka) */
        aside.translate-x-0 {
            transform: translateX(0) !important;
        }

        /* Paksa area dashboard mengambil lebar 100% */
        main {
            margin-left: 0 !important;
            width: 100% !important;
            min-width: 100% !important;
        }
    }

    [x-cloak] { display: none !important; }

    @media (max-width: 767.98px) {
    /* 1. Paksa Main Content memenuhi lebar layar */
    main, .flex-1, .layout-page {
        margin-left: 0 !important;
        padding-left: 0 !important;
        width: 100% !important;
        max-width: 100vw !important;
        display: block !important;
    }

    /* 2. Hilangkan ruang kosong di kiri container content */
    .p-4, .md:p-8, .container-xxl {
        padding-left: 10px !important;
        padding-right: 10px !important;
    }

    /* 3. Pastikan Sidebar benar-benar "melayang" dan tidak mengambil ruang */
    aside {
        position: fixed !important;
        height: 100vh !important;
        z-index: 9999 !important;
    }
    
    /* 4. Mencegah scroll horizontal yang bikin tampilan goyang */
    body, html {
        overflow-x: hidden !important;
        position: relative;
    }
}
</style>