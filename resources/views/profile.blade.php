<x-app>
    {{ $resumes[0]->user->name }}
    <ul>
    @foreach ($resumes as $resume)
        <li>
            <a href="/drafts/{{ $resume->slug }}/edit">{{ $resume->title }}</a>
            <div class="d-block">
            @isset($resume->resume_content)
                <small>{{ $resume->resume_content->job_title }}</small> |
            @endisset
            <small>{{ $resume->user->name }}</small>
            </div>
        </li>
    @endforeach
</ul>
</x-app>