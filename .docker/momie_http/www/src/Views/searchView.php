<section class="h-screen flex flex-row justify-center items-center">
    <main>
        <h1 class="text-3xl font-bold mb-4">Vous cherchez quelque chose ?</h1>
        <form action="/search" method="get" class="flex flex-row justify-center items-center join">
            <input type="search" name="search" placeholder="Que cherchez-vous?" class="input input-bordered w-full max-w-xs joint-item rounded-r-none" required>
            <button class="btn btn-primary text-primary hover:text-black join-item" type="submit">Envoyer</button>
        </form>
        <?php if($searchTerm) : ?>
            <div class="my-8">
                <h2 class="text-2xl my-4">Vous avez cherché "<?= $searchTerm ?>":</h2>

                <p>
                    Malheureusement notre système de recherche n'est pas encore connecté à notre contenu mais Bobby est sur le coup !
                </p>
            </div>
        <?php endif; ?>
    </main>
</section>