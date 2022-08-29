<div class="cv-container">
    <div class="cv-wrapper">
        <div class="title">
            <h1>{{ $name }}</h1>
            <p>{{ $job_title }}</p>
        </div>
        <div class="profile">
            @if ( !empty($address) )
            <h2>Personal Data</h2>
            <table>
                <tr>
                    <td>Address: </td>
                    <td>{{ $address }}</td>
                </tr>
                <tr>
                    <td style="padding-right: 14px">Phone: </td>
                    <td>{{ $phone }}</td>
                </tr>
                <tr>
                    <td>Email: </td>
                    <td>{{ $email}} </td>
                </tr>
            </table>
            @endif
        </div>

        <div class="experience">
            @if(!$experiences->isEmpty())
                <h2>Experience</h2>
                @foreach ($experiences as $experience)
                    <div class="experience-item">
                        <table style="width: 100%;">
                            <tr>
                                <td style="font-weight: 600;">{{ $experience->employer }}</td>
                                <td rowspan="2" style="text-align: end;">{{ $experience->start_date_exp }} - {{ $experience->end_date_exp }}</td>
                            </tr>
                            <tr>
                                <td>{{ $experience->job }}</td>
                            </tr>
                        </table>
                        <p>{{ $experience->experience_desc }}</p>
                    </div>
                @endforeach
            @endif
        </div>

        <div class="education">
            @if (!$educations->isEmpty())
            <h2>Education</h2>

            @foreach ($educations as $education)
            <div class="education-item">
                <table style="width: 100%;">
                    <tr>
                        <td style="font-weight: 600;">{{ $education->school }}</td>
                        <td style="text-align: end;">{{ $education->start_date_edu }} - {{ $education->end_date_edu }}</td>
                    </tr>
                </table>
                <p>{{ $education->degree }}</p>
            </div>
            @endforeach
            @endif
        </div>

        <div class="skill">
            @if (!$skills->isEmpty())
            <h2>Skill</h2>

            <table style="width: 300px;">
                @foreach ($skills as $skill)
                <tr>
                    <td>{{ $skill->skill }}</td>
                    <td>{{ $skill->level }}</td>
                </tr>
                @endforeach
            </table>
            @endif
        </div>

    </div>
</div>