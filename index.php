<?php

require_once "./database/connection.php";
require_once "./config/config.php";

session_start();

if ( !isset( $_SESSION[ 'customer' ][ 'id' ] ) ) {
  header( 'Location: ' . ROOT_PATH . '/auth/signin' );
  exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Bolivia en Grande </title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
  <main class="min-h-screen w-full bg-slate-100 flex flex-col items-center gap-12">
    <nav class="w-full bg-slate-900 text-white flex justify-between items-center p-4">
      <a href="<?= ROOT_PATH ?>/" class="text-xl font-bold"> Bolivia en Grande </a>
      <div class="flex gap-4">
        <a href="<?= ROOT_PATH ?>/auth/signout" class="hover:underline"> Cerrar Sesión </a>
      </div>
    </nav>
    <h1 class="text-4xl text-center text-slate-900 font-bold"> Bolivia en Grande </h1>
  </main>
</body>
</html>
