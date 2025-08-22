<section class="h-screen pt-48">
    <h1 class="text-center font-bold text-3xl">Mon compte</h1>
    <p class="text-center my-4">
        Content de vous revoir <?= htmlspecialchars($sessionUser['firstname']) ?> <?= htmlspecialchars($sessionUser['lastname']) ?>
    </p>
    <main role="tablist" class="w-10/12 mx-auto tabs tabs-lifted">
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Profil" checked/>
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
            <h2 class="text-xl font-bold">Vos informations</h2>
            <p class="my-3">
                Prénom: <?= htmlspecialchars($sessionUser['firstname']) ?>
            </p>
            <p class="my-3">
                Nom: <?= htmlspecialchars($sessionUser['lastname']) ?>
            </p>
            <p class="my-3">
                Email: <?= htmlspecialchars($sessionUser['email']) ?>
            </p>
            <p class="my-3">
                Rôle: <?= htmlspecialchars($sessionUser['role']) ?>
            </p>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="FTP" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
            <h2 class="text-xl font-bold">Vos accès FTP</h2>
            <?php if( !$userServer ) : ?>
            <p class="py-4">
                Aucune souscription à l'offre.
            </p>
            <?php else : ?>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>Host</th>
                            <th>Port</th>
                            <th>Nom d'utilisateur</th>
                            <th>Mot de passe</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><?= htmlspecialchars($userServer['host']) ?></td>
                            <td><?= htmlspecialchars($userServer['port']) ?></td>
                            <td><?= strtolower( mb_substr($_SESSION['userFirstname'], 0, 1).$_SESSION['userLastname'] ) ?></td>
                            <td><?= mb_substr(md5( $_SESSION['userEmail'] ), 0, 16) ?></td>
                            <td>
                                <a href="/ftp" target="_blank" class="btn btn-primary">
                                    Espace FTP
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>

        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Messagerie" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
	    <a class="btn btn-primary p-2 my-4" href="/new-message">Nouveau message</a>
            <h2 class="text-xl font-bold">Messages reçus</h2>
            <?php if( !$messages || count($messages) === 0 ) : ?>
                <p class="my-2">
                    Aucun message pour le moment.
                </p>
            <?php else : ?>
                <?php foreach( $messages as $message ) : ?>
                    <div class="flex flex-row items-end mb-2">
                            <div class="m-2">
                                <?= htmlspecialchars($message['senderFirstname']) ?> <?= htmlspecialchars(strtoupper(substr($message['senderLastname'], 0, 1))) ?>.
                            </div>
                            <div class="chat chat-start m-2">
                                <div class="chat-bubble"><?= $message['content'] ?></div>
                            </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if( $sessionUser['role'] === 'admin' ) : ?>
        <input type="radio" name="my_tabs_2" role="tab" class="tab" aria-label="Utilisateurs" />
        <div role="tabpanel" class="tab-content bg-base-100 border-base-300 rounded-box p-6">
            <h2 class="text-xl font-bold">Utilisateurs</h2>
            <?php if( !$users || count($users) === 0 ) : ?>
            <p class="my-2">
                Aucun utilisateurs pour le moment.
            </p>
            <?php else : ?>
                <div class="overflow-x-auto">
                    <table class="table">
                        <!-- head -->
                        <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach( $users as $user ) : ?>
                            <tr>
                                <td><?= htmlspecialchars($user['firstname']) ?></td>
                                <td><?= htmlspecialchars($user['lastname']) ?></td>
                                <td><?= htmlspecialchars($user['email']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </main>

</section>