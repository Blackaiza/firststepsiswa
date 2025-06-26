<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-default" style="background-color: #ffffff; border-bottom: 2px solid #ddd; padding: 10px 20px;">
  <div class="container-fluid">
    <!-- Logo & Hamburger Button -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-menu">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard_pentadbir.php" style="display: flex; align-items: center; font-family: 'Poppins', sans-serif; font-weight: bold; color: #222;">
        <img src="logo.png" alt="First Step Siswa Logo" style="height: 40px; margin-right: 10px;">
        First Step Siswa
      </a>
    </div>

    <!-- Collapsible Menu -->
    <div class="collapse navbar-collapse" id="navbar-menu">
      <ul class="nav navbar-nav">
        <li>
          <a href="memproses_permohonan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;"
             onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">
            Permohonan Bantuan
          </a>
        </li>
        <li>
          <a href="inventori_bantuan.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;"
             onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">
            Inventori Bantuan
          </a>
        </li>
        <li>
          <a href="daftar_penderma.php" style="color: #222; font-family: 'Poppins', sans-serif; font-weight: 500;"
             onmouseover="this.style.textDecoration='underline'" 
             onmouseout="this.style.textDecoration='none'">
            Daftar Penderma
          </a>
        </li>
      </ul>

      <!-- User Profile on the Right -->
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
              <li><a href="report_berjaya.php" style="color: #222; font-family: 'Poppins', sans-serif;">Analisis Data</a></li>
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

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>