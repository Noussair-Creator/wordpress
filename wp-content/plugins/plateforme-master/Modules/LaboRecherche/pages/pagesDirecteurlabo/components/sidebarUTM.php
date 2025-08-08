
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
  padding: 10px;
  cursor: pointer;
  border-left: 4px solid transparent;
  border-radius: 10px;
  margin-bottom: 6px;
  padding-left: 60px;
}
.menu li.active {
  border-radius: 10px;
  color: #000; 
 background-color: initial;
}
.menu li:hover {
  background-color:  initial;
  border-left: 4px solid #b60303;
}
ul.submenu {
    margin-left: -75px;
    margin-right: -10px;
    margin-bottom: -10px;
}
.video-btn {
    display: flex
;
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
.menu li:hover{
    color: #000;

  }
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

.has-submenu.open > .submenu {
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
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}

</style>

<div class="sidebar">
  <div class="user">
    <img src="<?= $data['photo'] ?>" alt="Profil">
    <h5><?= $data['user'] ?></h5>
    <p style="color:#b60303; font-weight:600; text-transform:uppercase;"><?= $data['label'] ?></p>
  </div>

  <ul class="menu">
    <?php foreach ($data['menu'] as $i => $item): ?>
      <?php if (isset($item['submenu'])): ?>
        <li class="has-submenu">
          <span class="submenu-toggle"><?= $item['label'] ?> <i class="fa fa-chevron-down"></i></span>
          <ul class="submenu">
            <?php foreach ($item['submenu'] as $sub): ?>
              <li><a href="<?= $sub['lien'] ?>"><?= $sub['label'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </li>
      <?php else: ?>
        <a href="<?= $item['lien'] ?>"><li class="<?= $i === 0 ? 'active' : '' ?>"><?= $item['label'] ?></li></a>
      <?php endif; ?>
    <?php endforeach; ?>
  </ul>


  <button class="video-btn">
    <i class="fa-solid fa-video"></i>
    <span>Video Conférence</span>
  </button>
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