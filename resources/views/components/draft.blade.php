<div class="draft">
    <img class="me-3" src="/images/{{ $img }}" alt="">
    <div class="content">
        <h4>{{ $title }}</h4>
        @isset($date)
            <small class="mb-2">Updated {{ $date }}</small>
        @endisset
        @isset($name)
        <small class="mb-2">{{ $name }}</small>
        @endisset
        <ul class="list-unstyled">
            <li class="py-2">
                <a href="/resume/{{ $slug }}/edit" class="text-decoration-none text-black edit-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #BDA249;transform: ;msFilter:;"><path d="M19.045 7.401c.378-.378.586-.88.586-1.414s-.208-1.036-.586-1.414l-1.586-1.586c-.378-.378-.88-.586-1.414-.586s-1.036.208-1.413.585L4 13.585V18h4.413L19.045 7.401zm-3-3 1.587 1.585-1.59 1.584-1.586-1.585 1.589-1.584zM6 16v-1.585l7.04-7.018 1.586 1.586L7.587 16H6zm-2 4h16v2H4z"></path></svg>
                    Edit
                </a>
            </li>
            <li class="py-2">
                <a href="/{{ $slug }}/download" class="text-decoration-none text-black download-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #BDA249;transform: ;msFilter:;"><path d="m12 16 4-5h-3V4h-2v7H8z"></path><path d="M20 18H4v-7H2v7c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2v-7h-2v7z"></path></svg>
                    Download
                </a>
            </li>
            <li class="py-2">
                <!-- Delete Button trigger confirmations modal -->
                <button type="button" class="delete-draft" data-bs-toggle="modal" data-bs-target="#delete-cv-{{ $slug }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #BDA249;transform: ;msFilter:;"><path d="M15 2H9c-1.103 0-2 .897-2 2v2H3v2h2v12c0 1.103.897 2 2 2h10c1.103 0 2-.897 2-2V8h2V6h-4V4c0-1.103-.897-2-2-2zM9 4h6v2H9V4zm8 16H7V8h10v12z"></path></svg>
                Wipe
                </button>

                <!-- Modal -->
                <div class="modal fade cv-confirmation" id="delete-cv-{{ $slug }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header d-block text-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" style="fill: #dc3545;transform: ;msFilter:;"><path d="M9.172 16.242 12 13.414l2.828 2.828 1.414-1.414L13.414 12l2.828-2.828-1.414-1.414L12 10.586 9.172 7.758 7.758 9.172 10.586 12l-2.828 2.828z"></path><path d="M12 22c5.514 0 10-4.486 10-10S17.514 2 12 2 2 6.486 2 12s4.486 10 10 10zm0-18c4.411 0 8 3.589 8 8s-3.589 8-8 8-8-3.589-8-8 3.589-8 8-8z"></path></svg>
                                <h2 class="modal-title" id="exampleModalLabel">Delete CV</h2>
                                <p>You sure want to remove <span class="fw-bold">{{ $title }}</span></p>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-outline-secondary px-4" data-bs-dismiss="modal">Cancel</button>
                                <form action="/resume/{{ $slug }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger px-4">
                                    Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>