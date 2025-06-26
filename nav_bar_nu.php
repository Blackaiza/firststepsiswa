<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>


<!-- Navbar -->
<nav class="navbar navbar-default" style="background-color: #ffffff; border-bottom: 2px solid #ddd; padding: 10px 20px;">
  <div class="container-fluid">
    <!-- Header and toggle -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-du" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar" style="background-color: #222;"></span>
        <span class="icon-bar" style="background-color: #222;"></span>
        <span class="icon-bar" style="background-color: #222;"></span>
      </button>
      <a class="navbar-brand" href="dashboard_penderma.php" style="display: flex; align-items: center; font-family: 'Poppins', sans-serif; font-weight: bold; color: #222;">
        <img src="logo.png" alt="First Step Siswa Logo" style="height: 40px; margin-right: 10px;">
        First Step Siswa
      </a>
    </div>

    <!-- Collapsible Nav -->
    <div class="collapse navbar-collapse" id="navbar-collapse-du">
      <ul class="nav navbar-nav">
        <li><a href="saringan_permohonan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;" onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">Saringan Permohonan</a></li>
        <li><a href="tambah_penajaan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;" onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">Tambah Bantuan</a></li>
        <li><a href="senarai_ditaja.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;" onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">Sejarah Tajaan</a></li>
      </ul>

      <!-- Right side -->
      <ul class="nav navbar-nav navbar-right">
        <?php if (isset($_SESSION['full_name'])): ?>
          <li class="navbar-text" style="font-family: 'Poppins', sans-serif; font-weight: bold; color: #222;">
            Selamat Datang, <?php echo htmlspecialchars(ucwords($_SESSION['full_name'])); ?>!
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;">
              <img src="user-icon.png" alt="User" style="height: 30px; margin-right: 5px;"> <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" style="background-color: #fff; box-shadow: 0px 4px 6px rgba(0,0,0,0.1); border-radius: 5px;">
              <li><a href="profil.php" style="color: #222; font-family: 'Poppins', sans-serif;">Mengurus Profil</a></li>
              <li><a href="statistik_penajaan.php" style="color: #222; font-family: 'Poppins', sans-serif;">Statistik Penajaan</a></li>
              <li><a href="panduan_penderma.php" style="color: #222; font-family: 'Poppins', sans-serif;">Panduan</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="logout.php" style="color: red; font-family: 'Poppins', sans-serif;">Log Keluar</a></li>
            </ul>
          </li>
        <?php else: ?>
          <li><a href="login_staff.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: bold;">Log Masuk</a></li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>

<!-- Add Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">
