<?php
// el archivo autoload inicializa todos lo archivos necesarios para que el framework funcione
include "core/autoload.php";
session_start();
// cargamos el modulo iniciar.
Core::loadModule("blog");

?>