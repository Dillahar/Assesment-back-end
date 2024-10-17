@push('styles')
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            background: #000428;
            background: -webkit-linear-gradient(to right, #004e92, #000428);
            background: linear-gradient(to right, #004e92, #000428);
            background-repeat: no-repeat;
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endpush
<main class="main-content main-content-bg mt-0">
    <section class="min-vh-75">
        <a href="{{ route('home') }}">
            <img src="{{asset('img/logo/skillage-3d-logo.png')}}" alt="Logo" class="mt-4 ms-4"style="max-height: 65px;">
        </a>
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-7 mx-auto">
                    <div class="card z-index-0 mt-7 mb-4">
                        <div class="card-header text-center pt-4 pb-1">
                            <h4 class="font-weight-bolder mb-1">
                                Login to your account
                            </h4>
                        </div>
                        <div class="card-body">
                            <form wire:submit="login">
                                <x-forms.alert />
                                <x-forms.input label="Your Email" field="email" type="email" placeholder="Email"
                                    class="mb-4" />

                                <div class="mb-3">
                                    <div class="justify-content-between" style="display: flex;">
                                        <label for="password">Password</label>
                                        <a href="{{ route('forgot-password') }}" class="text-info-light">
                                            Forgot Password ?
                                        </a>
                                    </div>
                                    <input id="password" type="password" name="password" class="form-control"
                                        placeholder="Password" wire:model='password'>
                                    <x-forms.error field="password" />
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-blue btn-lg w-100 my-4 mb-2">Login</button>
                                </div>
                                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                                    <p class="mb-4 text-sm mx-auto">


                                    </p>
                                    <p class="text-sm mt-3 mb-0">Don't have an account ? <a
                                            href="{{ route('register') }}"
                                            class="font-weight-bolder text-info-light">Registration</a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
