<section class="pt-48">
    <h1 class="text-center font-bold text-3xl">MCH - FTP</h1>
</section>
<?php if( !$_SESSION || !array_key_exists('MCH-FTP-GRANTED', $_SESSION) ) : ?>
    <section class="w-10/12 mx-auto">
        <form id="ftp_login_form" class="card-body flex flex-row flex-wrap mx-auto" action="/ftp" method="post">
            <div class="form-control w-1/5">
                <label class="label" for="ftp_host">
                    <span class="label-text">Hôte</span>
                </label>
                <input type="text" placeholder="hôte" id="ftp_host" name="ftp_host" class="input input-bordered"  />
            </div>
            <div class="form-control">
                <label class="label" for="ftp_port">
                    <span class="label-text">Port</span>
                </label>
                <input type="text" placeholder="port" id="ftp_port" name="ftp_port" class="input input-bordered"  />
            </div>
            <div class="form-control">
                <label class="label" for="ftp_user">
                    <span class="label-text">Utilisateur</span>
                </label>
                <input type="password" placeholder="utilisateur" id="ftp_user" name="ftp_user" class="input input-bordered"  />
            </div>
            <div class="form-control">
                <label class="label" for="ftp_password">
                    <span class="label-text">Mot de passe</span>
                </label>
                <input type="password" placeholder="mot de passe" id="ftp_password" name="ftp_password" class="input input-bordered"  />
            </div>
            <div class="form-control mt-6 self-end">
                <button id="submit_login" class="btn btn-primary">connexion</button>
            </div>
        </form>
    </section>
<?php else : ?>
<section class="w-10/12 mx-auto">
    <h2 class="text-2xl w-full">Vos documents</h2>
    <aside>
        <button class="btn btn-success m-2">
            <i class="bi bi-folder"></i>
            Ajouter un dossier
        </button>
        <button class="btn btn-success m-2">
            <i class="bi bi-file-earmark"></i>
            Ajouter un fichier
        </button>
        <div class="badge badge-error badge-outline m-2">Les fonctionnalités d'ajout sont momentanément HS, mais Bobby est sur le coup !</div>
    </aside>
    <main class="my-4">
        <?php if( !$items ) : ?>
        <p>Aucun documents pour le moment.</p>
        <?php else : ?>
        <ul class="w-1/3 menu menu-xs bg-base-200 rounded-lg max-w-xs w-full">
            <?php foreach($items as $item) : ?>
                <li>
                    <details open>
                        <summary>
                            <i class="bi bi-folder"></i>
                            /
                        </summary>
                        <ul>
                            <li>
                                <a href="/download?file=<?= $item['name'] ?>">
                                    <i class="bi bi-file-earmark-zip"></i>
                                    <?= $item['name'] ?>
                                </a>
                            </li>
                        </ul>
                    </details>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php endif; ?>
    </main>
</section>
<?php endif; ?>
