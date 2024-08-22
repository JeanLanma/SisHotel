<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recurso no encontrado</title>
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicons/favicon-16x16.png">
    <link rel="manifest" href="/favicons/site.webmanifest">
    <link rel="mask-icon" href="/favicons/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/favicons/favicon.ico">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="msapplication-config" content="/favicons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <!-- Favicons -->
<style>
.flex {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 90vh;
  min-height: 90vh;
  width: 100%;
}

.card {
  width: 320px;
  padding: 30px;
  background: #fff;
  border: 8px solid #000;
  box-shadow: 15px 15px 0 #000;
  transform: rotate(-2deg);
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
}
.card:active {
  animation: shake 0.5s ease-in-out;
}
.card:hover {
  transform: rotate(0deg) scale(1.02);
  box-shadow: 20px 20px 0 #000;
}
.banner {
  position: absolute;
  top: 3px;
  right: -95px;
  background: #000;
  color: #fff;
  padding: 15px;
  width: 350px;
  text-align: center;
  transform: rotate(45deg);
  font-weight: bold;
  font-size: 18px;
  letter-spacing: 2px;
  overflow: hidden;
  transition: background 0.5s ease;
}
.banner-text {
  display: inline-block;
  transition: opacity 0.5s ease, transform 0.5s ease;
  width: 100%;
  position: absolute;
  left: 13%;
  top: 50%;
  transform: translateY(-50%);
}
.banner:hover .banner-text:first-child {
  opacity: 0;
  transform: translateY(-100%);
}
.banner:hover .banner-text:last-child {
  opacity: 1;
  transform: translateY(-40%);
}
.banner-text:last-child {
  opacity: 0;
  transform: translateY(60%);
}
.banner:hover {
  background: red;
}
.card__title {
  font-size: 24px;
  font-weight: 700;
  color: #000;
  text-transform: uppercase;
  margin-bottom: 10px;
  display: block;
  border-bottom: 2px solid #000;
  width: 50%; /* or any other percentage or pixel value */
}
.card__subtitle {
  font-size: 16px;
  line-height: 1.4;
  color: #333;
  margin-bottom: 20px;
  padding-bottom: 10px;
}
.card__form {
  display: flex;
  flex-direction: column;
  gap: 20px;
}
.card__form input {
  padding: 12px;
  border: 4px solid #000;
  font-size: 16px;
  font-family: "Proxima Nova", sans-serif;
  transition: all 0.3s ease;
  background-color: #fff;
}
.card__form input:focus {
  outline: none;
  transform: scale(1.05);
}
.sign-up {
  border: 4px solid #000;
  background: #000;
  color: #fff;
  padding: 12px;
  font-size: 18px;
  font-weight: bold;
  text-transform: uppercase;
  cursor: pointer;
  transition: all 0.3s ease;
}
.sign-up:hover {
  background: #fff;
  color: #000;
  transform: translateY(-5px);
  box-shadow: 0 5px 0 #000;
}
.sign-up:active {
  animation: shake 0.5s ease-in-out;
  transform: translateY(0);
  box-shadow: none;
}
@keyframes shake {
  0% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-5px);
  }
  50% {
    transform: translateX(5px);
  }
  75% {
    transform: translateX(-5px);
  }
  100% {
    transform: translateX(0);
  }
}
</style>
</head>
<bodyc class="flex">
    <div class="card">
    <div class="banner">
        <span class="banner-text">Nada por aqui</span>
        <span class="banner-text">404</span>
    </div>
    <span class="card__title">404</span>
    <p class="card__subtitle">El recurso que buscabas o pagina a la que ingresaste no esta aqui.
        Si crees que esto es un error, por favor envia un correo a .</p>
    </p>
    <form class="card__form">
        <input placeholder="Su asunto" type="text" required="" />
        <a class="sign-up" href="{{route('admin.support.send')}}">
            Contactar
        </a>
    </form>
    </div>
</body>
</html>