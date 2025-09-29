
<!-- SIDEBAR -->
<!-- SIDEBAR -->
<style>
.sidbarcol {
    background-color: #fff;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
}
.sidebar {
    background: white;
    padding: 20px;
    top: -4px;
    position: relative;
    padding-top: 45px;
}
.user {
  text-align: center;
}
.user img {
    width: 132px;
    border-radius: 50%;
    height: 132px;
    border: 3px solid #000;
}
.menu {
    list-style: none;
    padding: 0;
    margin-top: 20px;
    margin-right: -20px;
    margin-left: -29px;
}
.menu li {
  padding: 10px 20px;
  cursor: pointer;
  border-left: 4px solid transparent;
  border-radius: 10px;
  padding-left: 90px; /* espace pour l'icône */
  position: relative;
  display: block;
  font: normal normal medium 15px/18px Roboto;
letter-spacing: 0px;
color: #2A2916;
opacity: 1;
}

/* icône dans le menu */
.menu-icon {
  position: absolute;
  left: 60px;
  top: 50%;
  transform: translateY(-50%);
  width: 19px;
  height: 19px;
  object-fit: contain;
}

/* pour les éléments avec sous-menu on ajuste */
.has-submenu > .submenu-toggle {
  padding-left: 60px;
  position: relative;
}

/* icône pour la ligne du submenu-toggle */
.has-submenu .menu-icon {
  left: 10px;
}

/* Submenu */
ul.submenu {
    margin-left: -75px;
    margin-right: -10px;
    margin-bottom: -10px;
}
.video-btn {
    display: flex;
    align-items: center;
    gap: 10px;
    background-color: white;
    border: 3px solid #b60303;
    color: #b60303;
    font-weight: bold;
    font-size: 14px;
    padding: 8px 20px;
    border-radius: 10px;
    cursor: pointer;
    box-shadow: 0 0 15px rgba(182, 3, 3, 0.3);
    transition: all 0.3s ease;
}
.video-btn i { font-size: 20px; }
.video-btn:hover { background-color: #b60303; color: white; box-shadow: 0 0 20px rgba(182, 3, 3, 0.5); }
.menu li:hover{ color: #000; }
a { color: inherit; text-decoration: none; cursor: pointer; }

.has-submenu { position: relative; box-shadow: 0px 10px 15px #00000014; }
.submenu-toggle { display: flex; justify-content: space-between; align-items: center; cursor: pointer; padding: 10px 0px; font-weight: 600; color: #333; border-radius: 10px; }
.submenu { list-style: none; margin: 0; padding-left: 15px; display: none; }
.submenu li {
    padding: 15px 10px;
    font-size: 15px;
    cursor: pointer;
    color: #2A2916;
    background-color: #A6A48533;
    margin-bottom: 0px;
    font-weight: 600;
    border-radius: 0px;
    border-bottom: 2px solid #A6A4859E;
    padding-left: 75px;
}
.submenu li:hover { background-color: #f9f9f9; border-left: 3px solid var(--red); }

.has-submenu.open { box-shadow: 0px 10px 15px #00000014; }
.has-submenu.open > .submenu { display: block; }
.submenu-toggle i { transition: transform 0.2s ease; }
.has-submenu.open .submenu-toggle i { transform: rotate(180deg); }

.submenu { display: none; padding-left: 20px; animation: fadeIn 0.3s ease-in-out; }
@keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }

</style>


<div class="sidebar">
  <div class="user">
    <img src="<?= esc_attr($data['photo']) ?>" alt="Profil">
    <h5><?= esc_html($data['user']) ?></h5>
    <p style="color:#b60303; font-weight:600; text-transform:uppercase;"><?= esc_html($data['label']) ?></p>
  </div>

  <ul class="menu">
    <?php foreach ($data['menu'] as $i => $item): 
        // construire l'URL de l'icône si fournie (chemin relatif depuis le dossier du plugin)
        $iconUrl = '';
        if (!empty($item['icon'])) {
            // on suppose que 'icon' contient par ex. "images/uscr/27) Icon-home.png"
            $iconUrl = content_url('/plugins/plateforme-master/' . ltrim($item['icon'], '/'));
        }
    ?>
      <?php if (isset($item['submenu'])): ?>
        <li class="has-submenu">
          <span class="submenu-toggle">
            <?php if ($iconUrl): ?><img class="menu-icon" src="<?= esc_url($iconUrl) ?>" alt="icon"><?php endif; ?>
            <span><?= esc_html($item['label']) ?></span>
            <i class="fa fa-chevron-down"></i>
          </span>

          <ul class="submenu">
            <?php foreach ($item['submenu'] as $sub): 
                $subIconUrl = '';
                if (!empty($sub['icon'])) {
                  $subIconUrl = content_url('/plugins/plateforme-master/' . ltrim($sub['icon'], '/'));
                }
            ?>
              <li>
                <?php if ($subIconUrl): ?><img class="menu-icon" src="<?= esc_url($subIconUrl) ?>" alt="icon"><?php endif; ?>
                <a href="<?= esc_url($sub['lien']) ?>"><?= esc_html($sub['label']) ?></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php else: ?>
        <a href="<?= esc_url($item['lien']) ?>">
          <li class="<?= $i === 0 ? 'active' : '' ?>">
            <?php if ($iconUrl): ?><img class="menu-icon" src="<?= esc_url($iconUrl) ?>" alt="icon"><?php endif; ?>
            <?= esc_html($item['label']) ?>
          </li>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>

  <a href="<?= esc_url($data['video_link'] ?? '#') ?>">
    <button class="video-btn" type="button">
      <i class="fa-solid fa-video"></i>
      <span>Video Conférence</span>
    </button>
  </a>
</div>

<script>

$(document).ready(function() {
  $('.menu li').click(function() {
    $('.menu li').removeClass('active');
    $(this).addClass('active');
  });
});


$(document).ready(function () {
  $('.menu li').click(function () {
    $('.menu li').removeClass('active');
    $(this).addClass('active');
  });

  $('.submenu-toggle').on('click', function () {
    let parent = $(this).parent('.has-submenu');
    let submenu = parent.find('.submenu');

    if (parent.hasClass('open')) {
      submenu.stop().slideUp(200);
      $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
    } else {
      submenu.stop().slideDown(200);
      $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
    }

    parent.toggleClass('open');
  });
});



</script>