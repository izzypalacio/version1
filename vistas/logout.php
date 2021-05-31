<?php

 require_once("../modelos/conexion.php");

 session_destroy();

  header("Location:".Conectar::ruta()."index.php");
  exit();
