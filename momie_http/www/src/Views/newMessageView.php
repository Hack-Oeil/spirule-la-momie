
<section class="hero min-h-screen bg-base-200">
    <div class="hero-content w-1/2 lg:flex-row-reverse">
        <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <form class="card-body" action="/new-message" method="post">
                <h2 class="text-2xl">Nouveau message</h2>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Email de l'utilisateur MCH</span>
                    </label>
                    <input type="email" placeholder="email" name="email" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label">
                        <span class="label-text">Votre message</span>
                    </label>
                    <textarea class="textarea textarea-bordered" placeholder="Message..." name="message" required></textarea>
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary">Envoyer</button>
                </div>
            </form>
        </div>
    </div>
</section>