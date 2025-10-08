<style>
  .sidbarcol {
    background-color: #fff;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
  }

  .sidebar {
    background: white;
    padding: 20px;
    height: 100vh;
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

  /* MODIFICATION: Used Flexbox for better icon alignment */
  .menu li {
    display: flex;
    align-items: center;
    padding: 10px;
    cursor: pointer;
    border-left: 4px solid transparent;
    border-radius: 10px;
    margin-bottom: 6px;
    padding-left: 20px;
    /* Adjusted padding */
  }

  /* NEW: Style for the menu icons */
  .menu-icon {
    width: 20px;
    height: 20px;
    margin-right: 15px;
    /* Adds space between icon and text */
  }

  /* .menu li.active {
    border-radius: 10px;
    color: #000;
    background-color: initial;
  } */

  /* This rule correctly makes the text inside the link white */
  .menu li:hover span,
  .menu li.active span {
    color: #FFFFFF;
  }

  /* This rule correctly sets the red background */
  .menu li:hover,
  .menu li.active {
    background-color: #BF0404;
    border-left: 4px solid transparent;
  }

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

  .video-btn i {
    font-size: 20px;
  }

  .video-btn:hover {
    background-color: #b60303;
    color: white;
    box-shadow: 0 0 20px rgba(182, 3, 3, 0.5);
  }

  /* 
  .menu li:hover {
    color: #000;
  } */

  a {
    color: inherit;
    text-decoration: none;
    cursor: pointer;
  }

  .has-submenu {
    position: relative;
    box-shadow: 0px 10px 15px #00000014;
  }

  .submenu-toggle {
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
    padding: 10px 0px;
    font-weight: 600;
    color: #333;
    border-radius: 10px;
  }

  .submenu {
    list-style: none;
    margin: 0;
    padding-left: 15px;
    display: none;
  }

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

  .submenu li:hover {
    background-color: #f9f9f9;
    border-left: 3px solid var(--red);
  }

  .has-submenu.open {
    box-shadow: 0px 10px 15px #00000014;

  }

  .has-submenu.open>.submenu {
    display: block;

  }


  .submenu-toggle i {
    transition: transform 0.2s ease;
  }

  .has-submenu.open .submenu-toggle i {
    transform: rotate(180deg);
  }

  .submenu {
    display: none;
    padding-left: 20px;
    animation: fadeIn 0.3s ease-in-out;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(-5px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
</style>

<div class="sidebar">
  <div class="user">
    <img src="<?= htmlspecialchars($data['photo']) ?>" alt="Profil">
    <h5><?= htmlspecialchars($data['user']) ?></h5>
    <p style="color:#b60303; font-weight:600; text-transform:uppercase;"><?= htmlspecialchars($data['label']) ?></p>
  </div>

  <ul class="menu">
    <?php
    $current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    ?>

    <?php foreach ($data['menu'] as $i => $item): ?>
      <?php if (isset($item['submenu'])): ?>
        <li class="has-submenu">
          <span class="submenu-toggle">
            <?= htmlspecialchars($item['label']) ?> <i class="fa fa-chevron-down"></i>
          </span>
          <ul class="submenu">
            <?php foreach ($item['submenu'] as $sub): ?>
              <li><a href="<?= htmlspecialchars($sub['lien']) ?>"><?= htmlspecialchars($sub['label']) ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php else: ?>
        <a href="<?= htmlspecialchars($item['lien']) ?>">

          <?php
          // --- START OF MODIFICATION ---
          // Default to not active
          $is_active = false;
          // Check if the current path ends with the item's link
          if (!empty($item['lien']) && $item['lien'] !== '/') {
            $is_active = str_ends_with($current_path, $item['lien']);
          }
          // --- END OF MODIFICATION ---
          ?>

          <li class="<?= $is_active ? 'active' : '' ?>">

            <?php if (isset($item['icon']) && !empty($item['icon'])):
              $icon_path_info = pathinfo($item['icon']);
              $icon_directory = $icon_path_info['dirname'];
              $icon_filename = $icon_path_info['filename'];
              $icon_extension = $icon_path_info['extension'];
              $active_icon_path = "{$icon_directory}/{$icon_filename}-white.{$icon_extension}";
              ?>
              <img src="<?= htmlspecialchars($item['icon']) ?>" class="menu-icon"
                data-icon-default="<?= htmlspecialchars($item['icon']) ?>"
                data-icon-active="<?= htmlspecialchars($active_icon_path) ?>" alt="">
            <?php endif; ?>
            <span><?= htmlspecialchars($item['label']) ?></span>
          </li>
        </a>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>


  <button class="video-btn">
    <i class="fa-solid fa-video"></i>
    <span>Video Conférence</span>
  </button>
</div>

<script>
  $(document).ready(function () {

    // --- NEW: Function to set the initial active icon ---
    function setInitialActiveState() {
      var activeItem = $('.menu li.active');
      if (activeItem.length) {
        var activeIcon = activeItem.find('.menu-icon');
        if (activeIcon.length) {
          activeIcon.attr('src', activeIcon.data('icon-active'));
        }
      }
    }

    // Set the icon for the initially active item on page load
    setInitialActiveState();

    // --- UPDATED: Click handler ---
    $('.menu a').on('click', function (e) {
      // Find the `li` within the clicked `a` tag
      var clickedLi = $(this).find('li');

      // Reset any previously active item
      $('.menu li.active').each(function () {
        var oldActiveIcon = $(this).find('.menu-icon');
        if (oldActiveIcon.length) {
          oldActiveIcon.attr('src', oldActiveIcon.data('icon-default'));
        }
      });

      // Remove active class from all items
      $('.menu li').removeClass('active');

      // Add active class to the clicked item
      clickedLi.addClass('active');

      // Set the active icon for the newly clicked item
      var newActiveIcon = clickedLi.find('.menu-icon');
      if (newActiveIcon.length) {
        newActiveIcon.attr('src', newActiveIcon.data('icon-active'));
      }
    });

    // --- NEW: Hover handler ---
    $('.menu li').hover(function () {
      // On hover-in, set the icon to its active state
      var icon = $(this).find('.menu-icon');
      if (icon.length) {
        icon.attr('src', icon.data('icon-active'));
      }
    }, function () {
      // On hover-out, only revert the icon if the item is NOT active
      if (!$(this).hasClass('active')) {
        var icon = $(this).find('.menu-icon');
        if (icon.length) {
          icon.attr('src', icon.data('icon-default'));
        }
      }
    });

    // Your existing submenu toggle logic
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