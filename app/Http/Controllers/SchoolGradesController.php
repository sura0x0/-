<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SchoolGrades;
use App\Models\Students;

class SchoolGradesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $student_id)
    {
        $student = Students::find($student_id);

        $query = $student->grades();
    
        if ($request->has('grade')) {
            $query->where('grade', $request->grade);
        }
    
        if ($request->has('term')) {
            $query->where('term', $request->term);
        }
    
        // 学年と学期でソート
        $query->orderBy('grade', 'asc');
        $query->orderBy('term', 'asc');
    
        $grades = $query->get();
    
        return view('show')->with('student', $student)->with('grades', $grades);
    }  

    public function search(Request $request, $id) 
    {
        $student = Students::find($id);
        if ($student === null) {
            return response()->json(['error' => '指定された条件が見つかりませんでした。']);
        }
    
        $keyword_grade = $request->grade;
        $keyword_term = $request->term;
    
        $grades = SchoolGrades::search($student->id, $keyword_grade, $keyword_term);
    
        // リクエストがAjaxか判断
        if ($request->ajax()) {
            // Ajaxリクエストの場合は、JSON形式でデータを返します。
            return response()->json($grades);
        } else {
            // Ajaxリクエストでない場合は、ビューを返します。
            return view('show')->with('student', $student)->with('grades', $grades);
        }
    }
        
    
    
    
    
    
    
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        $student = Students::find($id);
        return view('grade_store', ['student' => $student]);    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id)
    {
        // データ保存
        $schoolGrade = new SchoolGrades([
            'student_id' => $id, // 学生のIDを設定
            'grade' => $request->get('grade'),
            'term' => $request->get('term'),
            'japanese' => $request->get('japanese'),
            'math' => $request->get('math'),
            'science' => $request->get('science'),
            'social_studies' => $request->get('social_studies'),
            'music' => $request->get('music'),
            'home_economics' => $request->get('home_economics'),
            'engrish' => $request->get('engrish'),
            'art' => $request->get('art'),
            'health_and_physical_education' => $request->get('health_and_physical_education')
        ]);
    
        // 作成したデータベースに新しいレコードとして保存します。
        $schoolGrade->save();
    
        // 学生一覧画面にリダイレクト
        return redirect()->route('show', ['id' => $id]);
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $grade = SchoolGrades::findOrFail($id);
        //$student = Students::find($grade->student_id);
        $student = Students::find($grade->id);
        $student = $grade->student;
        
        if ($student === null) {
            // 学生情報が見つからない場合の処理を書く
            return redirect()->back()->with('error', '学生情報が見つかりません');
        }
        // viewに連想配列を渡す
        return view('grade_edit',['message' => '編集フォーム','data' => $grade, 'grade' => $grade, 'student' => $student]);
    }
        
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = SchoolGrades::findOrFail($id);
    
        $data->grade = $request->grade;
        $data->term = $request->term;    
        $data->japanese = $request->japanese;    
        $data->math = $request->math;    
        $data->science = $request->science;    
        $data->social_studies = $request->social_studies;    
        $data->music = $request->music;    
        $data->home_economics = $request->home_economics;    
        $data->engrish = $request->engrish;    
        $data->art = $request->art;    
        $data->health_and_physical_education = $request->health_and_physical_education;    


    
        // 選択された教科の成績を更新
        //$subject = $request->subject;
        //$data->$subject = $request->score;
    
        $data->save();
    
        return redirect()->route('grade.edit', ['id' => $data->id])->with('message', '成績が更新されました');
    }
}
