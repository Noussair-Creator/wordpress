<!-- DASHBOARD BAR -->
<style>
.dashboard-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 24px;
    background: #fff;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}

.dashboard-icons {
    display: flex;
    align-items: center;
    gap: 12px;
}

.icon-box {
    position: relative;
    width: 38px;
    height: 38px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #111;
    font-size: 16px;
    cursor: pointer;
}

.icon-box.logout {
    background: #b30000;
    color: #fff;
}

.badge-dot {
    position: absolute;
    top: 2px;
    right: 2px;
    min-width: 16px;
    height: 16px;
    background-color: red;
    color: white;
    font-size: 10px;
    font-weight: bold;
    border-radius: 999px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0 4px;
    box-shadow: 0 0 0 2px #fff;
}

.search-container {
    display: flex;
    align-items: center;
    position: relative;
}

#search-input {
    width: 0;
    opacity: 0;
    transition: all 0.3s ease;
    padding: 6px 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 6px;
    margin-left: 8px;
    pointer-events: none;
}

/* Lorsque visible */
.search-container.active #search-input {
    width: 180px;
    opacity: 1;
    pointer-events: auto;
}

.dashboard-title {
    font-weight: 600;
    font-size: 21px;
    color: #000;
    text-transform: uppercase;
}

span.title-active {
    color: #000;
}
</style>
<?php
// Récupère l'ID de la page actuelle
$current_id = get_the_ID();

// Récupère l'ID du parent s’il existe
$parent_id = wp_get_post_parent_id($current_id);

// Si la page a un parent
if ($parent_id) {
    $parent_title = get_the_title($parent_id);
    $parent_link = get_permalink($parent_id);
}

// Puis affiche le titre de la page actuelle
?>

<div class="dashboard-bar">
    <div class="dashboard-title">
        <?php echo '<a href="' . esc_url($parent_link) . '">' . esc_html($parent_title) . '</a>';
        echo ' <span class="title-active">' . get_the_title($current_id) . '</span>'; ?>
    </div>
    <div class="dashboard-icons">

        <div class="search-container">

            <input type="text" id="search-input" placeholder="Rechercher..." />
            <div class="icon-box" id="search-icon">
                <i class="fas fa-search"></i>
            </div>
        </div>
        <div class="icon-box has-badge"><i class="fas fa-comment-dots"></i><span class="badge-dot">4</span></div>
        <div class="icon-box has-badge"><i class="fas fa-bell"></i><span class="badge-dot">2</span></div>

        <div class="icon-box">
            <a href="/profile_" class="icon-box" title="Profil">
                <i class="fas fa-cog"></i>
            </a>
        </div>


        <!-- <div class="icon-box logout"><i class="fas fa-sign-out-alt"></i></div>-->

        <a class="icon-box logout" href="<?php echo wp_logout_url(home_url()); ?>">
            <i class="fas fa-sign-out-alt"></i>
        </a>
    </div>
</div>


<script>
const searchIcon = document.getElementById('search-icon');
const searchContainer = document.querySelector('.search-container');

searchIcon.addEventListener('click', () => {
    searchContainer.classList.toggle('active');
    const input = document.getElementById('search-input');
    if (searchContainer.classList.contains('active')) {
        input.focus();
    } else {
        input.value = '';
    }
});
</script>