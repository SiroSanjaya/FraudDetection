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
use App\Models\Enroll;
use App\Models\Enrollment;
use App\Models\OptionQuestion;
use App\Models\QuestionQuiz;
use App\Models\Quiz;
use App\Models\Videos;
use App\Models\role;
class CrudController extends Controller
{
    // Select Position
  public function SelectedPosition(Request $request)
{
    $request->validate([
        'Position' => 'required',
    ]);

    $data = [
        'role_Id' => $request->Position,
    ];

    User::where('user_id', Auth::user()->user_id)->update($data);

    // if (Auth::user()->role === 'FTS' || Auth::user()->role === null) {
    //     return redirect()->route('SelectUnit');
    // } else  {
       return redirect()->route('dashboard');
     //}
}


    // Select Unit
    // public function SelectedUnit(Request $request)
    // {
    //     $request->validate([
    //         'BisnisUnit' => 'required',
    //     ]);

    //     $data = [
    //         'Bisnis_Unit_Id' => $request->BisnisUnit,
    //     ];

    //     User::where('user_id', Auth::user()->user_id)->update($data);

    //     if(User::where('user_id', Auth::user()->role) === 'Trainer'){
    //         $data = [
    //             'id_region' => 1,
    //         ];
    //         User::where('user_id', Auth::user()->user_id)->update($data);
    //         return redirect()->intended('/');
    //     }

    //     return redirect()->route('SelectRegion');
    // }

    // Select Region
    public function SelectedRegion(Request $request)
    {
        $request->validate([
            'Region' => 'required',
        ]);

        $data = [
            'id_region' => $request->Region,
        ];

        User::where('user_id', Auth::user()->user_id)->update($data);

        return redirect()->route('HomeUser');
    }

    // Manage Courses
    public function AddedCategoryCourses(Request $request)
    {
        $request->validate([
            'BisnisUnit' => 'required',
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
                'Bisnis_Unit_Id' => $request->BisnisUnit,
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
                'Bisnis_Unit_Id' => $request->BisnisUnit,
                'Category_Name' => $request->CategoryName,
                'Category_Desc' => $request->CategoryDesc,
                'Category_Image' => $newName,
            ];
        } else {
            $data = [
                'Bisnis_Unit_Id' => $request->BisnisUnit,
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
            'QuizTime' => 'required',
            'QuizKkm' => 'required',
        ]);

        $data = [
            'Courses_Id' => $request->Courses,
            'Quiz_Title' => $request->QuizTitle,
            'Quiz_Desc' => $request->QuizDesc,
            'Quiz_Time' => $request->QuizTime,
            'Quiz_Kkm' => $request->QuizKkm,
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
            'QuizTime' => 'required',
            'QuizKkm' => 'required',
        ]);

