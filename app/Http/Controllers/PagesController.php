<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnswereQuestion;
use App\Models\BisnisUnit;
use App\Models\CategoryCourses;
use App\Models\Courses;
use App\Models\OptionQuestion;
use App\Models\QuestionQuiz;
use App\Models\Quiz;
use App\Models\QuizDetail;
use App\Models\Videos;

class PagesController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }
    public function Login()
    {
        return view('auth.Login');
    }
    public function SelectUnit()
    {
        return view('SelectUnit', [
            'unit' => BisnisUnit::all(),
        ]);
    }

    // Manage Courses
    public function ManageCourses()
    {
        return view('admin.ManageCourses',[
            'CategoryCourses' => CategoryCourses::all(),
        ]);
    }
    public function AddCategoryCourses()
    {
        return view ('admin.Courses.AddCategoryCourses');
    }
    public function EditCategoryCourses($id)
    {
        return view ('admin.Courses.EditCategoryCourses', [
            'CategoryCourses' => CategoryCourses::where('Category_Id', $id)->first()
        ]);
    }

    // Courses
    public function Courses($category)
    {
        return view ('admin.Courses.Courses',[
            'CategoryCourses' => CategoryCourses::where('Category_Name', $category)->first(),
            'courses' => Courses::all()
        ]);
    }
    public function AddCourses($category)
    {
        return view ('admin.Courses.AddCourses',[
            'CategoryCourses' => CategoryCourses::where('Category_Name', $category)->first(),
        ]);
    }
    public function EditCourses($category, $id)
    {
        return view ('admin.Courses.EditCourses', [
            'courses' => Courses::where('Courses_Id' , $id)->first(),
            'CategoryCourses' => CategoryCourses::where('Category_Name' , $category)->first()
        ]);
    }

    // Category Video
    public function ManageVideos()
    {
        return view('admin.ManageVideos', [
            'courses' => Courses::CoursesByVideo(),
        ]);
    }
    public function AddVideos()
    {
        return view('admin.CrudVideos.AddVideos',[
            'courses' => Courses::all(),
        ]);
    }

    // Detail Video
    public function VideoDetail($courses)
    {
        return view('admin.CrudVideos.VideoDetail', [
            'videos' => Videos::VideosByCourses($courses),
            'courses' => Courses::where('Courses_Title', $courses)->first(),
        ]);
    }
    public function AddVideoDetail($courses)
    {
        return view('admin.CrudVideos.AddVideoDetail', [
            'courses' => Courses::where('Courses_Title', $courses)->first(),
        ]);
    }
    public function EditVideoDetail($courses, $id)
    {
        return view('admin.CrudVideos.EditVideosDetail',[
            'videos' => Videos::where('Video_Id', $id)->first(),
            'courses' => Courses::where('Courses_Title', $courses)->first(),
            'allcourses' => Courses::all(),
        ]);
    }

    // Manage Quiz
    public function ManageQuiz()
    {
        return view('admin.ManageQuiz', [
            'courses' => Courses::CoursesByQuiz(),
        ]);
    }
    public function AddQuiz()
    {
        return view('admin.CrudQuiz.AddQuiz',[
            'courses' => Courses::all()
        ]);
    }

    // Quiz
    public function Quiz($courses)
    {
        return view('admin.CrudQuiz.Quiz', [
            'courses' => Courses::where('Courses_Title', $courses)->first(),
            'quiz' => Quiz::where('Courses_Id', Courses::where('Courses_Title', $courses)->first()->Courses_Id)->get(),
        ]);
    }
    public function AddQuizDetail($courses)
    {
        return view('admin.CrudQuiz.AddQuizDetail', [
            'courses' => Courses::where('Courses_Title', $courses)->first(),
        ]);
    }
    public function EditQuiz($courses, $id)
    {
        return view('admin.CrudQuiz.EditQuiz',[
            'courses' => Courses::where('Courses_Title', $courses)->first(),
            'allcourses' => Courses::all(),
            'quiz' => Quiz::where('Quiz_Id', $id)->first()
        ]);
    }
    
    // Quiz Detail
    public function QuizDetail($courses, $id)
    {
        return view('admin.CrudQuiz.QuizDetail', [
            'courses' => Courses::where('Courses_Title', $courses)->first(),
            'quiz' => Quiz::where('Quiz_Id', $id)->first(),
            'question' => QuestionQuiz::GetAllQuiz($id)
        ]);
    }

    public function EditQuizDetail($courses, $id, $QuestionID)
    {
        return view('admin.CrudQuiz.EditQuizDetail',[
            'courses' => Courses::where('Courses_Title', $courses)->first(),
            'quiz' => Quiz::where('Quiz_Id', $id)->first(),
            'question' => QuestionQuiz::where('Question_Id', $QuestionID)->first(),
            'option' => OptionQuestion::where('Question_Id', QuestionQuiz::where('Quiz_Id', $id)->first()->Question_Id)->get(),
            'answer' => AnswereQuestion::where('Question_Id', QuestionQuiz::where('Quiz_Id', $id)->first()->Question_Id)->first()
        ]);
    }
    public function AddQuestion($courses, $id)
    {
        return view('admin.CrudQuiz.AddQuestion', [
            'courses' => Courses::where('Courses_Title', $courses)->first(),
            'quiz' => Quiz::where('Quiz_Id', $id)->first(),
        ]);
    }
}
