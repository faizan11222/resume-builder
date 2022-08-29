<div class="accordion-item skill-item" data-skillId="{{ $id }}">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-skill-{{ $id }}" aria-expanded="false" >
            {{ $skill }}
        </button>
        <form id="delete-form" action="/skill/{{ $skillId }}/delete" method="POST" onsubmit="return confirm('Anda yakin akan menghapus skill {{ $skill }}');">
            @csrf
            @method('delete')
            <button type="submit" class="delete-btn px-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                    <path d="M4.06 1.26H3.92C3.997 1.26 4.06 1.197 4.06 1.12V1.26H9.38V1.12C9.38 1.197 9.443 1.26 9.52 1.26H9.38V2.52H10.64V1.12C10.64 0.50225 10.1377 0 9.52 0H3.92C3.30225 0 2.8 0.50225 2.8 1.12V2.52H4.06V1.26ZM12.88 2.52H0.56C0.25025 2.52 0 2.77025 0 3.08V3.64C0 3.717 0.063 3.78 0.14 3.78H1.197L1.62925 12.9325C1.65725 13.5293 2.15075 14 2.7475 14H10.6925C11.291 14 11.7828 13.531 11.8108 12.9325L12.243 3.78H13.3C13.377 3.78 13.44 3.717 13.44 3.64V3.08C13.44 2.77025 13.1897 2.52 12.88 2.52ZM10.5577 12.74H2.88225L2.45875 3.78H10.9812L10.5577 12.74Z" fill="#000"/>
                </svg>
            </button>
        </form>
    </h2>
    <div id="collapse-skill-{{ $id }}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="d-lg-flex">
                
                <div class="form-floating mb-3 half-input pe-lg-3">
                    <input form="edit-form" type="text" value="{{ $skill ?? ""}}" name="skill[]" class="form-control" id="floating-skill" placeholder="Skill" required>
                    <label for="floating-skill">Skill</label>
                </div>
                <div class="form-floating mb-3 half-input">
                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[{{ $id }}]" value="expert" id="expert-{{ $id }}" {{ $level == 'expert' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="expert-{{ $id }}">
                            Expert
                        </label>
                    </div>

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[{{ $id }}]" value="specialist" id="specialist-{{ $id }}" {{ $level == 'specialist' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="specialist-{{ $id }}">
                            Specialist
                        </label>
                    </div>

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[{{ $id }}]" value="skilled" id="skilled-{{ $id }}" {{ $level == 'skilled' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="skilled-{{ $id }}">
                            Skilled
                        </label>
                    </div>

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[{{ $id }}]" value="average" id="average-{{ $id }}" {{ $level == 'average' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="average-{{ $id }}">
                            Average
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[{{ $id }}]" value="beginner" id="beginner-{{ $id }}" {{ $level == 'beginner' ? 'checked' : '' }} required>
                        <label class="form-check-label" for="beginner-{{ $id }}">
                            Beginner
                        </label>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>