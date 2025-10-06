<!-- Bootstrap 5 CSS (kept for base variables/resets, but component styles are overridden below) -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<style>
/* Header Styles */
.main-header-body {
    background-color: #b60303;
    color: white;
    position: sticky;
    top: 0;
    z-index: 1020;
    padding: 20px 0;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
}

.main-nav {
    background-color: var(--custom-red);
    display: flex;
    /* flex-wrap: wrap; */
    align-items: center;
    justify-content: space-between;
    width: 100%;
    max-width: 1140px;
    /* Corresponds to Bootstrap's .container on large screens */
    padding-right: 0.75rem;
    padding-left: 0.75rem;
    margin-right: auto;
    margin-left: auto;
}

.logo-link {
    padding-top: 0.5rem;
    padding-bottom: 0.5rem;
    margin-right: 1rem;
    text-decoration: none;
}

.logo-container {
    background-color: white;
    border-radius: 50%;
    padding: 0.25rem;
    display: flex;
    align-items: center;
    justify-content: center;
}

.logo-svg {
    width: 60px;
    height: 60px;
    color: #212529;
    /* Bootstrap's gray-800 */
}

.nav-toggler {
    padding: 0.25rem 0.75rem;
    font-size: 1.25rem;
    line-height: 1;
    background-color: transparent;
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 0.375rem;
    transition: box-shadow 0.15s ease-in-out;
}

.nav-toggler-icon {
    display: inline-block;
    width: 1.5em;
    height: 1.5em;
    vertical-align: middle;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
    background-repeat: no-repeat;
    background-position: center;
    background-size: 100%;
}

.nav-links-container {
    display: none;
    /* Hidden by default */
    flex-basis: 100%;
    flex-grow: 1;
    align-items: center;
}

.nav-links-container.show {
    display: block;
    /* Shown when toggled */
}

.nav-links-list {
    display: flex;
    flex-direction: column;
    padding-left: 0;
    margin-bottom: 0;
    list-style: none;
    margin-right: auto;
    margin-left: auto;
    align-items: center;
}

/* MODIFICATION START */
.nav-link-item a {
    color: white;
    text-decoration: none;
    display: flex;
    /* Use flexbox for alignment */
    align-items: center;
    /* Vertically center content */
    justify-content: center;
    /* Horizontally center content */
    text-align: center;
    /* Ensure wrapped text is centered */
    height: 60px;
    /* Give a fixed height to normalize all items */
    padding: 0 10px;
}

/* MODIFICATION END */

.nav-link-item {
    position: relative;
}

/* MODIFICATION START */
.nav-link-item.active::after {
    content: '';
    position: absolute;
    bottom: -20px;
    /* Position relative to the bottom of the header padding */
    left: 15px;
    /* Adjust horizontal spacing */
    right: 15px;
    /* Adjust horizontal spacing */
    height: 4px;
    width: auto;
    border-top-left-radius: 20px;
    border-top-right-radius: 20px;
    background-color: white;
}

/* MODIFICATION END */

/* This rule was invalid and has been removed */
/* .nav-link-item.active::after:last-child { ... } */

.nav-link-item a:hover {
    color: #f8f9fa;
    /* Lighter white */
}

.nav-separator {
    color: rgba(255, 255, 255, 0.5);
    padding: 0.5rem 1rem;
    display: none;
    /* Hidden on mobile */
}

/* Medium and larger screens (desktop) */
@media (min-width: 768px) {
    .nav-toggler {
        display: none;
    }

    .nav-links-container {
        display: flex !important;
        /* Overriding Bootstrap's .collapse */
        flex-basis: auto;
    }

    .nav-links-list {
        flex-direction: row;
    }

    .nav-separator {
        display: block;
        /* Show separator on desktop */
    }
}
</style>


<!-- Header Section -->
<header class="main-header-body">
    <nav class="main-nav">
        <!-- <a class="logo-link" href="#">
                <div class="logo-container">
                    <img class="logo-svg"
                        src="/wp-content/plugins/plateforme-master/images/SiteRechercheImages/Groupe 3291.png"
                        alt="Groupe 3291.png">
                </div>
            </a> -->
        <button class="nav-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="nav-toggler-icon"></span>
        </button>
        <div class="nav-links-container collapse" id="mainNavbar">
            <ul class="nav-links-list">
                <li class="nav-link-item"><a href="/presentation-utm">Présentation</a></li>
                <!--   <li class="nav-separator">|</li>
               <li class="nav-link-item"><a href="/etablissements-utm">Etablissements</a></li>-->
                <li class="nav-separator">|</li>
                <li class="nav-link-item"><a href="/publications-utm">Publications</a></li>
                <li class="nav-separator">|</li>
                <li class="nav-link-item"><a href="/projets-de-cooperation-utm">Projets de recherche</a></li>
                <li class="nav-separator">|</li>
                <li class="nav-link-item"><a href="/ouverture-sur-lenvironnement-utm">Ouverture sur
                        l'environnement</a></li>
                <li class="nav-separator">|</li>
                <!--<li class="nav-link-item"><a href="/annonces-de-soutenances-utm">Annonces de soutenances</a></li>
                  <li class="nav-separator">|</li>-->
                <li class="nav-link-item"><a href="/manifestation-utm">Manifestation</a></li>
            </ul>
        </div>
    </nav>
