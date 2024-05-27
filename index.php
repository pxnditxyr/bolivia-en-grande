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
  <main class="min-h-screen w-full flex flex-col items-center gap-12 bg-[url('<?= ROOT_PATH ?>/assets/images/bg-home.jpeg')] bg-cover bg-center bg-no-repeat relative">
    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50 z-0"></div>
    <nav class="w-full bg-slate-900 text-white flex justify-between items-center p-4 z-20">
      <a href="<?= ROOT_PATH ?>/" class="text-xl font-bold"> Bolivia en Grande </a>
      <div class="flex gap-4">
        <a href="<?= ROOT_PATH ?>/auth/signout" class="hover:underline"> Cerrar Sesión </a>
      </div>
    </nav>
    <h1 class="text-5xl text-center text-slate-100 font-bold z-20"> BOLIVIA EN GRANDE </h1>

    <article class="w-full flex flex-col max-w-4xl p-4 rounded-lg shadow-md gap-12 z-20 mb-12">
      <section class="w-full flex justify-center items-center">
        <div class="bg-[url('<?= ROOT_PATH ?>/assets/images/logo.jpeg')] w-40 h-40 sm:w-60 sm:h-60 bg-cover bg-center bg-no-repeat rounded-full"></div>
      </section>

      <section class="w-full flex flex-col gap-4 items-center relative px-12 mt-24 lg:mt-0">
        <div class="bg-[url('<?= ROOT_PATH ?>/assets/images/car-draw.jpeg')] w-[320px] h-[260px] md:w-[500px] md:h-[410px] bg-cover bg-center bg-no-repeat rounded-lg relative mt-12 transform scale-x-[-1]">
            <div class="
              px-24 py-16 md:py-20 absolute top-0 left-0 transform lg:-translate-x-1/2 -translate-y-[70%] lg:-translate-y-1/2 rounded-full bg-[url('https://s3-us-west-2.amazonaws.com/s.cdpn.io/4273/electric.svg')] bg-center bg-no-repeat bg-contain
              ">
            <p class="text-slate-900 font-semibold text-sm md:text-lg text-pretty relative -left-12 md:-left-14 md:-top-4 -top-4 transform scale-x-[-1] lg:px-12">
              ¡Muchas felicidades! Te registraste con éxito.
              por favor, verifica tu correo electrónico, se te ha enviado un correo de confirmación
              de creación de cuenta.
            </p>
          </div>
        </div>
        
      </section>

    </article>

  </main>
</body>
</html>
