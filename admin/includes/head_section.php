<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Averia+Serif+Libre|Noto+Serif|Tangerine" rel="stylesheet">
<!-- Font awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
<!-- ckeditor -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ckeditor/4.8.0/ckeditor.js"></script>
<!-- Styling for public area -->
<link rel="stylesheet" href="../static/css/admin_styling.css">

<link rel="stylesheet" href="../static/css/bootstrap-5.1.3-dist/css/bootstrap.css">
<?php
// redirect user to login page if they're not logged in
if (empty($_SESSION['user']['id'])) {
    header('location: ../login.php');
}
?>