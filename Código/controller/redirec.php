<?php

session_start();

if (isset($_SESSION['id_user'])) {
  header('location: ../view/index.php');
} else {
  header('location: ../index.php');
}
