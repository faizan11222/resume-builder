
const addEducationBtn = document.getElementById('add-education');
const addExperienceBtn = document.getElementById('add-experience');
const addSkillBtn = document.getElementById('add-skill');
const educationWrapper = document.querySelector('.education .accordion');
const experienceWrapper = document.querySelector('.experience .accordion');
const skillWrapper = document.querySelector('.skill .accordion');
const inputTitle = document.querySelector('.input-title input');
const deleteBtn = document.querySelectorAll('.delete-btn.static');
const floatingBtn = document.querySelector('.floating-btn');
const closePreview = document.querySelector('.close-preview');
initFlatPicker();
// Auto-Growing Inputs
inputTitle.parentNode.dataset.value = inputTitle.value;
inputTitle.addEventListener('input', function(){
    this.parentNode.dataset.value = this.value;
})

floatingBtn.addEventListener('click', ()=> {
    document.querySelector('.preview').classList.add('show')
});

closePreview.addEventListener('click', ()=> {
    document.querySelector('.preview').classList.remove('show')
});

// delete data static
document.addEventListener('click', function(e){
    if(e.target.classList.contains('delete-btn') && e.target.classList.contains('static')){
        e.target.parentNode.parentNode.remove()
    }
})


// Add education item
let i = 1;
addEducationBtn.addEventListener('click', function(){
    educationWrapper.insertAdjacentHTML( 'beforeend', educationItemComp(i++) );
    initFlatPicker();
})

//  Add experience item
let j = 1;
addExperienceBtn.addEventListener('click', function(){
    experienceWrapper.insertAdjacentHTML( 'beforeend', experienceItemComp(j++) );
    initFlatPicker();
})

//  Add skill item
addSkillBtn.addEventListener('click', function(){
    let skillItem = document.querySelectorAll('.accordion-item.skill-item')
    console.log(skillItem);
    let lastId = skillItem.length;
    skillWrapper.insertAdjacentHTML( 'beforeend', skillItemComp(lastId) );
    
})

// display filename when edit profile pic
document.querySelector(".edit-photo-input").onchange = function(){
    document.querySelector(".new-filename").textContent = "File akan diubah ke : " + this.files[0].name;
}

function initFlatPicker(){
    flatpickr(".date-picker", {
                
        plugins: [
            new monthSelectPlugin({
            shorthand: true, 
            dateFormat: "M Y",
            altFormat: "F Y",
            theme: "dark" //
            })
        ],
    });
}

function educationItemComp(i){
    return `<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-js-${i}" aria-expanded="false" aria-controls="collapse">
          New Education
        </button>
        <button type="button" class="delete-btn px-2 static">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                <path d="M4.06 1.26H3.92C3.997 1.26 4.06 1.197 4.06 1.12V1.26H9.38V1.12C9.38 1.197 9.443 1.26 9.52 1.26H9.38V2.52H10.64V1.12C10.64 0.50225 10.1377 0 9.52 0H3.92C3.30225 0 2.8 0.50225 2.8 1.12V2.52H4.06V1.26ZM12.88 2.52H0.56C0.25025 2.52 0 2.77025 0 3.08V3.64C0 3.717 0.063 3.78 0.14 3.78H1.197L1.62925 12.9325C1.65725 13.5293 2.15075 14 2.7475 14H10.6925C11.291 14 11.7828 13.531 11.8108 12.9325L12.243 3.78H13.3C13.377 3.78 13.44 3.717 13.44 3.64V3.08C13.44 2.77025 13.1897 2.52 12.88 2.52ZM10.5577 12.74H2.88225L2.45875 3.78H10.9812L10.5577 12.74Z" fill="#000"/>
            </svg>
        </button>
    </h2>
    <div id="collapse-js-${i}" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                <label for="start-date-edu-js-${i}" class='mb-2'>Year Begin</label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="start-date-edu-js-${i}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                        </label>
                        <input form="edit-form" type="text" name="start_date_edu[]" id="start-date-edu-js-${i}" class="form-control date-picker" placeholder="Select a Date">
                    </div>
                </div>

                <div class="mb-3 half-input">
                <label for="end-date-edu-js-${i}" class='mb-2'>Year End</label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="end-date-edu-js-${i}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                        </label>
                        <input form="edit-form" type="text" name="end_date_edu[]" id="end-date-edu-js-${i}" class="form-control date-picker" placeholder="Select a Date">
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>`
}

