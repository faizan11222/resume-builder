<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resume;
use App\View\Components\simple;
use Illuminate\Support\Facades\Storage;
use Mpdf;

class DownloadController extends Controller
{

    public function pdf(Resume $resume){
        
        $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
        $fontDirs = $defaultConfig['fontDir'];

        $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
        $fontData = $defaultFontConfig['fontdata'];
        
        $mpdf = new \Mpdf\Mpdf([
            'mode' => '',
            'format' => 'A4',
            'default_font_size' => 0,
            'default_font' => '',
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
            'margin_header' => 0,
            'margin_footer' => 0,
            'orientation' => 'P',
            'fontDir' => array_merge($fontDirs, [
                public_path('fonts'),
            ]),
            'fontdata' => $fontData + [
                'poppins' => [
                    'R' => 'Poppins-Regular.ttf',
                    'B' => 'Poppins-Bold.ttf',
                ]
            ],
            'default_font' => 'poppins'
        
        ]);

        // check theme
        if( $resume->theme == 'modern' ){
            $html_element = $this->modernTheme($resume);
        }
        else if( $resume->theme == 'simple' ){  
            $html_element = $this->simpleTheme($resume);
        }
        else if( $resume->theme == 'ats' ){
            $html_element = $this->atsTheme($resume);
        }

        $mpdf->WriteHTML($html_element);
        $mpdf->Output("$resume->title.pdf", "D");
    }

    // ATS Theme
    public function atsTheme($resume){

        $education_element = "";
        foreach($resume->educations as $education){
            $education_element .= "
            <div class='education-item'>
                <table style='width: 100%;'>
                    <tr>
                        <td style='font-weight: 600;'>$education->school</td>
                        <td style='text-align: end;'>$education->start_date_edu - $education->end_date_edu</td>
                    </tr>
                </table>
                <p>$education->degree</p>
            </div>";
        }

        $experience_element = "";
        foreach($resume->experiences as $experience){
            $experience_element .= "
            <div class='experience-item'>
                <table style='width: 100%;'>
                    <tr>
                        <td style='font-weight: 600;'>$experience->employer</td>
                        <td rowspan='2' style='text-align: end;'>$experience->start_date_exp - $experience->end_date_exp</td>
                    </tr>
                    <tr>
                        <td>$experience->job</td>
                    </tr>
                </table>
                <p>$experience->experience_desc</p>
            </div>";
        }

        $skill_element = "";
        foreach($resume->skills as $skill){
            $skill_element .= "
            <tr>
                <td>$skill->skill</td>
                <td>$skill->level</td>
            </tr>";
        }

        $css_url =  public_path('css/themes/ats.css');
        return "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <link href='$css_url' rel='stylesheet' type='text/css' />
        </head>
        <body>
            <div class='cv-container print'>
                <div class='cv-wrapper'>
                    <div class='title'>
                        <h1>{$resume->profile->name}</h1>
                        <p>{$resume->profile->job_title}</p>
                    </div>
                    <div class='profile'>
                        <h2>Personal Data</h2>
                        <table style='width: 250px;'>
                            <tr>
                                <td>Address: </td>
                                <td>{$resume->profile->address}</td>
                            </tr>
                            <tr>
                                <td>Phone: </td>
                                <td>{$resume->profile->phone}</td>
                            </tr>
                            <tr>
                                <td>Email: </td>
                                <td>{$resume->profile->email} </td>
                            </tr>
                        </table>
                    </div>
            
                    <div class='experience'>
                        <h2>Experience</h2>
                        $experience_element
                    </div>
            
                    <div class='education'>
                        <h2>Education</h2>
                        $education_element
                    </div>
            
                    <div class='skill'>
                        <h2>SKILL</h2>
                        <table>
                        $skill_element
                        </table>
                        
                    </div>
            
                </div>
            </div>
        </body>
        </html>
        ";
    }

    // Modern professional theme
    public function modernTheme($resume)
    {
        $education_element = "";
        foreach($resume->educations as $education){
            $education_element .= "
            <div class='education-item'>
                <p class='date-item'>$education->start_date_edu - $education->end_date_edu</p>
                <h5 class='title-item'>$education->school</h5>
                <p class='desc-item'>$education->degree</p>
            </div>";
        }

        $experience_element = "";
        foreach($resume->experiences as $experience){
            $experience_element .= "<div class='experience-item'>
                <p class='date-item'>$experience->start_date_exp - $experience->end_date_exp</p>
                <h5 class='title-item'>$experience->job | $experience->employer</h5>
                <p class='desc-item'>$experience->experience_desc</p>
            </div>";
        }

        $skill_element = "";
        foreach($resume->skills as $skill){
            $skill_element .= "
            <tr>
                <td>{$skill->skill}</td>
                <td style='color: #6c757d'>{$skill->level}</td>
            </tr>";
        }

        $image_url = public_path(Storage::url($resume->profile->photo));
        $css_url =  public_path('css/themes/modern.css');

        return "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <link href='$css_url' rel='stylesheet' type='text/css' />
            </head>
            <body>
                <div class='cv-container print'>
                <div class='cv-left'>
                    <div class='cv-header'>
                        <div class='profile-pic' style='background-image: url($image_url);'></div>
                        <h1 class='mb-5'>{$resume->profile->name}</h1>
                        <p>{$resume->profile->job_title}</p>
                    </div>
                    <div class='section-wrapper profile'>
                        <h2>PROFILE</h2>
                        <p>{$resume->profile->profile_desc}</p>
                    </div>
                    
                    <table>
                        <tr>
                            <td style='padding: 4px 6px 4px 0;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' style='fill: rgba(0, 0, 0, 1);transform: ;msFilter:;'><path d='m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z'></path></svg>
                            </td>
                            <td>
                                {$resume->profile->address}
                            </td>
                        </tr>

                        <tr>
                            <td style='padding: 4px 6px 4px 0;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' style='fill: rgba(0, 0, 0, 1);transform: ;msFilter:;'><path d='M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.7-8 5.334L4 8.7V6.297l8 5.333 8-5.333V8.7z'></path></svg>
                            </td>
                            <td>
                                {$resume->profile->email}
                            </td>
                        </tr>

                        <tr>
                            <td style='padding: 4px 6px 4px 0;'>
                                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' viewBox='0 0 24 24' style='fill: rgba(0, 0, 0, 1);transform: ;msFilter:;'><path d='m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z'></path></svg>
                            </td>
                            <td>
                                {$resume->profile->phone}
                            </td>
                        </tr>
                    </table>
                </div>
                <div class='cv-right print'>
                    <div class='section-wrapper education'>
                        <h2>EDUCATION</h2>
                        $education_element
                    </div>
            
                    <div class='section-wrapper'>
                        <h2>EXPERIENCE</h2>
                        $experience_element
                    </div>

                    <div class='section-wrapper'>
                        <h2>SKILLS</h2>
                        <table style='width: 100%'>
                            $skill_element
                        </table>
                    </div>
            
                    
                </div>
                <div class='clear'></div>
            </div>
            </body>
            </html>";
    }

