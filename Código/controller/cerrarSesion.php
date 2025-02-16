<?php

// Cerramos sesion
session_start();
session_destroy();

header('location: ../index.php');
