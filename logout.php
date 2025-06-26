<?php
session_start();
include('database.php'); // Pastikan fail ini ada sambungan PDO

// Default redirection
$redirect = 'login.php';

if (isset($_SESSION['user_role']) && isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Update redirect destination
    switch ($_SESSION['user_role']) {
        case 'pelajar':
            $redirect = 'login_pelajar.php';
            break;
        case 'pentadbir':
        case 'penderma':
            $redirect = 'login_staff.php';
            break;
    }

    // Padam session_id dalam DB
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username_db, $password_db);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE tbl_users SET fld_session_id = NULL WHERE fld_username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
    } catch (PDOException $e) {
        // Optional: log error
    }
}

// Destroy session after clearing from DB
session_unset();
session_destroy();

header("Location: $redirect");
exit();
