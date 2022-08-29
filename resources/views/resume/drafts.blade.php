<x-app>
    @slot('styles')
        <link rel="stylesheet" href="/css/drafts.css">
    @endslot
    <div class="container" style="min-height: 90vh">
        <div class="row">
            <div class="col">
                <x-navbar>
                    <div class="d-flex">
                        @auth
                            <div class="dropdown">
                                <button class="btn  dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                    Hello {{ auth()->user()->name }}
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
                    </div>
                </x-navbar>
            </div>

        </div>

        <div class="d-flex justify-content-between align-items-center border-bottom border-3 pb-4 mb-3">
            <h1>Drafts</h1>

            <!-- Button trigger modal -->
            <button type="button" class="btn btn-custom px-3 py-2 modal-btn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fff;transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
               Create a new CV
            </button>
        </div>
        <div class="row">
            @if ($drafts->isEmpty())
                
                <div class="col-lg-4">
                    <div class="widget-create-cv" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <div class="centered text-center">
                            <img src="/images/cv-add.svg" class="mb-2" alt="">
                            <p>Create a new CV</p>
                        </div>

                    </div>
                </div>
            
            @else

                @foreach ($drafts as $draft)
                <div class="col-lg-4 col-md-6">
                    <x-draft>
                        @slot('img', $draft->img)
                        {{-- @slot('id', $draft->user->id) --}}
                        @slot('title', $draft->title)
                        @slot('date', $draft->updated_at->diffForHumans())
                        @slot('slug', $draft->slug)
                    </x-draft>
                </div>
                @endforeach
                
            @endif
            

        </div>
    </div>
   

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Create a new CV</h5>
                </div>
                <div class="modal-body">
                    <form action="/create/resume" method="POST">
                        @csrf

                        <div class="form-floating mb-3 col-md-8 col-lg-6 mx-auto">
                            <input type="text" name="title" class="form-control" id="floating-title" placeholder="Resume Title" required>
                            <label for="floating-title">Resume Title</label>
                        </div>
                        <h3 class="text-center my-2">Choose a Theme</h3>
                        {{-- Choose Theme --}}
                        <div class="d-flex">
                            <label class="text-center col-4 px-2">
                                Modern Profesional
                                <input type="radio" name="theme" value="modern" required>
                                <img class="mt-2 w-100 shadow" src="/images/modern.jpg" alt="">
                            </label>
                            <label class="text-center col-4 px-2">
                                Simple Clean
                                <input type="radio" name="theme" value="simple" checked="true" checked>
                                <img class="mt-2 w-100 shadow" src="/images/simple.jpg" alt="">
                            </label>
                            <label class="text-center col-4 px-2">
                                ATS Friendly
                                <input type="radio" name="theme" value="ats">
                                <img class="mt-2 w-100 shadow" src="/images/ats.jpg" alt="">
                            </label>

                        </div>
                        {{-- End Choose Theme --}}
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-custom-secondary px-4">Create New</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    @slot('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
    @endslot
</x-app>