        $data = [
            'Courses_Id' => $request->Courses,
            'Quiz_Title' => $request->QuizTitle,
            'Quiz_Desc' => $request->QuizDesc,
            'Quiz_Time' => $request->QuizTime,
            'Quiz_Kkm' => $request->QuizKkm,
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
            'QuizTime' => 'required',
            'QuizKkm' => 'required',
        ]);

        $data = [
            'Courses_Id' => Courses::where('Courses_Title', $request->Courses)->first()->Courses_Id,
            'Quiz_Title' => $request->QuizTitle,
            'Quiz_Desc' => $request->QuizDesc,
            'Quiz_Time' => $request->QuizTime,
            'QuizKkm' => $request->QuizKkm,
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

        foreach ($request->Option as $Option) {
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

    // public function DeleteOption($courses, $id, $OptionID)
    // {
    //     OptionQuestion::destroy($OptionID);

    //     return redirect()->route('QuizDetail', ['courses' => $courses, 'id' => $id])->with('success', 'Succesfully Delete Option');
    // }

    // Enrollment
    public function AddedEnrollment(Request $request)
    {
        $request->validate([
            'CategoryCourses' => 'required',
            'EnrollmentTitle' => 'required',
            'EnrollmentDesc' => 'required',
            'EnrollmentStart' => 'required',
            'EnrollmentEnd' => 'required',
            'Certificate' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        $dataEnrollment = [
            'Category_Courses_Id' => $request->CategoryCourses,
            'Enrollment_Title' => $request->EnrollmentTitle,
            'Enrollment_Desc' => $request->EnrollmentDesc,
            'Enrollment_Start' => $request->EnrollmentStart,
            'Enrollment_End' => $request->EnrollmentEnd,
        ];

        $enrollment = Enrollment::create($dataEnrollment);

        if ($request->hasFile('Certificate')) {
            $image = $request->file('Certificate');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/certificate/images', $newName, 'local');
            }

            Certificate::create([
                'Enrollment_Id' => $enrollment->Enrollment_Id,
                'Certificate_Image' => $newName,
            ]);
        }


        return redirect()->route('ManageEnrollment')->with('success', 'Succesfully Add Enrollment');
    }
    public function EditedEnrollment(Request $request, $id)
    {
        $request->validate([
            'CategoryCourses' => 'required',
            'EnrollmentTitle' => 'required',
            'EnrollmentDesc' => 'required',
            'EnrollmentStart' => 'required',
            'EnrollmentEnd' => 'required',
            'Certificate' => 'image|mimes:png,jpg,jpeg|max:5120'
        ]);

        $dataEnrollment = [
            'Category_Courses_Id' => $request->CategoryCourses,
            'Enrollment_Title' => $request->EnrollmentTitle,
            'Enrollment_Desc' => $request->EnrollmentDesc,
            'Enrollment_Start' => $request->EnrollmentStart,
            'Enrollment_End' => $request->EnrollmentEnd,
        ];

        $enrollment = Enrollment::where('Enrollment_Id', $id)->update($dataEnrollment);


        if ($request->hasFile('Certificate')) {
            $image = $request->file('Certificate');
            if ($image->isValid()) {
                $newName = $image->hashName();
                $image->storeAs('public/uploads/certificate/images', $newName, 'local');
            }

            Certificate::where('Enrollment_Id', $id)->update([
                'Enrollment_Id' => $enrollment->Enrollment_Id,
                'Certificate_Image' => $newName,
            ]);
        }else{
            Certificate::where('Enrollment_Id', $id)->update([
                'Enrollment_Id' => $enrollment->Enrollment_Id,
            ]);
        }


        return redirect()->route('ManageEnrollment')->with('success', 'Succesfully Edit Enrollment');
    }
    public function DeleteEnrollment($id)
    {
        Enrollment::destroy($id);
        Certificate::destroy($id);

        return redirect()->route('ManageEnrollment')->with('success', 'Succesfully Delete Enrollment');
    }

    // Enrollment Detail
    public function AddedDetailEnrollment(Request $request, $category)
    {
        $request->validate([
            'Users' => 'required',
            'EnrollmentID' => 'required',
            'EnrollDate' => 'required',
        ]);

        foreach ($request->Users as $user) {
            Enroll::create([
                'Enrollment_Id' => $request->EnrollmentID,
                'user_id' => $user,
                'Enroll_Date' => $request->EnrollDate,
            ]);
        }

        return redirect()->route('DetailEnrollment', ['category' => $category])->with('success', 'Succesfully Add User To Enrollment');
    }
    public function EditedDetailEnrollment(Request $request, $category, $id)
    {
        $request->validate([
            'Users' => 'required',
            'EnrollmentID' => 'required',
            'EnrollDate' => 'required',
        ]);

        foreach ($request->Users as $user) {
            Enroll::where('Enroll_Id', $id)->update([
                'Enrollment_Id' => $request->EnrollmentID,
                'user_id' => $user,
                'Enroll_Date' => $request->EnrollDate,
            ]);
        }

        return redirect()->route('DetailEnrollment', ['category' => $category])->with('success', 'Succesfully Edit User Enrollment');
    }
    public function DeleteDetailEnrollment($category, $id)
    {
        Enroll::destroy($id);

        return redirect()->route('DetailEnrollment', ['category' => $category])->with('success', 'Succesfully Delete Enroll User');
    }

    //Users
    public function EditedUser(Request $request,  $id)
    {
        //$request->validate([
            //'Users' => 'required',
            //'username' => 'required',
            //'role' => 'required',
            //'Bisnis_Unit_Id' => 'required',
            //'id_region' => 'required',
        //]);

        $data = [
            'username' => $request->username,
            'Bisnis_Unit_Id' => $request->BisnisUnit,
            'role' => $request->Role,
            'id_region' => $request->Region,
        ];

        User::where('user_id', $id)->update($data);

        return redirect()->route('DataUser')->with('success', 'Succesfully Edit Category');

    }

    public function DeletedUser($id)
    {
        User::destroy($id);

        return redirect()->route('DataUser')->with('success', 'Succesfully Delete Enrollment');
    }
}