    // Simple clean theme
    public function simpleTheme($resume)
    {
        $education_element = "";
        foreach($resume->educations as $education){
            $education_element .= "
            <div class='education-item'>
                <p class='date-item'>$education->start_date_edu - $education->end_date_edu</p>
                <h5 class='title-item'>$education->school</h5>
                <p class='desc-item'>$education->degree</p>
            </div>";
        }

        $experience_element = "";
        foreach($resume->experiences as $experience){
            $experience_element .= "<div class='experience-item'>
                <p class='date-item'>$experience->start_date_exp - $experience->end_date_exp</p>
                <h5 class='title-item'>$experience->job | $experience->employer</h5>
                <p class='desc-item'>$experience->experience_desc</p>
            </div>";
        }

        $skill_element = "";
        foreach($resume->skills as $skill){
            $skill_element .= "
            <tr>
                <td>{$skill->skill}</td>
                <td style='color: #6c757d'>{$skill->level}</td>
            </tr>";
        }

        $image_url = public_path( Storage::url($resume->profile->photo) );
        $css_url =  public_path('css/themes/simple.css');

        return "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <link rel='preconnect' href='https://fonts.googleapis.com'>
            <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
            <link href='https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;700&display=swap' rel='stylesheet'>
            <link href='$css_url' rel='stylesheet' type='text/css' />
        </head>
        <body>
            <div class='cv-container print'>
                <div class='header'>
                    <div class='title'>
                        <h1 class='name'>{$resume->profile->name}</h1>
                        <p class='gray-text'>{$resume->profile->job_title}</p>
                    </div>
                    <div class='profile-picture'>
                        <img src='$image_url' alt='' style='transform: rotate(-90deg); width: 150px; height: 150px;'>
                    </div>
                    <div class='clear'></div>
                </div>
                
                <div class='left'>
                    <h2 class='section-title'>CONTACT</h2>
                    <table style='width: 100%'>
                        <tr>
                            <td>{$resume->profile->email}</td>
                            <td><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' style='fill: #6c757d;transform: ;msFilter:;'><path d='M20 4H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2zm0 4.7-8 5.334L4 8.7V6.297l8 5.333 8-5.333V8.7z'></path></svg></td>
                        </tr>
                        <tr>
                            <td>{$resume->profile->phone}</td>
                            <td><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' style='fill: #6c757d;transform: ;msFilter:;'><path d='m20.487 17.14-4.065-3.696a1.001 1.001 0 0 0-1.391.043l-2.393 2.461c-.576-.11-1.734-.471-2.926-1.66-1.192-1.193-1.553-2.354-1.66-2.926l2.459-2.394a1 1 0 0 0 .043-1.391L6.859 3.513a1 1 0 0 0-1.391-.087l-2.17 1.861a1 1 0 0 0-.29.649c-.015.25-.301 6.172 4.291 10.766C11.305 20.707 16.323 21 17.705 21c.202 0 .326-.006.359-.008a.992.992 0 0 0 .648-.291l1.86-2.171a.997.997 0 0 0-.085-1.39z'></path></svg></td>
                        </tr>
                        <tr>
                            <td>{$resume->profile->address}</td>
                            <td><svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' style='fill: #6c757d;transform: ;msFilter:;'><path d='m21.743 12.331-9-10c-.379-.422-1.107-.422-1.486 0l-9 10a.998.998 0 0 0-.17 1.076c.16.361.518.593.913.593h2v7a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-4h4v4a1 1 0 0 0 1 1h3a1 1 0 0 0 1-1v-7h2a.998.998 0 0 0 .743-1.669z'></path></svg></td>
                        </tr>
                    </table>
                    <div class='about'>
                        <h2 class='section-title'>ABOUT ME</h2>
                        <p>{$resume->profile->profile_desc}</p>
                    </div>

                    <div class='skills'>
                        <h2 class='section-title'>SKILLS</h2>
                        <table style='width: 100%;'>
                            $skill_element
                        </table>
                    </div>
                </div>

                <div class='right'>
                    <div class='education'>
                        <h2 class='section-title'>EDUCATION</h2>
                        $education_element
                    </div>

                    <div class='experience'>
                        <h2 class='section-title'>EXPERIENCE</h2>
                        $experience_element
                    </div>

                </div>
                <div class='clear'></div>

            </div>
        </body>
        </html>
        ";
    }

}
