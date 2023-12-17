<?php

use App\Models\UserModel;

$sessionUser = null;
if( array_key_exists('userEmail', $_SESSION) )
{
    $userModel = new UserModel();
    $sessionUser = $userModel->getUserByEmail($_SESSION['userEmail']);
}
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- import bootstrap icons resources -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <!-- import daisyui resources -->
    <!--    <script src=" https://cdn.jsdelivr.net/npm/daisyui@4.4.6/src/index.min.js "></script>-->
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.4.6/dist/full.min.css" rel="stylesheet" type="text/css" />
    <!-- import tailwind resources -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer type="module">
        tailwind.config = {
            theme: {
                extend: {}
            },
        }
    </script>
    <title>MountainCloud Hosting</title>
</head>
<body>

    <header class="fixed top-0 z-50 px-3 py-2 w-full">
        <div class="navbar bg-base-100 rounded-md">
            <div class="navbar-start">
                <div class="dropdown">
                    <label tabindex="0" class="btn btn-ghost lg:hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                    </label>
                    <ul tabindex="0" class="menu menu-lg dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-80">
                        <li><a href="/#offer">L'offre</a></li>
                        <li><a href="/#infrastructure">Infrastructure</a></li>
                        <li><a href="/report-bug">Signaler un bug</a></li>
                        <li><a href="/search">Recherche</a></li>
                        <li><div class="divider"></div></li>
                        <?php if( !$sessionUser ) : ?>
                        <li><a href="/login">Connexion</a></li>
                        <li><a href="/register">Inscription</a></li>
                        <?php else : ?>
                        <li><a href="/account">Mon espace</a></li>
                        <li><a href="/logout">Déconnexion</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
                <a href="/" class="font-bold text-xl ml-2 flex flex-row items-center">
                    <?php include dirname(__DIR__).'/Views/components/logo.php'; ?> <span class="ml-3">MCH</span>
                </a>
            </div>
            <div class="navbar-center hidden lg:flex">
                <nav class="menu menu-horizontal px-1 gap-4">
                    <a href="/#offer">L'offre</a>
                    <a href="/#infrastructure">Infrastructure</a>
                    <a href="/report-bug"><i class="bi bi-bug"></i></a>
                    <a href="/search"><i class="bi bi-search"></i></a>
                </nav>
            </div>
            <div class="hidden lg:flex navbar-end gap-3">
                <?php if( !$sessionUser ) : ?>
                <a href="/login" class="btn btn-neutral">Connexion</a>
                <a href="/register" class="btn btn-neutral">Inscription</a>
                <?php else : ?>
                <a class="btn" href="/account">
                    <i class="bi bi-person-gear text-2xl"></i>
                </a>
                <a href="/logout" class="btn btn-error">Déconnexion</a>
                <?php endif; ?>
            </div>
        </div>
    </header>

    <main class="w-full">
        <?php include_once $view.'View.php'; ?>
    </main>

    <footer class="footer p-10 bg-base-200 text-base-content">
        <aside>
            <?php include dirname(__DIR__).'/Views/components/logo-slate.php'; ?>
            <p>Mountain Cloud Hosting - Hébergement de fichiers depuis quelques jours.</p>
        </aside>
        <nav>
            <header class="footer-title">Services</header>
            <a class="link link-hover">Lobbé</a>
            <a class="link link-hover">Slicé</a>
        </nav>
        <nav>
            <header class="footer-title">Navigation</header>
            <a href="/#offer" class="link link-hover">L'offre</a>
            <a href="/#infrastructure" class="link link-hover">Infrastructure</a>
            <a href="/report-bug" class="link link-hover">Signaler un bug</a>
        </nav>
        <nav>
            <header class="footer-title">Legal</header>
            <a class="link link-hover">Mensions légales</a>
            <a class="link link-hover">Politique de confidentialité</a>
            <a class="link link-hover">Politique de cookies</a>
        </nav>
    </footer>

    <?php if( [] !== $flashbag = \App\Utils\FlashBag::get() ) : ?>
        <div id="flashbag" class="fixed top-32 left-1/4 w-1/4 translate-x-1/2 alert alert-<?= $flashbag['type'] ?> text-center p-4 rounded-md">
            <?php if( $flashbag['type'] === 'success' ) : ?>
                <i class="bi bi-check-circle"></i>
            <?php elseif( $flashbag['type'] === 'warning') : ?>
                <i class="bi bi-exclamation-triangle"></i>
            <?php elseif( $flashbag['type'] === 'error') : ?>
                <i class="bi bi-x-circle"></i>
            <?php elseif( $flashbag['type'] === 'info') : ?>
                <i class="bi bi-info-circle"></i>
            <?php endif; ?>
            <span id="flahsbag_msg"><?= $flashbag['message'] ?></span>
        </div>
    <?php endif; ?>

    <script src="./assets/js/app.js"></script>

</body>
</html>