<section class="h-screen flex flex-row justify-center items-center">
    <main>
        <h1 class="text-3xl font-bold">On a fait une bêtise quelque part ?</h1>
        <p class="my-4">
            Envoyez nous l'URL de notre page défectueuse, un technicien vérifiera !
        </p>
        <form action="/report-bug" method="post" class="join">
            <input type="url" placeholder="http://localhost" name="url" class="input input-bordered w-full max-w-xs joint-item rounded-r-none" required />
            <button class="btn btn-primary text-primary hover:text-black join-item" type="submit">Envoyer</button>
        </form>
    </main>
</section>