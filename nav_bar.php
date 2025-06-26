<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-default" style="background-color: #ffffff; border-bottom: 2px solid #ddd; padding: 10px 20px;">
  <div class="container-fluid">
    <!-- Logo & Hamburger for mobile -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard_pelajar.php" style="display: flex; align-items: center; font-family: 'Poppins', sans-serif; font-weight: bold; color: #222;">
        <img src="logo.png" alt="First Step Siswa Logo" style="height: 40px; margin-right: 10px;">
        First Step Siswa
      </a>
    </div>

    <!-- Navigation Items -->
    <div class="collapse navbar-collapse" id="navbar-menu">
      <!-- Left nav -->
      <ul class="nav navbar-nav">
        <li>
          <a href="borang_permohonan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;"
             onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">
            Permohonan Bantuan
          </a>
        </li>
        <li>
          <a href="status_permohonan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;"
             onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">
            Status Permohonan
          </a>
        </li>
        <li>
          <a href="jenis_bantuan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;"
             onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">
            Jenis Bantuan
          </a>
        </li>
      </ul>

      <!-- Right nav (user profile) -->
      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['full_name'])): ?>
          <li class="navbar-text" style="font-family: 'Poppins', sans-serif; font-weight: bold; color: #222;">
            Selamat Datang, <?php echo htmlspecialchars(ucwords($_SESSION['full_name'])); ?>!
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"
               style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500; display: flex; align-items: center;">
              <img src="user-icon.png" alt="User" style="height: 30px; margin-right: 5px;"> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" style="background-color: #fff; box-shadow: 0px 4px 6px rgba(0,0,0,0.1); border-radius: 5px;">
              <li><a href="profil.php" style="color: #222; font-family: 'Poppins', sans-serif;">Mengurus Profil</a></li>
              <li><a href="faq.php" style="color: #222; font-family: 'Poppins', sans-serif;">Soalan Lazim</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="logout.php" style="color: red; font-family: 'Poppins', sans-serif;">Log Keluar</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="login_pelajar.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: bold;">Log Masuk</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>