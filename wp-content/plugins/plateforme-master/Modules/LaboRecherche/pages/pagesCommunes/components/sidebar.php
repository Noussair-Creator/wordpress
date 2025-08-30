
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
}
.menu li {
  padding: 10px;
  cursor: pointer;
  border-left: 4px solid transparent;
  border-radius: 10px;
  margin-bottom: 6px;
}
.menu li.active {
  background-color: #b60303;
  border-radius: 10px;
  color: #fff;
}
.menu li:hover {
  background-color: #f3f3f3;
  border-left: 4px solid #b60303;
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
</style>

<div class="sidebar">
  <div class="user">
    <img src="<?= $data['photo'] ?>" alt="Profil">
    <h5><?= $data['user'] ?></h5>
    <p style="color:#b60303; font-weight:600; text-transform:uppercase;"><?= $data['label'] ?></p>

    <?php if (!empty($data['profil_nom'])): ?>
      <p style="font-size: 15px;color:#b60303; font-weight:600; text-transform:uppercase;margin-top:-20px"><?= $data['profil_nom'] ?></p>
    <?php endif; ?>
  </div>

  <?php if (!empty($data['menu'])): ?>
    <ul class="menu">
      <?php foreach ($data['menu'] as $i => $item): ?>
        <a href="<?= $item['lien'] ?>"><li class="<?= $i === 0 ? 'active' : '' ?>"><?= $item['label'] ?></li></a>
      <?php endforeach; ?>
    </ul>
  <?php else: ?>
    <p style="color: #999; text-align: center; font-size: 14px; margin-top: 20px;">Aucun menu disponible pour ce profil.</p>
  <?php endif; ?>

  <?php if (!empty($data['video_link'])): ?>
    <a href="<?= esc_url($data['video_link']) ?>" target="_blank" class="video-btn">
      <i class="fa-solid fa-video"></i>
      <span>Video Conférence</span>
    </a>
  <?php endif; ?>
</div>


<script>
    $(document).ready(function() {
  $('.menu li').click(function() {
    $('.menu li').removeClass('active');
    $(this).addClass('active');
  });
});
</script>