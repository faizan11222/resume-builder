<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\Models\Profile;
use App\Models\User;
use App\Models\Education;
use App\Models\Experience;
use App\Models\Skill;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    // View Draft resumes
    public function index(){
        $id = Auth::user()->id;
        $drafts = User::find($id)->resumes;
        
        return view('resume.drafts', ['drafts' => $drafts]);
    }

    // View Edit resume
    public function edit(Resume $resume){
        if(Auth::user()->email !== 'admin@gmail.com'){
            $this->authorize('update', $resume);
        }
        
        return view('resume.edit', ['resume' => $resume]);
    }
    
    // store data to table resumes
    public function store(Request $request){
        $resume = Resume::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'theme' => $request->theme,
            'img' => $request->theme . '.jpg',
            'slug' => uniqid(),
        ]);

        Profile::create([
            'resume_id' => $resume->id,
            'name' => Auth::user()->name,
            'photo' => null
        ]);
        
        return redirect("/resume/{$resume->slug}/edit");
    }


    public function update(Request $request, Resume $resume){

        if(Auth::user()->email !== 'admin@gmail.com'){
            $this->authorize('update', $resume);
        }
        
        
        // Validate image
        $request->validate([
            'photo' => 'image|mimes:png,jpeg,jpg,svg|max:2048'
            ]);

            $photo = $request->file('photo');
            if($photo){
            Storage::delete($resume->profile->photo); // delete image recently
            $photoUrl = $photo->store('public/photos'); // update new image
        } else {
            $photoUrl = $resume->profile->photo;
        }

        
        $educations = [];
        $education_id = [];
        $last_education_id = Education::latest('id')->first()->id ?? 0; // Get last education id

        $experiences = [];
        $experience_id = [];
        $last_experience_id = Experience::latest('id')->first()->id ?? 0; // Get last experiences id
        
        $skills = [];
        $skill_id = [];
        $last_skill_id = Skill::latest('id')->first()->id ?? 0; // Get last skill id

        $resume->update(['title' => $request->title]); // Update resume title
        
        //Update profile section
        $resume->profile->update([
            'name' => $request->name,
            'job_title' => $request->job_title,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'profile_desc' => $request->profile_desc,
            'photo' => $photoUrl,
            ]);

            // get all education id then insert to education_id[]
        foreach($resume->educations as $education){
            array_push($education_id, $education->id);
        }

        // get all experience id then insert to experience_id[]
        foreach($resume->experiences as $experience){
            array_push($experience_id, $experience->id);
        }
        
        // get all skill id then insert to skill_id[]
        foreach($resume->skills as $skill){
            array_push($skill_id, $skill->id);
        }
        
        if( empty(!$request->school) ){
            // Looping all education request then insert to $educations[]
            for( $i = 0; $i < count($request->school); $i++ ){
                array_push($educations,
                [
                    'id' => $education_id[$i] ?? ++$last_education_id,
                    'resume_id' => $resume->id,
                    'school' => $request->school[$i],
                    'degree' => $request->degree[$i],
                    'start_date_edu' => $request->start_date_edu[$i],
                    'end_date_edu' => $request->end_date_edu[$i],
                    ]
                );
            }
            
            // Update or Insert to Table Education
            Education::upsert($educations, 'id', ['school', 'degree', 'start_date_edu', 'end_date_edu']);
        }
        
        if( empty(!$request->job) ){
            // Looping all experience request then insert to $experiences[]
            for( $i = 0; $i < count($request->job); $i++ ){
                array_push($experiences,
                [
                    'id' => $experience_id[$i] ?? ++$last_experience_id,
                    'resume_id' => $resume->id,
                    'job' => $request->job[$i],
                    'employer' => $request->employer[$i],
                    'start_date_exp' => $request->start_date_exp[$i],
                    'end_date_exp' => $request->end_date_exp[$i],
                    'experience_desc' => $request->experience_desc[$i],
                    ]
                );
            }


            // Update or Insert to Table Experience
            Experience::upsert($experiences, 'id', ['job', 'employer', 'start_date_exp', 'end_date_exp', 'experience_desc']);

        }
        
        if( empty(!$request->skill) ){
            // Looping all skill request then insert to $skills[]
            for( $i = 0; $i < count($request->skill); $i++ ){
                array_push($skills,
                [
                    'id' => $skill_id[$i] ?? ++$last_skill_id,
                    'resume_id' => $resume->id,
                    'skill' => $request->skill[$i],
                    'level' => $request->level[$i],
                ]
                );
                
            }
    
            // Update or Insert to Table skills
            Skill::upsert($skills, 'id', ['skill', 'level']);
        }

        // update timestap updated_at in table resumes
        $resume->touch();
        return back();
    }

    public function destroy(Resume $resume){
        if(Auth::user()->email !== 'admin@gmail.com'){
            $this->authorize('update', $resume);
        }
        
        Storage::delete($resume->profile->photo);
        Education::where('resume_id', $resume->id)->delete();
        Profile::where('resume_id', $resume->id)->delete();
        Experience::where('resume_id', $resume->id)->delete();
        Skill::where('resume_id', $resume->id)->delete();
        $resume->delete();

        return back();
    }

    public function deletePhoto(Resume $resume){
        Storage::delete($resume->profile->photo);
        $resume->profile->update([
            'photo' => null
        ]);
        return back();
    }
    

}