function experienceItemComp(j){
    return `<div class="accordion-item">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-js-${j}" aria-expanded="false" >
            New Expirence
        </button>
        <button type="button" class="delete-btn px-2 static">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                <path d="M4.06 1.26H3.92C3.997 1.26 4.06 1.197 4.06 1.12V1.26H9.38V1.12C9.38 1.197 9.443 1.26 9.52 1.26H9.38V2.52H10.64V1.12C10.64 0.50225 10.1377 0 9.52 0H3.92C3.30225 0 2.8 0.50225 2.8 1.12V2.52H4.06V1.26ZM12.88 2.52H0.56C0.25025 2.52 0 2.77025 0 3.08V3.64C0 3.717 0.063 3.78 0.14 3.78H1.197L1.62925 12.9325C1.65725 13.5293 2.15075 14 2.7475 14H10.6925C11.291 14 11.7828 13.531 11.8108 12.9325L12.243 3.78H13.3C13.377 3.78 13.44 3.717 13.44 3.64V3.08C13.44 2.77025 13.1897 2.52 12.88 2.52ZM10.5577 12.74H2.88225L2.45875 3.78H10.9812L10.5577 12.74Z" fill="#000"/>
            </svg>
        </button>
    </h2>
    <div id="collapse-js-${j}" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
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
                <label for="start-date-exp-js-${i}" class='mb-2'>Year Begin</label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="start-date-exp-js-${i}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                        </label>
                        <input form="edit-form" type="text" name="start_date_exp[]" id="start-date-exp-js-${i}" class="form-control date-picker" placeholder="Select a Date">
                    </div>
                </div>

                <div class="mb-3 half-input">
                <label for="end-date-exp-js-${i}" class='mb-2'>Year End</label>
                    <div class="input-group mb-3">
                        <label class="input-group-text" for="end-date-exp-js-${i}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" style="fill: rgba(0, 0, 0, 1);transform: ;msFilter:;"><path d="M7 11h2v2H7zm0 4h2v2H7zm4-4h2v2h-2zm0 4h2v2h-2zm4-4h2v2h-2zm0 4h2v2h-2z"></path><path d="M5 22h14c1.103 0 2-.897 2-2V6c0-1.103-.897-2-2-2h-2V2h-2v2H9V2H7v2H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2zM19 8l.001 12H5V8h14z"></path></svg>
                        </label>
                        <input form="edit-form" type="text" name="end_date_exp[]" id="end-date-exp-js-${i}" class="form-control date-picker" placeholder="Select a Date">
                    </div>
                </div>
            </div>

            <div class="form-floating mb-3">
                <textarea form="edit-form" name="experience_desc[]" class="form-control" id="floating-description" placeholder="Decription" required style="height: 150px"></textarea>
                <label for="floating-description">Decription</label>
            </div>
        </div>
    </div>
</div>`
}

function skillItemComp(skillId){
    return `<div class="accordion-item skill-item" data-skillId="${skillId}">
    <h2 class="accordion-header" id="headingTwo">
        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-js-${skillId}" aria-expanded="false" >
          New Skill
        </button>
        <button type="button" class="delete-btn px-2 static">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 14 14" fill="none">
                <path d="M4.06 1.26H3.92C3.997 1.26 4.06 1.197 4.06 1.12V1.26H9.38V1.12C9.38 1.197 9.443 1.26 9.52 1.26H9.38V2.52H10.64V1.12C10.64 0.50225 10.1377 0 9.52 0H3.92C3.30225 0 2.8 0.50225 2.8 1.12V2.52H4.06V1.26ZM12.88 2.52H0.56C0.25025 2.52 0 2.77025 0 3.08V3.64C0 3.717 0.063 3.78 0.14 3.78H1.197L1.62925 12.9325C1.65725 13.5293 2.15075 14 2.7475 14H10.6925C11.291 14 11.7828 13.531 11.8108 12.9325L12.243 3.78H13.3C13.377 3.78 13.44 3.717 13.44 3.64V3.08C13.44 2.77025 13.1897 2.52 12.88 2.52ZM10.5577 12.74H2.88225L2.45875 3.78H10.9812L10.5577 12.74Z" fill="#000"/>
            </svg>
        </button>
    </h2>
    <div id="collapse-js-${skillId}" class="accordion-collapse collapse show" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="d-lg-flex">
                
                <div class="form-floating mb-3 half-input pe-lg-3">
                    <input form="edit-form" type="text" name="skill[]" class="form-control" id="floating-skill" placeholder="Skill" required>
                    <label for="floating-skill">Skill</label>
                </div>

                <div class="form-floating mb-3 half-input">

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[${skillId}]" value="expert" id="expert-${skillId}">
                        <label class="form-check-label" for="expert-${skillId}">
                            Expert
                        </label>
                    </div>

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[${skillId}]" value="specialist" id="specialist-${skillId}">
                        <label class="form-check-label" for="specialist-${skillId}">
                            Specialist
                        </label>
                    </div>

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[${skillId}]" value="skilled" id="skilled-${skillId}">
                        <label class="form-check-label" for="skilled-${skillId}">
                            Skilled
                        </label>
                    </div>

                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[${skillId}]" value="average" id="average-${skillId}">
                        <label class="form-check-label" for="average-${skillId}">
                            Average
                        </label>
                    </div>
                    
                    <div class="form-check">
                        <input form="edit-form" class="form-check-input" type="radio" name="level[${skillId}]" value="beginner" id="beginner-${skillId}">
                        <label class="form-check-label" for="beginner-${skillId}">
                            Beginner
                        </label>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>`
}