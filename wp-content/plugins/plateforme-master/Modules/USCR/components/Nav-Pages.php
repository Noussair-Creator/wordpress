<div class="nav-pages">
  <div class="nav-scroll">
    <a href="/presentation-de-la-plateforme" class="nav-link">Présentation de <br>la plateforme</a>
    <a href="/unite-genomique" class="nav-link">Unité Génomique</a>
    <a href="#" class="nav-link">Unité Analyse <br>cellulaire et protéique</a>
    <a href="#" class="nav-link">Unité Techniques <br>analytiques et appliquées</a>
    <a href="#" class="nav-link">Unité Histologie</a>
    <a href="#" class="nav-link">Réservation <br>service</a>
  </div>

  <div class="nav-user" id="navUser">
    <img src="<?= $data['photo'] ?>" alt="Profil">
    <div class="user-name">
      <?= strtoupper($data['user']) ?><br><strong>RECHERCHE</strong>
      <div class="dropdown-icon">▼</div>
    </div>
    <ul class="user-menu" id="userMenu">
      <li><a href="#">Dashboard</a></li>
      <li><a href="#">PMO</a></li>
      <li><a href="#">École doctorale</a></li>
    </ul>
  </div>





</div>




<style>
.nav-user {
  position: relative;
  cursor: pointer;
}

.user-menu {
  display: none;
  position: absolute;
  top: calc(100% + 8px); /* affiché juste en dessous */
  right: 0;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  min-width: 220px;
  z-index: 1000;
}


.nav-pages {
  background: #b60303;
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 0 10px;
  flex-wrap: nowrap;
}

.nav-scroll {
  display: flex;
  overflow-x: auto;
  white-space: nowrap;
  scrollbar-width: none;
}

.nav-scroll::-webkit-scrollbar {
  display: none;
}

.nav-link {
  color: #fff;
  text-decoration: none;
  font-weight: 600;
  padding: 15px 25px;
  font-size: 15px;
  border-right: 1px solid rgba(255, 255, 255, 0.3);
  flex-shrink: 0;
  display: inline-block;
  min-width: 150px;
  max-width: 230px;
  white-space: normal;
  text-align: left;
  word-break: break-word;
  line-height: 1.4;
  text-align:left
}

.nav-link:last-of-type {
  border-right: none;
}

.nav-user {
    display: flex;
    align-items: center;
    position: relative;
    margin-left: 10px;
    cursor: pointer;
    flex-shrink: 0;
    margin-right: 31px;
}

.nav-user img {
  width: 48px;
  height: 48px;
  border-radius: 50%;
  object-fit: cover;
  margin-right: 10px;
}

.user-name {
  color: white;
  font-size: 14px;
  line-height: 1.2;
  position: relative;
  font-weight: 500;
}

.user-name strong {
  font-weight: 700;
}

.dropdown-icon {
  position: absolute;
  top: 0;
  right: -18px;
  font-size: 18px;
}

.user-menu {
  display: none;
  position: absolute;
  top: 65px;
  right: 0;
  background: white;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  min-width: 220px;
  z-index: 1000;
}

.user-menu li {
  list-style: none;
  border-bottom: 1px solid #eee;
}

.user-menu li:last-child {
  border-bottom: none;
}

.user-menu li a {
  display: block;
  padding: 12px 20px;
  color: #000;
  text-decoration: none;
  font-size: 15px;
}

.user-menu li a:hover {
  background: #f8f8f8;
}


a.nav-link:hover {
    color: #fff;
}
</style>


<script>
document.addEventListener('DOMContentLoaded', function () {
  const navUser = document.getElementById('navUser');
  const userMenu = document.getElementById('userMenu');

  navUser.addEventListener('click', function (e) {
    e.stopPropagation();
    userMenu.style.display = (userMenu.style.display === 'block') ? 'none' : 'block';
  });

  document.addEventListener('click', function (e) {
    if (!navUser.contains(e.target)) {
      userMenu.style.display = 'none';
    }
  });
});
</script>
