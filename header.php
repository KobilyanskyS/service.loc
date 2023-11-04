<nav id="target" class="navbar navbar-expand-lg navbar-light mb-2">
  <div class="container border-bottom pb-3">
    <a class="navbar-brand" href="index.php">
      Записи
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item d-block d-md-block d-lg-none text-primary username">
          Пользователь
        </li>
        <li class="nav-item d-block d-md-block d-lg-none ">
          <a class="nav-link session_name session_name" href="#">Профиль</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="mynotes.php">Мои записи</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Все записи</a>
        </li>
        <?php if ($_COOKIE["role"] == "admin") {?>
        <li class="nav-item">
          <a class="nav-link" href="admin_panel.php">Админ-панель</a>
        </li>
        <?php }?>
        
        <li class="nav-item d-block d-md-block d-lg-none">
          <a class="text-danger nav-link" href="#">Выйти</a>
        </li>
      </ul>
      <ul class="d-none d-lg-block d-xl-block nav nav-pills">
        <li class="nav-item nav-item dropdown">
          <a class="nav-link dropdown-toggle session_name username" data-bs-toggle="dropdown" href="#" role="button"
            aria-expanded="false">Имя пользователя</a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Профиль</a></li>
            <li><a class="text-danger dropdown-item" href="logout.php">Выйти</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script>
  let username = $.cookie("username");
  $(".username").html(username);
</script>
