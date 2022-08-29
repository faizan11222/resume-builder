<x-app>
    @slot('styles')
        <link rel="stylesheet" href="/css/glide.min.css">
        <link rel="stylesheet" href="/css/index.css">
    @endslot
    <div class="container">
        <div class="row ">
            <div class="col-lg-6 col-md-10 mx-auto mx-lg-0">
                <!-- === === === NAVBAR === === === -->
                <x-navbar>
                    @auth
                        <div class="dropdown">
                            <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Halo {{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <form action="/logout" method="POST">
                                    @csrf
                                    <button type="submit" class="btn dropdown-item" >
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M16 13v-2H7V8l-5 4 5 4v-3z"></path><path d="M20 3h-9c-1.103 0-2 .897-2 2v4h2V5h9v14h-9v-4H9v4c0 1.103.897 2 2 2h9c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2z"></path></svg>
                                        Logout
                                    </button>
                                </form>
                            </ul>
                        </div>
                    @else
                        <a href="/login">LOGIN</a>
                    @endauth
                </x-navbar>
            </div>
        </div>
        <div class="row ">
            <div class="col-lg-6 col-md-10 mx-auto mx-lg-0">
                <!-- === === === HEADER === === === -->
                <header>
                    <h1>Create A Professional CV Quickly And Easily!</h1>
                    <p class="mt-3 mb-5">No need to be confused anymore if you need a CV to apply for a job, With our online CV maker, anyone can create a professional CV easily and quickly.</p>
                    <a href="/resumes" class="btn btn-custom mb-4">Create a CV</a>
                </header>
                <!-- === === === STEPS === === === -->
               

            </div>

            
        
        </div>
    </div>
    <div class="background-right d-none d-lg-block"></div>

    @slot('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script src="/js/glide.min.js"></script>
        <script src="/js/glide_instance.js"></script>
    @endslot
</x-app>