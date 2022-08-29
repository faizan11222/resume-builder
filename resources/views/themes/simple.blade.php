<div class="cv-container ">
    <div class="header">
        <div class="title">
            <h1 class="name">{{ $name }}</h1>
            <p class="gray-text">{{ $job_title }}</p>
        </div>
        <div class="profile-picture">
            <img src="{{ Storage::url($resume->profile->photo) }}" alt="">
        </div>
        <div class="clear"></div>
    </div>
    
    <div class="left">
        <h2 class="section-title">CONTACT</h2>
        <table style="width: 100%">
            @if ( !empty($email) )
            <tr>
                <td>{{ $email }}</td>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: #6c757d;transform: ;msFilter:;"><path d="M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.7-8 5.334L4 8.7V6.297l8 5.333 8-5.333V8.7z"></path></svg></td>
            </tr>
            @endif

            @if ( !empty($phone) )
            <tr>
                <td>{{ $phone }}</td>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: #6c757d;transform: ;msFilter:;"><path d="m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z"></path></svg></td>
            </tr>
            @endif

            @if ( !empty($address) )
            <tr>
                <td>{{ $address }}</td>
                <td><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: #6c757d;transform: ;msFilter:;"><path d="m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z"></path></svg></td>
            </tr>
            @endif
        </table>

        <div class="about">
            @if ( !empty($profile_desc) )
                <h2 class="section-title">ABOUT ME</h2>
                <p>{{ $profile_desc }}</p>
            @endif
        </div>

        <div class="skills">
            <h2 class="section-title">SKILLS</h2>
            <table style="width: 100%;">
                @foreach ($skills as $skill)
                    <tr>
                        <td>{{ $skill->skill }}</td>
                        <td>{{ $skill->level }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>

    <div class="right">
        <div class="education">
            @if (!$educations->isEmpty())
            <h2 class="section-title">EDUCATION</h2>
                @foreach ($educations as $education)
                <div class="education-item">
                    <p class="date-item">{{ $education->start_date_edu }} - {{ $education->end_date_edu }}</p>
                    <h3 class="title-item">{{ $education->school }}</h3>
                    <p class="desc-item">{{ $education->degree }}</p>
                </div>
                @endforeach
            @endif
        </div>

        <div class="experience">
            <h2 class="section-title">EXPERIENCE</h2>

            @foreach ($experiences as $experience)
            <div class="experience-item">
                <p class="date-item pt-3">{{ $experience->start_date_exp }} - {{ $experience->end_date_exp }}</p>
                <h5 class="title-item">{{ $experience->job }} | {{ $experience->employer }}</h5>
                <p class="desc-item">{{ $experience->experience_desc }}</p>
            </div>
            @endforeach
            
        </div>

    </div>
    <div class="clear"></div>

</div>