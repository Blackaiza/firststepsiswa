<?php
session_start();
include_once 'database.php';
date_default_timezone_set('Asia/Kuala_Lumpur');

// Pastikan pengguna login dan pelajar
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'pelajar') {
    header("Location: login_pelajar.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Dapatkan ID permohonan
if (!isset($_POST['request_id'])) {
    $_SESSION['error_msg'] = "Permohonan tidak sah.";
    header("Location: lihat_permohonan.php");
    exit();
}

$request_id = $_POST['request_id'];

// Dapatkan input
$name = $_POST['fld_name'];
$matric_no = $_POST['fld_matric_no'];
$phone = $_POST['fld_phone'];
$email = $_POST['fld_email'];
$category = $_POST['fld_category'];

// Dapatkan fail sedia ada dari DB
$stmt = $conn->prepare("SELECT fld_income_slip, fld_supporting_doc FROM tbl_requests WHERE fld_request_id = ? AND fld_user_id = ?");
$stmt->bind_param("ii", $request_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error_msg'] = "Permohonan tidak dijumpai.";
    header("Location: lihat_permohonan.php");
    exit();
}

$row = $result->fetch_assoc();
$income_slip = $row['fld_income_slip'];
$supporting_doc = $row['fld_supporting_doc'];

// Jika pelajar upload semula fail
if (!empty($_FILES['fld_income_slip']['name'])) {
    $income_slip = 'uploads/income_slip/' . basename($_FILES['fld_income_slip']['name']);
    move_uploaded_file($_FILES['fld_income_slip']['tmp_name'], $income_slip);
}
if (!empty($_FILES['fld_supporting_doc']['name'])) {
    $supporting_doc = 'uploads/support_doc/' . basename($_FILES['fld_supporting_doc']['name']);
    move_uploaded_file($_FILES['fld_supporting_doc']['tmp_name'], $supporting_doc);
}

// Reset status dan rejection date, dan kemaskini maklumat
$edit_deadline = (new DateTime())->modify('+7 days')->format('Y-m-d');

$update = $conn->prepare("UPDATE tbl_requests SET 
    fld_name = ?, fld_matric_no = ?, fld_phone = ?, fld_email = ?, fld_category = ?,
    fld_income_slip = ?, fld_supporting_doc = ?, 
    fld_status = 'sedang diproses', fld_rejection_date = NULL, fld_edit_dateline = ?
    WHERE fld_request_id = ? AND fld_user_id = ?");

$update->bind_param("ssssssssii", $name, $matric_no, $phone, $email, $category,
    $income_slip, $supporting_doc, $edit_deadline, $request_id, $user_id);

if ($update->execute()) {
    $_SESSION['success_msg'] = "Permohonan anda telah dihantar semula dan sedang diproses semula.";
    header("Location: lihat_permohonan.php");
    exit();
} else {
    $_SESSION['error_msg'] = "Ralat semasa mengemaskini permohonan: " . $update->error;
    header("Location: edit_permohonan.php?id=" . $request_id);
    exit();
}
?>
