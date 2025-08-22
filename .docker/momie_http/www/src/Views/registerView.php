<section class="hero min-h-screen bg-base-200">
    <div class="hero-content flex-col lg:flex-row-reverse">
        <div class="card shrink-0 w-full max-w-sm shadow-2xl bg-base-100">
            <h1 class="text-center font-bold text-3xl mt-5">Inscription</h1>
            <form class="card-body" action="/register" method="POST">
                <div class="form-control">
                    <label class="label" for="firstname">
                        <span class="label-text">Prénom</span>
                    </label>
                    <input type="text" placeholder="prénom" name="firstname" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label" for="lastname">
                        <span class="label-text">Nom</span>
                    </label>
                    <input type="text" placeholder="nom" name="lastname" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label" for="email">
                        <span class="label-text">Email</span>
                    </label>
                    <input type="email" placeholder="email" name="email" class="input input-bordered" required />
                </div>
                <div class="form-control">
                    <label class="label" for="password">
                        <span class="label-text">Password</span>
                    </label>
                    <input type="password" placeholder="password" name="password" class="input input-bordered" required />
                </div>
                <div class="form-control mt-6">
                    <button class="btn btn-primary text-primary hover:text-black" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
</section>