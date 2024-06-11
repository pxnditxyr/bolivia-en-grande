<?php

require_once "../../database/connection.php";
require_once "../../config/config.php";

session_start();

if ( isset( $_SESSION[ 'customer' ][ 'id' ] ) ) {
  header( 'Location: ' . ROOT_PATH . '/' );
  exit;
}

$errorMessage = '';

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
  $email = $_POST[ 'email' ] ?? '';
  $password = $_POST[ 'password' ] ?? '';

  if ( $email === '' ) {
    $errorMessage .= 'El correo electrónico es requerido. <br />';
  }

  if ( $password === '' ) {
    $errorMessage .= 'La contraseña es requerida. <br />';
  }

  if ( !isset( $_POST[ 'captcha' ] ) || $_POST[ 'captcha' ] === '' || !isset( $_SESSION[ 'captcha' ] ) ) {
    $errorMessage .= 'El código de verificación es requerido. <br />';
  } else {
    if ( $_SESSION[ 'captcha' ] !== sha1( $_POST[ 'captcha' ] ) )
      $errorMessage .= 'El código de verificación es incorrecto. <br />';
    else
      unset( $_SESSION[ 'captcha' ] );
  }

  if ( !$errorMessage ) {
    try {
      $pdo = DatabaseConnection::getPDOConnection();
      $query = $pdo->prepare( 'SELECT * FROM customers WHERE email = :email' );
      $query->execute([
        'email' => strtolower( $email ),
      ]);

      $customer = $query->fetch();

      if ( !$customer ) {
        $errorMessage .= 'El correo electrónico o la contraseña son incorrectos.';
      } else {
        if ( password_verify( $password, $customer[ 'password' ] ) ) {
          $_SESSION[ 'customer' ] = [
            'id' => $customer[ 'id' ],
            'email' => $customer[ 'email' ],
            'name' => $customer[ 'name' ],
            'lastname' => $customer[ 'lastname' ],
          ];

          $name = $customer[ 'name' ];
          $lastname = $customer[ 'lastname' ];

          $link = LINK . '/contracts/matrimonial/?type=decorations';

          $htmlBody = "
          <DOCTYPE html>
          <html>
          <head>
            <title> Bienvenido a Bolivia en Grande </title>
          </head>
          <body>
            <article style='width: 100%; height: 100vh; background-color: #f3f4f6;'>
            <section style='width: 100%; max-width: 500px; background-color: #fff; border-radius: 10px; padding: 20px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
            <h1 style='font-size: 2rem; color: #333; text-align: center; margin-bottom: 20px;'> Bienvenido a BOLIVIA EN GRANDE $name $lastname </h1>
            <img
              src='https://i.imgur.com/qSCgpvp.png'
              alt='Bolivia en Grande'
              style='width: 150px; height: 150px; border-radius: 50%; margin: 0 auto 20px auto; display: block;'
            />
            <p style='color: #333; text-align: center; margin-bottom:20px; font-size:1.5rem;'> Gracias por ingresar en nuestra plataforma. </p>
            <p style='color: #333; text-align: center; margin-bottom:20px; font-size:1.5rem'> Por favor completa el contrato para la finalización de tu reserva. </p>
            <a
              href='$link'
              target='_blank'
              style='display: block; width: 100%; padding: 12px 8px; background-color: #a3e635; color: #0f172a; text-align: center; text-decoration: none; border-radius: 8px;'
            > Completar Contrato </a>
            </section>
            </article>
          </body>
          </html>
          ";

          $data = [
            'to' => $email,
            'subject' => 'Bienvenido a Bolivia en Grande',
            'htmlBody' => $htmlBody,
          ];

          $curlHandle = curl_init( MAIL_URI );

          curl_setopt( $curlHandle, CURLOPT_POST, true );
          curl_setopt( $curlHandle, CURLOPT_POSTFIELDS, http_build_query( $data ) );
          curl_setopt( $curlHandle, CURLOPT_RETURNTRANSFER, true );
          $response = curl_exec( $curlHandle );

          curl_close( $curlHandle );

          header( 'Location: ' . ROOT_PATH . '/' );
        } else {
          $errorMessage .= 'El correo electrónico o la contraseña son incorrectos.';
        }
      }
    } catch ( PDOException $e ) {
      $errorMessage = 'Ocurrió un error al intentar iniciar sesión.';
      $errorMessage .= '<br />' . $e->getMessage();
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Iniciar Sesión | Bolivia en Grande </title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <main class="w-full bg-slate-100 min-h-screen flex flex-col items-center relative bg-[url('<?= ROOT_PATH ?>/assets/images/bg-auth.jpeg')] bg-cover bg-center bg-no-repeat">

    <div class="absolute inset-0 bg-slate-900 opacity-60 z-0"></div>

    <div class="w-full flex flex-col items-center z-10 gap-8 border-0">
      <div class="bg-slate-900 text-white text-center p-4 w-full">
        "Bolivia en Grande" es una plataforma que te permite conocer los lugares más hermosos de Bolivia.
      </div>  

      <div class="bg-[url('<?= ROOT_PATH ?>/assets/images/logo.jpeg')] w-40 h-40 bg-cover bg-center bg-no-repeat rounded-full"></div>

      <div class="flex justify-center items-center bg-white bg-opacity-40 p-5 z-10 sm:min-w-[400px] rounded-xl border-0">
        <form action="index.php" method="POST" class="w-full flex flex-col gap-8 px-4">
          <h1 class="text-4xl text-center text-slate-900 font-bold mb-4"> Iniciar Sesión </h1>
          <div class="flex flex-col gap-2">
            <label
              for="email"
              class="text-slate-900 font-bold text-lg"
            > Correo Electrónico </label>
            <input
              type="email"
              name="email"
              id="email"
              class="text-lg font-semibold w-full p-2 rounded bg-transparent border-b-2 border-slate-900 focus:outline-none focus:border-lime-500"
              value="<?= $email ?? '' ?>"
            >
          </div>
          <div class="flex flex-col gap-2">
            <label
              for="password"
              class="text-slate-900 font-bold text-lg"
            > Contraseña </label>
            <input
              type="password"
              name="password"
              id="password"
              class="text-lg font-semibold w-full p-2 rounded bg-transparent border-b-2 border-slate-900 focus:outline-none focus:border-lime-500"
              value="<?= $password ?? '' ?>"
            >
          </div>

          <div class="flex flex-col gap-2 items-center">
            <label
              for="captcha"
              class="text-slate-900 font-bold text-lg w-full"
            > Codigo de Verificación </label>
            <div class="flex flex-col items-center gap-2 sm:flex-row">
              <img
                src="<?= ROOT_PATH ?>/captcha/captcha.php"
                alt="Captcha"
                class="w-[200px] h-[70px] rounded-lg"
                id="captcha-image"
              />

              <button
                type="button"
                class="text-slate-900 font-bold text-lg bg-lime-400 p-2 rounded-md w-12 h-12"
                id="refresh-captcha"
              >
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000" height="100%" width="100%" version="1.1" id="Capa_1" viewBox="0 0 489.533 489.533" xml:space="preserve">
                  <g>
                    <path d="M268.175,488.161c98.2-11,176.9-89.5,188.1-187.7c14.7-128.4-85.1-237.7-210.2-239.1v-57.6c0-3.2-4-4.9-6.7-2.9   l-118.6,87.1c-2,1.5-2,4.4,0,5.9l118.6,87.1c2.7,2,6.7,0.2,6.7-2.9v-57.5c87.9,1.4,158.3,76.2,152.3,165.6   c-5.1,76.9-67.8,139.3-144.7,144.2c-81.5,5.2-150.8-53-163.2-130c-2.3-14.3-14.8-24.7-29.2-24.7c-17.9,0-31.9,15.9-29.1,33.6   C49.575,418.961,150.875,501.261,268.175,488.161z"/>
                  </g>
                </svg>
              </button>
            </div>
            <input
              type="text"
              name="captcha"
              id="captcha"
              class="text-lg font-semibold w-full p-2 rounded bg-transparent border-b-2 border-slate-900 focus:outline-none focus:border-lime-500 placeholder-slate-700"
              placeholder="Ingresa el código de verificación"
            >
          </div>

          <?php if ( $errorMessage ): ?>
          <p class="text-pretty rounded p-2 bg-red-300 text-red-500 font-bold"> <?= $errorMessage; ?> </p>
          <?php endif; ?>

          <div class="flex flex-col gap-4">
            <button type="submit" class="w-full p-2 bg-lime-400 text-slate-900 font-bold rounded-md"> Iniciar Sesión </button>
          </div>
          <div class="mb-4">
            <a
              href="<?php echo ROOT_PATH; ?>/auth/signup"
              class="text-blue-800 font-bold hover:underline"
            > ¿No tienes una cuenta? Regístrate </a>
          </div>
        </form>
      </div>
    </div>
  </main>
<script>
const refreshCaptcha = document.getElementById( 'refresh-captcha' );

refreshCaptcha.addEventListener( 'click', () => {
  const captchaImage = document.getElementById( 'captcha-image' );
  captchaImage.src = '<?= ROOT_PATH ?>/captcha/captcha.php';
});
</script>
</body>
</html>
