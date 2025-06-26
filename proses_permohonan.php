<?php

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();
include_once 'database.php';
date_default_timezone_set('Asia/Kuala_Lumpur');

// Check login & role
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'pelajar') {
    header("Location: login_pelajar.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (isset($_POST['save_draft'])) {
    if (!isset($_SESSION['draft'])) {
        $_SESSION['draft'] = [];
    }

    $_SESSION['draft']['fld_name'] = $_POST['fld_name'];
    $_SESSION['draft']['fld_matric_no'] = $_POST['fld_matric_no'];
    $_SESSION['draft']['fld_phone'] = $_POST['fld_phone'];
    $_SESSION['draft']['fld_email'] = $_POST['fld_email'];
    $_SESSION['draft']['fld_category'] = $_POST['fld_category'];

    if (!empty($_FILES['fld_income_slip']['name'])) {
        $filename = 'uploads/income_slip/' . basename($_FILES['fld_income_slip']['name']);
        move_uploaded_file($_FILES['fld_income_slip']['tmp_name'], $filename);
        $_SESSION['draft']['fld_income_slip'] = $filename;
    } elseif (!empty($_SESSION['draft']['fld_income_slip'])) {
        $_SESSION['draft']['fld_income_slip'] = $_SESSION['draft']['fld_income_slip'];
    }

    if (!empty($_FILES['fld_supporting_doc']['name'])) {
        $filename = 'uploads/support_doc/' . basename($_FILES['fld_supporting_doc']['name']);
        move_uploaded_file($_FILES['fld_supporting_doc']['tmp_name'], $filename);
        $_SESSION['draft']['fld_supporting_doc'] = $filename;
    } elseif (!empty($_SESSION['draft']['fld_supporting_doc'])) {
        $_SESSION['draft']['fld_supporting_doc'] = $_SESSION['draft']['fld_supporting_doc'];
    }

    $_SESSION['success_msg'] = "Draf anda telah disimpan.";
    header("Location: borang_permohonan.php");
    exit();
}

// Check for existing request (LIMIT 1 permohonan per student)
$check = $conn->prepare("SELECT COUNT(*) FROM tbl_requests WHERE fld_user_id = ?");
$check->bind_param("i", $user_id);
$check->execute();
$check->bind_result($count);
$check->fetch();
$check->close();

if ($count > 0) {
    $_SESSION['error_msg'] = "Anda telah menghantar permohonan. Permohonan hanya dibenarkan sekali sahaja.";
    header("Location: borang_permohonan.php");
    exit();
}

// Proceed to insert new application
$name = $_POST['fld_name'];
$matric_no = $_POST['fld_matric_no'];
$phone = $_POST['fld_phone'];
$email = $_POST['fld_email'];
$category = $_POST['fld_category'];

// File upload logic
$income_slip = $_SESSION['draft']['fld_income_slip'] ?? '';
$supporting_doc = $_SESSION['draft']['fld_supporting_doc'] ?? '';

if (!empty($_FILES['fld_income_slip']['name'])) {
    $income_slip_dir = 'uploads/income_slip/';
    if (!is_dir($income_slip_dir)) {
        mkdir($income_slip_dir, 0777, true);
    }
    $income_slip = $income_slip_dir . basename($_FILES['fld_income_slip']['name']);
    move_uploaded_file($_FILES['fld_income_slip']['tmp_name'], $income_slip);
}

if (!empty($_FILES['fld_supporting_doc']['name'])) {
    $support_doc_dir = 'uploads/support_doc/';
    if (!is_dir($support_doc_dir)) {
        mkdir($support_doc_dir, 0777, true);
    }
    $supporting_doc = $support_doc_dir . basename($_FILES['fld_supporting_doc']['name']);
    move_uploaded_file($_FILES['fld_supporting_doc']['tmp_name'], $supporting_doc);
}

// Set edit dateline (7 days from now)
$edit_deadline = (new DateTime())->modify('+7 days')->format('Y-m-d');

// Insert into tbl_requests
$query = "INSERT INTO tbl_requests (
    fld_user_id, fld_name, fld_matric_no, fld_phone, fld_email,
    fld_category, fld_income_slip, fld_supporting_doc, fld_status, fld_edit_dateline
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'sedang diproses', ?)";

$stmt = $conn->prepare($query);
$stmt->bind_param("issssssss", $user_id, $name, $matric_no, $phone, $email, $category, $income_slip, $supporting_doc, $edit_deadline);

if ($stmt->execute()) {
    unset($_SESSION['draft']); // clear draft

    // 🎉 Hantar Emel Ucapan Tahniah
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nabilaha645@gmail.com'; // Ganti dengan emel penghantar
        $mail->Password   = 'xcjm jowg hxmw nfhm';   // Guna app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        $mail->setFrom('a193792@siswa.ukm.edu.my', 'First Step Siswa Support');
        $mail->addAddress($email, $name); // Emel pelajar

        $mail->isHTML(true);
        $mail->Subject = 'Tahniah! Permohonan Anda Telah Dihantar';
        $mail->Body    = "
            <h2>Tahniah $name!</h2>
            <p>Permohonan bantuan anda telah berjaya dihantar pada <strong>" . date('d/m/Y') . "</strong>.</p>
            <p>Status permohonan anda kini: <b>Sedang Diproses</b>.</p>
            <p>Sila semak status permohonan dari semasa ke semasa dalam sistem First Step Siswa.</p>
            <br><p>Terima kasih,<br>First Step Siswa</p>
        ";
        $mail->AltBody = 'Permohonan anda telah dihantar. Sila semak status di sistem.';

        $mail->send();
        // Jika nak log: error_log("Emel berjaya dihantar.");
    } catch (Exception $e) {
        error_log("Emel tidak dapat dihantar. Ralat: {$mail->ErrorInfo}");
    }

    $_SESSION['success_msg'] = "Permohonan berjaya dihantar!";
    header("Location: permohonan_berjaya.php");
    exit();

} else {
    $_SESSION['error_msg'] = "Ralat semasa menghantar permohonan: " . $stmt->error;
    header("Location: borang_permohonan.php");
    exit();
}
?>
