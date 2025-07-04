<?php
session_start();
date_default_timezone_set('Asia/Kuala_Lumpur');

include_once 'database.php'; // Database connection

// Ensure only admin can access the page
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'pentadbir') {
    header("Location: login_staff.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    // Get the donations and quantities
    $bantuanList = $_POST['bantuan'];
    $kuantitiList = $_POST['kuantiti'];

    // Validate input lengths and formats
    if (strlen($name) < 3 || strlen($name) > 100) {
        $_SESSION['error'] = "Nama organisasi mestilah antara 3 hingga 100 aksara.";
        echo "<script>window.location.href = 'daftar_penderma.php';</script>";
        exit();
    }

    if (strlen($username) < 4 || strlen($username) > 20 || !preg_match("/^[a-zA-Z0-9_]+$/", $username)) {
        $_SESSION['error'] = "Nama pengguna mestilah antara 4 hingga 20 aksara dan hanya boleh mengandungi huruf, nombor, dan garis bawah (_).";
        echo "<script>window.location.href = 'daftar_penderma.php';</script>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Sila masukkan e-mel yang sah.";
        echo "<script>window.location.href = 'daftar_penderma.php';</script>";
        exit();
    }

    if ($password !== $confirm) {
        $_SESSION['error'] = "Kata laluan tidak sepadan!";
        echo "<script>window.location.href = 'daftar_penderma.php';</script>";
        exit();
    }

    // Check if the username or email already exists in the database
    $checkUnique = $conn->prepare("SELECT COUNT(*) FROM tbl_users WHERE fld_username = ? OR fld_email = ?");
    $checkUnique->bind_param("ss", $username, $email);
    $checkUnique->execute();
    $checkUniqueResult = $checkUnique->get_result();
    $row = $checkUniqueResult->fetch_row();

    if ($row[0] > 0) {
        $_SESSION['error'] = "Nama pengguna atau e-mel telah didaftarkan.";
        echo "<script>window.location.href = 'daftar_penderma.php';</script>";
        exit();
    }

    // Insert into tbl_users (donor account)
    $insertUser = $conn->prepare("INSERT INTO tbl_users (fld_name, fld_username, fld_email, fld_phone, fld_password, fld_role) 
                                  VALUES (?, ?, ?, ?, ?, 'penderma')");
    $insertUser->bind_param("sssss", $name, $username, $email, $phone, $password);

    if ($insertUser->execute()) {
        $newUserId = $insertUser->insert_id;

        // Insert donations into tbl_donations
        $stmtDonation = $conn->prepare("INSERT INTO tbl_donations (fld_donor_id, fld_category, fld_quantity, fld_created_at) 
                                        VALUES (?, ?, ?, NOW())");

        // Loop through the donations and insert them
        for ($i = 0; $i < count($bantuanList); $i++) {
            $category = $bantuanList[$i];
            $qty = (int)$kuantitiList[$i];

            // Sanitize inputs for donations
            $stmtDonation->bind_param("isi", $newUserId, $category, $qty);
            if (!$stmtDonation->execute()) {
                $_SESSION['error'] = "Ralat semasa menambah bantuan!";
                echo "<script>window.location.href = 'daftar_penderma.php';</script>";
                exit();
            }

            // Check if the donation category exists in the inventory
            $checkInventoryStmt = $conn->prepare("SELECT fld_quantity FROM tbl_inventory WHERE fld_category = ?");
            $checkInventoryStmt->bind_param("s", $category);
            $checkInventoryStmt->execute();
            $checkInventoryStmt->store_result();

            if ($checkInventoryStmt->num_rows > 0) {
                // If item exists, update quantity, donor, and timestamp
                $updateInventoryStmt = $conn->prepare("
                    UPDATE tbl_inventory 
                    SET fld_quantity = fld_quantity + ?, fld_donor_id = ?, fld_last_updated = NOW() 
                    WHERE fld_category = ?
                ");
                $updateInventoryStmt->bind_param("iis", $qty, $newUserId, $category);
                $updateInventoryStmt->execute();

            } else {
                // If item doesn't exist, insert a new entry into inventory
                $insertInventoryStmt = $conn->prepare("INSERT INTO tbl_inventory (fld_category, fld_quantity, fld_donor_id, fld_last_updated) 
                                                      VALUES (?, ?, ?, NOW())");
                $insertInventoryStmt->bind_param("sis", $category, $qty, $newUserId);
                $insertInventoryStmt->execute();
            }
        }

        // Success message after donor registration and donation insertion
        echo "<script>alert('Pendaftaran berjaya! Penajaan baru telah ditambah dan inventori dikemaskini.'); window.location.href='daftar_penderma.php';</script>";
    } else {
        // Error message if user registration fails
        $_SESSION['error'] = "Ralat semasa mendaftar penderma!";
        echo "<script>window.location.href = 'daftar_penderma.php';</script>";
    }
}
?>