</header>

<!-- Bootstrap 5 JS Bundle (needed for the mobile menu toggle) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const navLinkItems = document.querySelectorAll('.nav-link-item');
    // Get the currently active link from local storage
    const activeNavLink = localStorage.getItem('activeNavLink');

    // Remove the active class from all navigation items first
    navLinkItems.forEach(item => item.classList.remove('active'));

    let activeSet = false;
    // If there's an active link saved in local storage, apply the active class
    if (activeNavLink) {
        navLinkItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === activeNavLink) {
                item.classList.add('active');
                activeSet = true;
            }
        });
    }

    // If no active link was set from local storage (e.g., on the first visit), default to the first one
    if (!activeSet && navLinkItems.length > 0) {
        navLinkItems[0].classList.add('active');
        const firstLinkHref = navLinkItems[0].querySelector('a')?.getAttribute('href');
        if (firstLinkHref) {
            localStorage.setItem('activeNavLink', firstLinkHref);
        }
    }

    // Add a click event listener to each navigation item
    navLinkItems.forEach(item => {
        item.addEventListener('click', function() {
            const link = this.querySelector('a');
            if (link) {
                // When a link is clicked, save its href to local storage
                // This ensures it will be the active link on the next page load
                localStorage.setItem('activeNavLink', link.getAttribute('href'));
            }
        });
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const paramKey = 'laboratoireid';

    // 1) Récupérer l'ID
    const url = new URL(location.href);
    const qsId = url.searchParams.get(paramKey) || url.searchParams.get('laboratoire_id');
    const pathMatch = location.pathname.match(new RegExp(`(?:^|/)${paramKey}=(\\d+)(?:/|$)`, 'i'));
    const pmId = (window.PMSettings && (PMSettings.laboratoireId || PMSettings.laboId)) ? (PMSettings
        .laboratoireId || PMSettings.laboId) : null;
    let laboId = qsId || (pathMatch && pathMatch[1]) || pmId || localStorage.getItem(paramKey) || null;

    if (laboId) localStorage.setItem(paramKey, laboId);

    // 2) Plus AUCUNE route en segment (tout en query)
    const normalizePath = (p) =>
        p.replace(new RegExp(`/(?:${paramKey}=[^/]+)$`, 'i'), '').replace(/\/+$/, '');

    // 3) Réécrire les href du menu en ?laboratoireid=...
    const navLinkItems = document.querySelectorAll('.nav-link-item');
    const anchors = document.querySelectorAll('.nav-links-list a');

    if (laboId) {
        anchors.forEach(a => {
            const original = a.getAttribute('href');
            if (!original) return;

            const u = new URL(original, location.origin);

            // ✨ Nettoyer un ancien segment /laboratoireid=11 s'il existe
            u.pathname = u.pathname
                .replace(new RegExp(`/(?:${paramKey}=[^/]+)(?=/|$)`, 'i'), '')
                .replace(/\/+$/, '/'); // un seul trailing slash
            if (!/\/$/.test(u.pathname)) u.pathname += '/'; // forcer slash final (style WP)

            // ✨ Forcer le paramètre en query
            u.searchParams.set(paramKey, laboId);

            a.setAttribute('href', u.pathname + u.search + u.hash);
        });
    }

    // 4) Migrer un activeNavLink ancien (segment) vers query si besoin
    const savedHref0 = localStorage.getItem('activeNavLink');
    if (savedHref0 && /\/laboratoireid=\d+(?:\/|$)/i.test(savedHref0)) {
        try {
            const u = new URL(savedHref0, location.origin);
            u.pathname = u.pathname
                .replace(new RegExp(`/(?:${paramKey}=[^/]+)(?=/|$)`, 'i'), '')
                .replace(/\/+$/, '/');
            if (!/\/$/.test(u.pathname)) u.pathname += '/';
            if (laboId) u.searchParams.set(paramKey, laboId);
            localStorage.setItem('activeNavLink', u.pathname + u.search + u.hash);
        } catch (e) {}
    }

    // 5) Gérer l'état actif
    const savedHref = localStorage.getItem('activeNavLink');
    let activeSet = false;

    if (savedHref) {
        navLinkItems.forEach(item => {
            const link = item.querySelector('a');
            if (link && link.getAttribute('href') === savedHref) {
                item.classList.add('active');
                activeSet = true;
            } else {
                item.classList.remove('active');
            }
        });
    }

    if (!activeSet) {
        const currentPathNormalized = normalizePath(location.pathname);
        navLinkItems.forEach(item => {
            const link = item.querySelector('a');
            if (!link) return;
            const u = new URL(link.getAttribute('href'), location.origin);
            if (normalizePath(u.pathname) === currentPathNormalized) {
                item.classList.add('active');
                localStorage.setItem('activeNavLink', link.getAttribute('href'));
                activeSet = true;
            } else {
                item.classList.remove('active');
            }
        });
    }

    // 6) Sauvegarder au clic
    navLinkItems.forEach(item => {
        item.addEventListener('click', function() {
            const link = this.querySelector('a');
            if (!link) return;
            localStorage.setItem('activeNavLink', link.getAttribute('href'));
            if (laboId) localStorage.setItem(paramKey, laboId);
        });
    });
});
</script>