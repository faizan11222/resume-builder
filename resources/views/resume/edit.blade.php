<x-app>
    @slot('styles')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/style.css">
        <link rel="stylesheet" href="/css/themes/{{ $resume->theme }}.css">
    @endslot
    
    <div class="container-fluid px-lg-5">
        <div class="row">
            <div class="col-lg-6">

                <x-navbar>
                    <div class="d-flex">
                        Hi, {{ explode(" ", Auth::user()->name)[0] }} &#128075;
                    </div>
                </x-navbar>

            </div>
        </div>

        <button class="floating-btn btn-custom d-lg-none">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #ffffff;transform: ;msFilter:;"><path d="M5 5h5V3H3v7h2zm5 14H5v-5H3v7h7zm11-5h-2v5h-5v2h7zm-2-4h2V3h-7v2h5z"></path></svg>
            Preview
        </button>


        <div class="row ">
            <div class="col-lg-6 col-md-10 mx-auto mx-lg-0">
                <a href="/resumes" class="text-decoration-none my-5" style="color: #BDA249;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" style="fill: #BDA249 ;transform: ;msFilter:;"><path d="M12.707 17.293 8.414 13H18v-2H8.414l4.293-4.293-1.414-1.414L4.586 12l6.707 6.707z"></path></svg>
                    Back to Drafts
                </a>
                <div class="d-flex align-items-center mt-4">
                    <label class="input-title">
                        <input class="d-block edit-title"  size="1" id="title" name="title" form="edit-form" type="text" value="{{ $resume->title }}">
                    </label>
                    <label for="title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 16 16" fill="none">
                            <path d="M11.2729 2.98294L13.0172 4.72637L11.2729 2.98294ZM12.3946 1.44704L7.6782 6.16344C7.4345 6.40679 7.2683 6.71684 7.20054 7.05451L6.76489 9.23524L8.94562 8.79876C9.28327 8.73123 9.59292 8.5657 9.83669 8.32193L14.5531 3.60553C14.6948 3.4638 14.8072 3.29555 14.8839 3.11037C14.9607 2.92519 15.0001 2.72672 15.0001 2.52628C15.0001 2.32585 14.9607 2.12738 14.8839 1.9422C14.8072 1.75702 14.6948 1.58877 14.5531 1.44704C14.4114 1.30531 14.2431 1.19288 14.0579 1.11618C13.8728 1.03948 13.6743 1 13.4738 1C13.2734 1 13.0749 1.03948 12.8898 1.11618C12.7046 1.19288 12.5363 1.30531 12.3946 1.44704V1.44704Z" stroke="#BDA249" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M13.3531 10.8823V13.3529C13.3531 13.7898 13.1795 14.2087 12.8706 14.5176C12.5618 14.8265 12.1428 15 11.706 15H2.64708C2.21024 15 1.7913 14.8265 1.48242 14.5176C1.17353 14.2087 1 13.7898 1 13.3529V4.29401C1 3.85718 1.17353 3.43824 1.48242 3.12935C1.7913 2.82047 2.21024 2.64693 2.64708 2.64693H5.11769" stroke="#BDA249" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </label>
                </div>
                <label for=""></label>
                <form id="edit-form" action="/resume/{{ $resume->slug }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                </form>
                <h4 class="mb-4">Profile</h4>
                {{-- Profile --}}
                
                @if( $resume->theme != 'ats' )
                    @if (empty($resume->profile->photo))
                        <div class="mb-3 d-flex pe-lg-3 align-items-center">
                            <label for="photo">
                                <img class="preview-photo " src="/images/default-photo.svg" alt="">
                            </label>
                            <div>

                                <input form="edit-form" class="form-control ms-2 @error('photo') is-invalid @enderror" name="photo" type="file" id="photo" required>
                                @error('photo')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>
                        </div>
                        @else
                        <div class="d-flex align-items-center">
                            <img class="preview-photo mb-3" src="{{ Storage::url($resume->profile->photo) }}" alt="" >
                            <div>
                                <form  action="/photo/{{ $resume->slug }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="delete-draft ps-3 py-1 ">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                                            <path d="M4.06 1.26H3.92C3.997 1.26 4.06 1.197 4.06 1.12V1.26H9.38V1.12C9.38 1.197 9.443 1.26 9.52 1.26H9.38V2.52H10.64V1.12C10.64 0.50225 10.1377 0 9.52 0H3.92C3.30225 0 2.8 0.50225 2.8 1.12V2.52H4.06V1.26ZM12.88 2.52H0.56C0.25025 2.52 0 2.77025 0 3.08V3.64C0 3.717 0.063 3.78 0.14 3.78H1.197L1.62925 12.9325C1.65725 13.5293 2.15075 14 2.7475 14H10.6925C11.291 14 11.7828 13.531 11.8108 12.9325L12.243 3.78H13.3C13.377 3.78 13.44 3.717 13.44 3.64V3.08C13.44 2.77025 13.1897 2.52 12.88 2.52ZM10.5577 12.74H2.88225L2.45875 3.78H10.9812L10.5577 12.74Z" fill="#BDA249"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>

                                <div class="ps-3 py-1 edit-photo-btn">
                                    <label for="photo">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 16 16" fill="none">
                                            <path d="M11.2729 2.98294L13.0172 4.72637L11.2729 2.98294ZM12.3946 1.44704L7.6782 6.16344C7.4345 6.40679 7.2683 6.71684 7.20054 7.05451L6.76489 9.23524L8.94562 8.79876C9.28327 8.73123 9.59292 8.5657 9.83669 8.32193L14.5531 3.60553C14.6948 3.4638 14.8072 3.29555 14.8839 3.11037C14.9607 2.92519 15.0001 2.72672 15.0001 2.52628C15.0001 2.32585 14.9607 2.12738 14.8839 1.9422C14.8072 1.75702 14.6948 1.58877 14.5531 1.44704C14.4114 1.30531 14.2431 1.19288 14.0579 1.11618C13.8728 1.03948 13.6743 1 13.4738 1C13.2734 1 13.0749 1.03948 12.8898 1.11618C12.7046 1.19288 12.5363 1.30531 12.3946 1.44704V1.44704Z" stroke="#BDA249" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M13.3531 10.8823V13.3529C13.3531 13.7898 13.1795 14.2087 12.8706 14.5176C12.5618 14.8265 12.1428 15 11.706 15H2.64708C2.21024 15 1.7913 14.8265 1.48242 14.5176C1.17353 14.2087 1 13.7898 1 13.3529V4.29401C1 3.85718 1.17353 3.43824 1.48242 3.12935C1.7913 2.82047 2.21024 2.64693 2.64708 2.64693H5.11769" stroke="#BDA249" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Edit
                                    </label>
                                    <input form="edit-form" class="edit-photo-input d-none form-control @error('photo') is-invalid @enderror" name="photo" type="file" id="photo">
                                    @error('photo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    <p class="new-filename mt-3"></p>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <div class="d-lg-flex">
                    <div class="form-floating mb-3 half-input pe-lg-3">
                        <input form="edit-form" type="text" name="name" value="{{ $resume->profile->name ?? ""}}" class="form-control" id="floating-name" placeholder="Name" required>
                        <label for="floating-name">Name</label>
                    </div>
                    <div class="form-floating mb-3 half-input">
                        <input form="edit-form" type="text" value="{{ $resume->profile->job_title ?? ""}}" name="job_title" class="form-control" id="floatingjob_title" placeholder="Work" required>
                        <label for="floatingjob_title">Work</label>
                    </div>
                </div>


                <div class="d-lg-flex">
                    <div class="form-floating mb-3 half-input pe-lg-3">
                        <input form="edit-form" type="email" name="email" value="{{ $resume->profile->email ?? ""}}" class="form-control" id="floating-email" placeholder="Email" required>
                        <label for="floating-email">Email</label>
                    </div>
                    <div class="form-floating mb-3 half-input">
                        <input form="edit-form" type="number" value="{{ $resume->profile->phone ?? ""}}" name="phone" class="form-control" id="floating-phone" placeholder="Phone" required>
                        <label for="floating-phone">Phone</label>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input form="edit-form" type="text" value="{{ $resume->profile->address ?? ""}}" name="address" class="form-control" id="floating-address" placeholder="Address" required>
                    <label for="floating-address">Address</label>
                </div>

                @if ($resume->theme != 'ats')
                    <div class="form-floating mb-3">
                        <textarea form="edit-form" name="profile_desc" class="form-control" id="profile_desc" placeholder="Discription" required style="height: 150px">{{ $resume->profile->profile_desc ?? ""}}</textarea>
                        <label for="profile_desc">Description</label>
                    </div>
                @endif
                
                
                {{-- End Profile --}}

                {{-- Education --}}
                <h4 class="mt-5">Education</h4>
                <div class="education p-0">
                    <div class="accordion" id="accordionExample">
                    @if ($resume->educations->isEmpty())

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-static" aria-expanded="false" aria-controls="collapse">
                                    Education
                                    
                                </button>
                            </h2>
                            <div id="collapse-static" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="d-lg-flex">
                                        <div class="form-floating mb-3 half-input pe-lg-3">
                                            <input form="edit-form" type="text" name="school[]" class="form-control" id="floating-school" placeholder="School/Campus" required>
                                            <label for="floating-school">School/Campus</label>
                                        </div>
                                        <div class="form-floating mb-3 half-input">
                                            <input form="edit-form" type="text" name="degree[]" class="form-control" id="floating-degree" placeholder="Degree/Major" required>
                                            <label for="floating-degree">Degree/Major</label>
                                        </div>
                                    </div>
                        
                                    <div class="d-lg-flex">
                                        <div class="mb-3 half-input pe-lg-3">
                                        <label for="start-date-edu-static" class='mb-2'>Year begins</label>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="start-date-edu-static">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                                                </label>
                                                <input form="edit-form" type="text" name="start_date_edu[]" id="start-date-edu-static" class="form-control date-picker" placeholder="Select a Date" required>
                                            </div>
                                        </div>
                        
                                        <div class="mb-3 half-input">
                                        <label for="end-date-edu-static" class='mb-2'>Year End</label>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="end-date-edu-static">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                                                </label>
                                                <input form="edit-form" type="text" name="end_date_edu[]" id="end-date-edu-static" class="form-control date-picker" placeholder="Select a Date" required>
                                            </div>
                                        </div>
                                    </div>
                        
                                </div>
                            </div>
                        </div>

                    @else
                        
                        @foreach ($resume->educations as $education)
                            <x-education>
                                @slot('id', $education->id)
                                @slot('school', $education->school)
                                @slot('degree', $education->degree)
                                @slot('start_date_edu', $education->start_date_edu)
                                @slot('end_date_edu', $education->end_date_edu)
                                @slot('description', $education->education_desc)
                            </x-education>
                        @endforeach
                        
                    @endif
                    </div>
                </div>
                <button type="button" class="btn text-primary d-flex fw-bold align-self-center" id="add-education">
                  
                   Add Education
                </button>
                {{-- End Education --}}

                {{-- Experience --}}
                <h4 class="mt-5">Experience</h4>
                <div class="experience">
                    <div class="accordion" id="accordionExample">

                    @if ($resume->experiences->isEmpty())

                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-exp-static" aria-expanded="false" >
                                    New Experience
                                </button>
                            </h2>
                            <div id="collapse-exp-static" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    <div class="d-lg-flex">
                                        
                                        <div class="form-floating mb-3 half-input pe-lg-3">
                                            <input form="edit-form" type="text" name="employer[]" class="form-control" id="floating-school" placeholder="Office/Company" required>
                                            <label for="floating-school">Office/Company</label>
                                        </div>
                                        <div class="form-floating mb-3 half-input">
                                            <input form="edit-form" type="text" name="job[]" class="form-control" id="floating-degree" placeholder="Work" required>
                                            <label for="floating-degree">Work</label>
                                        </div>
                                    </div>
                        
                                    <div class="d-lg-flex">
                                        <div class="mb-3 half-input pe-lg-3">
                                        <label for="start-date-exp-static" class='mb-2'>Year Begin</label>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="start-date-exp-static">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                                                </label>
                                                <input form="edit-form" type="text" name="start_date_exp[]" id="start-date-exp-static" class="form-control date-picker" placeholder="Select a Date">
                                            </div>
                                        </div>
                        
                                        <div class="mb-3 half-input">
                                        <label for="end-date-exp-static" class='mb-2'>Year End</label>
                                            <div class="input-group mb-3">
                                                <label class="input-group-text" for="end-date-exp-static">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                                                </label>
                                                <input form="edit-form" type="text" name="end_date_exp[]" id="end-date-exp-static" class="form-control date-picker" placeholder="Select a Date">
                                            </div>
                                        </div>
                                    </div>
                        
                                    <div class="form-floating mb-3">
                                        <textarea form="edit-form" name="experience_desc[]" class="form-control" id="floating-description" placeholder="Decription" required style="height: 150px"></textarea>
                                        <label for="floating-description">Decription</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @else

                        @foreach ($resume->experiences as $experience)
                            <x-experience>
                                @slot('id', $experience->id)
                                @slot('employer', $experience->employer)
                                @slot('job', $experience->job)
                                @slot('start_date_exp', $experience->start_date_exp)
                                @slot('end_date_exp', $experience->end_date_exp)
                                @slot('description', $experience->experience_desc)
                            </x-experience>
                        @endforeach

                    @endif
                    </div>
                </div>
                <button type="button" class="btn text-primary d-flex fw-bold align-self-center" id="add-experience">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0d6efd;transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
                    Add Experience
                </button>
                {{-- End Experience --}}

                {{-- Skill --}}
                <h4 class="mt-5">Skills</h4>
                <div class="skill">
                    <div class="accordion" id="accordionExample">
                    
                    @if ($resume->skills->isEmpty())

                    <div class="accordion-item skill-item" data-skillId="0">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-skill-static" aria-expanded="false" >
                               New Skill
                            </button>
                            <button type="button" class="delete-btn px-2 static">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                                    <path d="M4.06 1.26H3.92C3.997 1.26 4.06 1.197 4.06 1.12V1.26H9.38V1.12C9.38 1.197 9.443 1.26 9.52 1.26H9.38V2.52H10.64V1.12C10.64 0.50225 10.1377 0 9.52 0H3.92C3.30225 0 2.8 0.50225 2.8 1.12V2.52H4.06V1.26ZM12.88 2.52H0.56C0.25025 2.52 0 2.77025 0 3.08V3.64C0 3.717 0.063 3.78 0.14 3.78H1.197L1.62925 12.9325C1.65725 13.5293 2.15075 14 2.7475 14H10.6925C11.291 14 11.7828 13.531 11.8108 12.9325L12.243 3.78H13.3C13.377 3.78 13.44 3.717 13.44 3.64V3.08C13.44 2.77025 13.1897 2.52 12.88 2.52ZM10.5577 12.74H2.88225L2.45875 3.78H10.9812L10.5577 12.74Z" fill="#000"/>
                                </svg>
                            </button>
                        </h2>
                        <div id="collapse-skill-static" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="d-lg-flex">
                                    
                                    <div class="form-floating mb-3 half-input pe-lg-3">
                                        <input form="edit-form" type="text" name="skill[]" class="form-control" id="floating-skill" placeholder="Skill" required>
                                        <label for="floating-skill">Skill</label>
                                    </div>
                    
                                    <div class="form-floating mb-3 half-input">
                    
                                        <div class="form-check">
                                            <input form="edit-form" class="form-check-input" type="radio" name="level[0]" value="expert" id="expert-0" required>
                                            <label class="form-check-label" for="expert-0">
                                                Expert
                                            </label>
                                        </div>
                    
                                        <div class="form-check">
                                            <input form="edit-form" class="form-check-input" type="radio" name="level[0]" value="specialist" id="specialist-0" required>
                                            <label class="form-check-label" for="specialist-0">
                                                Specialist
                                            </label>
                                        </div>
                    
                                        <div class="form-check">
                                            <input form="edit-form" class="form-check-input" type="radio" name="level[0]" value="skilled" id="skilled-0" required>
                                            <label class="form-check-label" for="skilled-0">
                                                Skilled
                                            </label>
                                        </div>
                    
                                        <div class="form-check">
                                            <input form="edit-form" class="form-check-input" type="radio" name="level[0]" value="average" id="average-0" required>
                                            <label class="form-check-label" for="average-0">
                                                Average
                                            </label>
                                        </div>
                                        
                                        <div class="form-check">
                                            <input form="edit-form" class="form-check-input" type="radio" name="level[0]" value="beginner" id="beginner-0" required>
                                            <label class="form-check-label" for="beginner-0">
                                                Beginner
                                            </label>
                                        </div>
                    
                                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>

                    @else

                        @foreach ($resume->skills as $key => $skill)
                            <x-skill>
                                @slot('skillId', $skill->id)
                                @slot('id', $key)
                                @slot('skill', $skill->skill)
                                @slot('level', $skill->level)
                            </x-skill>
                        @endforeach

                    @endif
                    </div>
                </div>
                <button type="button" class="btn text-primary d-flex fw-bold align-self-center" id="add-skill">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #0d6efd;transform: ;msFilter:;"><path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"></path></svg>
                  Add Expertise
                </button>
                {{-- End Skill --}}
                <button type="submit" class="btn btn-custom mt-4" form="edit-form">Save</button>
                <div class="py-4 mt-4"></div>
            
            </div>

            {{-- preview --}}
            <div class="col-lg-6 preview">
                <div class="preview-wrapper">

                    <div class="close-preview text-white d-lg-none">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #ffffff;transform: ;msFilter:;"><path d="M21 11H6.414l5.293-5.293-1.414-1.414L2.586 12l7.707 7.707 1.414-1.414L6.414 13H21z"></path></svg>
                        Return
                    </div>

                    {{-- Download button --}}
                    <div class="dropdown mx-auto download-btn">
                        <button class="btn btn-custom-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                            Download
                        </button>
                        <ul class="dropdown-menu">
                            <li class="py-2">
                                <a href="/{{ $resume->slug }}/download" class="dropdown-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" style="fill: #fc2f2f;transform: ;msFilter:;"><path d="M8.267 14.68c-.184 0-.308.018-.372.036v1.178c.076.018.171.023.302.023.479 0 .774-.242.774-.651 0-.366-.254-.586-.704-.586zm3.487.012c-.2 0-.33.018-.407.036v2.61c.077.018.201.018.313.018.817.006 1.349-.444 1.349-1.396.006-.83-.479-1.268-1.255-1.268z"></path><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8l-6-6zM9.498 16.19c-.309.29-.765.42-1.296.42a2.23 2.23 0 0 1-.308-.018v1.426H7v-3.936A7.558 7.558 0 0 1 8.219 14c.557 0 .953.106 1.22.319.254.202.426.533.426.923-.001.392-.131.723-.367.948zm3.807 1.355c-.42.349-1.059.515-1.84.515-.468 0-.799-.03-1.024-.06v-3.917A7.947 7.947 0 0 1 11.66 14c.757 0 1.249.136 1.633.426.415.308.675.799.675 1.504 0 .763-.279 1.29-.663 1.615zM17 14.77h-1.532v.911H16.9v.734h-1.432v1.604h-.906V14.03H17v.74zM14 9h-1V4l5 5h-4z"></path></svg>
                                    Download PDF
                                </a>
                            </li>
                          
                        </ul>
                    </div>
                    
                    @include("themes.$resume->theme", [
                        'photo' => $resume->profile->photo,
                        'name' => $resume->profile->name,
                        'job_title' => $resume->profile->job_title,
                        'profile_desc' => $resume->profile->profile_desc,
                        'address' => $resume->profile->address,
                        'email' => $resume->profile->email,
                        'phone' => $resume->profile->phone,
                        'educations' => $resume->educations,
                        'experiences' => $resume->experiences,
                        'skills' => $resume->skills
                    ])
                    
                </div>
            </div>
            {{-- End preview --}}
        </div>

    </div>
    
    
   @slot('scripts')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/plugins/monthSelect/index.js"></script>
        <script src="/js/main.js"></script>
   @endslot
</x-app>

