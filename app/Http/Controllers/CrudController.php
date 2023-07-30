<?php

namespace App\Http\Controllers;

use App\Models\AnswereQuestion;
use App\Models\CategoryCourses;
use App\Models\CategoryVideo;
use App\Models\Certificate;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Courses;
use App\Models\Enrollment;
use App\Models\OptionQuestion;
use App\Models\QuestionQuiz;
use App\Models\Quiz;
use App\Models\Videos;

class CrudController extends Controller
{
    // Select Position
    public function SelectedPosition(Request $request)
    {
        $request->validate([
            'Position' => 'required',
        ]);

        $data = [
            'role' => $request->Position,
        ];

        User::where('User_Id', Auth::user()->User_Id)->update($data);

        if (Auth::user()->role !== 'fts'){
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('SelectUnit');
        }
    }

    // Select Unit
    public function SelectedUnit(Request $request)
    {
        $request->validate([
            'BisnisUnit' => 'required',
        ]);

        $data = [
            'Bisnis_Unit_Id' => $request->BisnisUnit,
        ];

        User::where('User_Id', Auth::user()->User_Id)->update($data);

        return redirect()->route('dashboard');
    }

    // Manage Courses
    public function AddedCategoryCourses(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required',
            'CategoryDesc' => 'required',
            'CategoryImage' => 'required|image|mimes:png,jpg,jpeg|max:5120'
        ]);

        if ($request->hasFile('CategoryImage')) {
            $image = $request->file('CategoryImage');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/category/images', $newName, 'local');
            }

            $data = [
                'Category_Name' => $request->CategoryName,
                'Category_Desc' => $request->CategoryDesc,
                'Category_Image' => $newName,
            ];
        }

        CategoryCourses::create($data);

        return redirect()->route('ManageCourses')->with('success', 'Succesfully Add Category Courses');
    }
    public function EditedCategoryCourses(Request $request, $id)
    {
        if ($request->hasFile('CategoryImage')) {
            $image = $request->file('CategoryImage');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/category/images', $newName, 'local');
            }

            $data = [
                'Category_Name' => $request->CategoryName,
                'Category_Desc' => $request->CategoryDesc,
                'Category_Image' => $newName,
            ];
        } else {
            $data = [
                'Category_Name' => $request->CategoryName,
                'Category_Desc' => $request->CategoryDesc,
            ];
        }

        CategoryCourses::where('Category_Id', $id)->update($data);

        return redirect()->route('ManageCourses')->with('success', 'Succesfully Edit Category');
    }
    public function DeleteCategoryCourses($id)
    {
        CategoryCourses::destroy($id);

        return redirect()->route('ManageCourses')->with('success', 'Succesfully Delete Category');
    }

    // Courses
    public function AddedCourses(Request $request, $category)
    {
        $request->validate([
            'CoursesTitle' => 'required',
            'CoursesDesc' => 'required',
            'CoursesModule' => 'required',
            'CoursesImage' => 'required|image|mimes:png,jpg,jpeg|max:5120'
        ]);

        if ($request->hasFile('CoursesImage')) {
            $image = $request->file('CoursesImage');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/courses/images', $newName, 'local');
            }

            $data = [
                'Category_Id' => CategoryCourses::where('Category_Name', $category)->first()->Category_Id,
                'Courses_Title' => $request->CoursesTitle,
                'Courses_Desc' => $request->CoursesDesc,
                'Courses_Module' => $request->CoursesModule,
                'Courses_Image' => $newName,
            ];
        }

        Courses::create($data);

        return redirect()->route('Courses', ['category' => $category])->with('success', 'Succesfully Add Courses');
    }
    public function EditedCourses(Request $request, $category, $id)
    {
        if ($request->hasFile('CoursesImage')) {
            $image = $request->file('CoursesImage');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/courses/images', $newName, 'local');
            }

            $data = [
                'Category_Id' => CategoryCourses::where('Category_Name', $category)->first()->Category_Id,
                'Courses_Title' => $request->CoursesTitle,
                'Courses_Desc' => $request->CoursesDesc,
                'Courses_Module' => $request->CoursesModule,
                'Courses_Image' => $newName,
            ];
        } else {
            $data = [
                'Category_Id' => CategoryCourses::where('Category_Name', $category)->first()->Category_Id,
                'Courses_Title' => $request->CoursesTitle,
                'Courses_Desc' => $request->CoursesDesc,
                'Courses_Module' => $request->CoursesModule,
            ];
        }

        Courses::where('Courses_Id', $id)->update($data);

        return redirect()->route('Courses', ['category' => $category])->with('success', 'Succesfully Edited Courses');
    }
    public function DeleteCourses($category, $id)
    {
        Courses::destroy($id);

        return redirect()->route('Courses', ['category' => $category])->with('success', 'Succesfully Delete Courses');
    }

    // Videos
    public function AddedVideos(Request $request)
    {
        $request->validate([
            'VideoName' => 'required',
            'VideoDesc' => 'required',
            'VideoLink' => 'required',
            'CustomVideoThumbnail' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        if ($request->hasFile('CustomVideoThumbnail')) {
            $image = $request->file('CustomVideoThumbnail');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/thumbnail/images', $newName, 'local');
            }

            $data = [
                'Video_Title' => $request->VideoName,
                'Video_Desc' => $request->VideoDesc,
                'Video_Link' => $request->VideoLink,
                'Video_Thumbnail' => $newName,
            ];
        } else {
            $data = [
                'Video_Title' => $request->VideoName,
                'Video_Desc' => $request->VideoDesc,
                'Video_Link' => $request->VideoLink,
                'Video_Thumbnail' => $request->Thumbnail,
            ];
        }

        $video = Videos::create($data);
        foreach ($request->Courses as $courseId) {
            CategoryVideo::create([
                'Video_Id' => $video->Video_Id,
                'Courses_Id' => $courseId,
            ]);
        }

        return redirect()->route('ManageVideos')->with('success', 'Succesfully Add Video');
    }

    // Detail Video
    public function AddedVideoDetail(Request $request, $courses)
    {
        $request->validate([
            'VideoName' => 'required',
            'VideoDesc' => 'required',
            'VideoLink' => 'required',
            'CustomVideoThumbnail' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        if ($request->hasFile('CustomVideoThumbnail')) {
            $image = $request->file('CustomVideoThumbnail');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/thumbnail/' . $courses . '/images', $newName, 'local');
            }

            $data = [
                'Video_Title' => $request->VideoName,
                'Video_Desc' => $request->VideoDesc,
                'Video_Link' => $request->VideoLink,
                'Video_Thumbnail' => $newName,
            ];
        } else {
            $data = [
                'Video_Title' => $request->VideoName,
                'Video_Desc' => $request->VideoDesc,
                'Video_Link' => $request->VideoLink,
                'Video_Thumbnail' => $request->Thumbnail,
            ];
        }

        $video = Videos::create($data);
        CategoryVideo::create([
            'Video_Id' => $video->Video_Id,
            'Courses_Id' => Courses::where('Courses_Title', $courses)->first()->Courses_Id
        ]);

        return redirect()->route('VideoDetail', ['courses' => $courses])->with('success', 'Succesfully Add Video');
    }
    public function EditedVideoDetail(Request $request, $courses, $id)
    {
        $request->validate([
            'VideoName' => 'required',
            'VideoDesc' => 'required',
            'VideoLink' => 'required',
            'CustomVideoThumbnail' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        if ($request->hasFile('CustomVideoThumbnail')) {
            $image = $request->file('CustomVideoThumbnail');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/thumbnail/' . $courses . '/images', $newName, 'local');
            }

            $data = [
                'Video_Title' => $request->VideoName,
                'Video_Desc' => $request->VideoDesc,
                'Video_Link' => $request->VideoLink,
                'Video_Thumbnail' => $newName,
            ];
        } else {
            $data = [
                'Video_Title' => $request->VideoName,
                'Video_Desc' => $request->VideoDesc,
                'Video_Link' => $request->VideoLink,
                'Video_Thumbnail' => $request->Thumbnail,
            ];
        }

        Videos::where('Video_Id', $id)->update($data);
        foreach ($request->Courses as $courseId) {
            CategoryVideo::where('Video_Id', $id)->update([
                'Video_Id' => $id,
                'Courses_Id' => $courseId,
            ]);
        }

        return redirect()->route('VideoDetail', ['courses' => $courses])->with('success', 'Succesfully Edited Video');
    }
    public function DeleteVideoDetail($courses, $id)
    {
        Videos::destroy($id);

        return redirect()->route('VideoDetail', ['courses' => $courses])->with('success', 'Succesfully Delete Video');
    }

    // Quiz
    public function AddedQuiZ(Request $request)
    {
        $request->validate([
            'Courses' => 'required',
            'QuizTitle' => 'required',
            'QuizDesc' => 'required',
        ]);

        $data = [
            'Courses_Id' => $request->Courses,
            'Quiz_Title' => $request->QuizTitle,
            'Quiz_Desc' => $request->QuizDesc,
        ];

        Quiz::create($data);

        return redirect()->route('ManageQuiz')->with('success', 'Succesfully Add Quiz');
    }
    public function EditedQuiZ(Request $request, $courses, $id)
    {
        $request->validate([
            'Courses' => 'required',
            'QuizTitle' => 'required',
            'QuizDesc' => 'required',
        ]);

        $data = [
            'Courses_Id' => $request->Courses,
            'Quiz_Title' => $request->QuizTitle,
            'Quiz_Desc' => $request->QuizDesc,
        ];

        Quiz::where('Quiz_Id', $id)->update($data);

        return redirect()->route('Quiz', ['courses' => $courses])->with('success', 'Succesfully Edit Quiz');
    }

    public function DeleteQuiZ($courses, $id)
    {
        Quiz::destroy($id);

        return redirect()->route('Quiz', ['courses' => $courses])->with('success', 'Succesfully Delete Quiz');
    }
    
    // Quiz Detail
    public function AddedQuiZDetail(Request $request, $courses)
    {
        $request->validate([
            'Courses' => 'required',
            'QuizTitle' => 'required',
            'QuizDesc' => 'required',
        ]);

        $data = [
            'Courses_Id' => Courses::where('Courses_Title', $request->Courses)->first()->Courses_Id,
            'Quiz_Title' => $request->QuizTitle,
            'Quiz_Desc' => $request->QuizDesc,
        ];

        Quiz::create($data);

        return redirect()->route('Quiz', ['courses' => $courses])->with('success', 'Succesfully Add Quiz');
    }

    public function EditedQuizDetail(Request $request, $courses, $id, $QuestionID)
    {
        // dd($request);
        $request->validate([
            'Question' => 'required',
            'Answere' => 'required',
        ]);

        $dataQuestion = [
            'Quiz_Id' => $id,
            'Question' => $request->Question,
        ];

        QuestionQuiz::where('Question_Id', $QuestionID)->update($dataQuestion);

        foreach ($request->Option as $key => $Option) {
            $optionId = $request->OptionID[$key];
        
            OptionQuestion::where('Option_Id', $optionId)->update([
                'Option' => $Option
            ]);
        }
        
        
        AnswereQuestion::where('Question_Id', $QuestionID)->update([
            'Answare' => $request->Answere
        ]);


        return redirect()->route('QuizDetail', ['courses' => $courses, 'id' => $id])->with('success', 'Succesfully Edit Quiz');
    }


    // Question
    public function AddedQuestion(Request $request, $courses, $id)
    {
        $request->validate([
            'Question' => 'required',
            'Answere' => 'required',
        ]);

        $dataQuestion = [
            'Quiz_Id' => $id,
            'Question' => $request->Question,
        ];

        $Question = QuestionQuiz::create($dataQuestion);

        foreach ($request->Option as $Option){
            OptionQuestion::create([
                'Question_Id' => $Question->Question_Id,
                'Option' => $Option
            ]);
        }
        
        AnswereQuestion::create([
            'Question_Id' => $Question->Question_Id,
            'Answare' => $request->Answere
        ]);


        return redirect()->route('QuizDetail', ['courses' => $courses, 'id' => $id])->with('success', 'Succesfully Add Question');
    }
    
    public function DeleteQuestion($courses, $id, $QuestionID)
    {
        QuestionQuiz::destroy($QuestionID);

        return redirect()->route('QuizDetail', ['courses' => $courses, 'id' => $id])->with('success', 'Succesfully Delete Question');
    }
    
    public function DeleteOption($courses, $id, $OptionID)
    {
        OptionQuestion::destroy($OptionID);

        return redirect()->route('QuizDetail', ['courses' => $courses, 'id' => $id])->with('success', 'Succesfully Delete Option');
    }

        // Enrollment
        public function AddedEnrollment(Request $request)
        {
            $request->validate([
                'CategoryCourses' => 'required',
                'EnrollementStart' => 'required',
                'EnrollementEnd' => 'required',
                'Certificate' => 'required|image|mimes:png,jpg,jpeg|max:5120'
            ]);
            
            if ($request->hasFile('Certificate')) {
                $image = $request->file('Certificate');
                if ($image->isValid()) {
                    $newName = $image->hashName();
                    $image->storeAs('public/uploads/certificate/images', $newName, 'local');
                }
                
                $dataCetificate = [
                    'Category_Courses_Id' => $request->CategoryCourses,
                    'Certificate_Image' => $newName,
                ];
                
            }

            $dataEnrollment = [
                'Category_Courses_Id' => $request->CategoryCourses,
                'Enrollment_Start' => $request->EnrollementStart,
                'Enrollment_End' => $request->EnrollementEnd,
            ];
    
            Enrollment::create($dataEnrollment);
            Certificate::create($dataCetificate);
    
            return redirect()->route('ManageEnrollment')->with('success', 'Succesfully Add Enrollment');
        }
        public function EditedEnrollment(Request $request, $category, $id)
        {
            if ($request->hasFile('CoursesImage')) {
                $image = $request->file('CoursesImage');
                if ($image->isValid()) {
                    $newName = $image->hashName();
                    $image->storeAs('public/uploads/courses/images', $newName, 'local');
                }
    
                $data = [
                    'Category_Id' => CategoryCourses::where('Category_Name', $category)->first()->Category_Id,
                    'Courses_Title' => $request->CoursesTitle,
                    'Courses_Desc' => $request->CoursesDesc,
                    'Courses_Module' => $request->CoursesModule,
                    'Courses_Image' => $newName,
                ];
            } else {
                $data = [
                    'Category_Id' => CategoryCourses::where('Category_Name', $category)->first()->Category_Id,
                    'Courses_Title' => $request->CoursesTitle,
                    'Courses_Desc' => $request->CoursesDesc,
                    'Courses_Module' => $request->CoursesModule,
                ];
            }
    
            Enrollment::where('Courses_Id', $id)->update($data);
    
            return redirect()->route('Enrollment', ['category' => $category])->with('success', 'Succesfully Edited Enrollment');
        }
        public function DeleteEnrollment($category, $id)
        {
            Enrollment::destroy($id);
    
            return redirect()->route('Enrollment', ['category' => $category])->with('success', 'Succesfully Delete Enrollment');
        }
}
