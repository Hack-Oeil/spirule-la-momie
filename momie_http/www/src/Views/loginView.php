<section class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <h1 class="text-center font-bold text-3xl mt-5">Connexion</h1>
            <form id="login_form" class="card-body" action="/login" method="post">
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" placeholder="email" id="email" name="email" class="input input-bordered"  />
                </div>
                <div class="form-control">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="password" id="password" name="password" class="input input-bordered"  />
                    <label class="label">
                        <a class="label-text-alt link link-hover">Mot de passe oublié? Pas de chance !</a>
                    </label>
                </div>
                <div class="form-control mt-6">
                    <button id="submit_login" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>