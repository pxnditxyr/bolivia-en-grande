<?php

require_once "../../database/connection.php";
require_once "../../config/config.php";

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
  <title> Contrato de Góndola | Bolivia en Grande </title>
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
    <h1 class="text-5xl text-center text-slate-100 font-bold z-20"> CONTRATO DE SERVICIO DE GÓNDOLA </h1>

    <article class="w-full flex flex-col max-w-4xl p-4 rounded-lg shadow-md gap-12 z-20 mb-12">
      <section class="w-full flex justify-center items-center">
        <div class="bg-[url('<?= ROOT_PATH ?>/assets/images/logo.jpeg')] w-40 h-40 sm:w-48 sm:h-48 bg-cover bg-center bg-no-repeat rounded-full"></div>
      </section>

      <section class="w-full flex flex-col gap-4 items-center">
        <div class="w-full flex flex-col gap-4 justify-center max-w-[600px] bg-white py-4 px-8 rounded-lg border-0">
          <h1 class="text-2xl text-center text-slate-900 font-bold">Servicio de Transporte de Góndola</h1>
          <h2 class="text-xl text-center text-slate-900 font-bold">Contrato de Transporte</h2>
          <p class="text-slate-900 text-pretty">Conste en el presente documento privado, que en caso de incumplimiento será elevado a instrumento público, bajo compromiso de responsabilidad previa de las dos partes abajo firmantes, los que suscriben las siguientes cláusulas:</p>
          <div>
            <p class="text-slate-900 text-pretty">
              <span class="font-bold"> CLAUSULA 1. </span>
              El contratante deberá abonar el 50% del precio fijado al firmar el presente contrato.
            </p>
            <p class="text-slate-900 text-pretty">
              <span class="font-bold"> CLAUSULA 2. </span>
              El saldo deberá ser cancelado en su totalidad antes del transporte solicitado.
            </p>
            <p class="text-slate-900 text-pretty">
              <span class="font-bold"> CLAUSULA 3. </span>
              El transporte realizará su trabajo por la suma de 200 Bs a cuenta 100 Bs. El saldo es 100 Bs.
            </p>
            <p class="text-slate-900 text-pretty">
              <span class="font-bold"> CLAUSULA 4. </span>
              Una vez efectuado el contrato, no se aceptan cambios de fecha, ni devoluciones. Quedando el anticipo para cubrir daños y perjuicios ocasionados al transporte.
            </p>
            <p class="text-slate-900 text-pretty">
              <span class="font-bold"> CLAUSULA 5. </span>
              El contratante se hace responsable de los daños al transporte.
            </p>
            <p
              class="text-slate-900 text-pretty"
            >En señal de conformidad, se firma el presente contrato en la ciudad de La Paz, a los <?= date( 'd' ) ?> días del mes de <?= date( 'F' ) ?> de <?= date( 'Y' ) ?>.</p>
          </div>
          <div class="w-full flex justify-center gap-4 py-4">
            <button
              class="px-4 py-2 bg-lime-400 text-slate-900 rounded-lg"
            >Aceptar</button>
            <button
              class="px-4 py-2 bg-red-500 text-white rounded-lg"
            >Rechazar</button>
          </div>
        </div>
      </section>
    </article>
  </main>
</body>
</html>
