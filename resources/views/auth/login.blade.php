<x-app title="Login">

    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <!-- === === === NAVBAR === === === -->
                <x-navbar></x-navbar>
            </div>
        </div>
        <div class="row align-items-center mt-5 mt-lg-0">
            <div class="col-lg-6">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {!! session('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if (session()->has('loginError'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {!! session('loginError') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <!-- === === === HEADER === === === -->
                <header>
                    <h1 class="mb-5">LOGIN</h1>
                </header>
                <!-- === === === FORM === === === -->
                <form action="/login" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" name="email" value="{{ session('old_email') ?? old('email') }}" class="form-control @error('email') is-invalid @enderror @if(session()->has('loginError')) is-invalid @endif" id="floatingInput" placeholder="Email" required>
                        <label for="floatingInput">Email</label>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        @if( session()->has('loginError') )
                            <div class="invalid-feedback">
                                {{ session('loginError') }}
                            </div>
                        @endif
                      </div>
                    <div class="form-floating mb-5">
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="floatingPassword" placeholder="Password" required>
                        <label for="floatingPassword">Password</label>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-custom">
                </form>
                <p class="mt-5">Don't have an account yet? <a href="/register">Create Account </a></p>
            </div>
        </div>
        
    </div>
    <div class="background-right d-none d-lg-flex">
        <img src="/images/cv-group.jpg" alt="">
    </div>

</x-app>