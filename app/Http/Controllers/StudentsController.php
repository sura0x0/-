<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\SchoolGrades;
use App\Models\Students;
use Illuminate\Support\Facades\Storage;


class StudentsController extends Controller //コントローラーclass継承（コントローラー機能実装）
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $grade = $request->input('grade');

        $query = Students::query();

        if ($name) {
            $query->where('name', 'LIKE', "%{$name}%");
        }

        if ($grade) {
            $query->where('grade', $grade);
        }

        $students = $query->get();

        return view('index')->with('students', $students);
    }
        // 一覧取得
        //$students = Students::all();
        // 一覧表示
    
    public function serch(Request $request) 
    {
        $keyword_grade = $request->grade;
        $keyword_name = $request->name;
        list($students,$message) = Serch::serch($keyword_grade,$keyword_name);
  
        return view('/index')->with([
          'users' => $students,
          'message' => $message,
        ]);
    }

     
    public function create()//create: 新規リソースの作成フォームを表示する
    {
        // 成績登録画面で成績の情報が必要なので、全ての会社の情報を取得します。
        return view('student_register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'grade' => 'nullable|integer',
            'name' => 'required',
            'address' => 'required',
            'img_path' => 'nullable|image|max:2048',
            'comment' => 'nullable|string',
        ]);

        // データ保存
        $student = new Students([
            'name' => $request->get('name'),
            'address' => $request->get('address')
        ]);
        //画像ファイルを保存
        if($request->hasFile('img_path')){ 
            $filename = $request->img_path->getClientOriginalName();
            $filePath = $request->img_path->storeAs('students', $filename, 'public');
            $student->img_path = '' . $filename;
        }

        // 作成したデータベースに新しいレコードとして保存します。
        $student->save();

        // 学生一覧画面にリダイレクト
        return redirect()->route('register');
    }    

    /**
     * Display the specified resource.
     */
    public function show(string $id)//show: 指定リソースを表示する
    {
        //$student = Students::find($id);
        //return view('show', ['student' => $student]);

        $student = Students::find($id);
        $grades = SchoolGrades::where('student_id', $id)->get();
    
        return view('show', ['student' => $student, 'grades' => $grades]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)//edit: 指定リソースの編集フォームを表示する
    {

        $student = Students::find($id);

        return view('student_edit', ['student' => $student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $student = Students::find($id);

        // リクエストを検証...
        $request->validate([
            'grade' => 'nullable|integer',
            'name' => 'required',
            'address' => 'required',
            'img_path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'comment' => 'nullable',
        ]);

        // 学生の名前と住所を更新
        $student->grade = $request->grade;
        $student->name = $request->name;
        $student->address = $request->address;
        $student->comment = $request->comment;

        // プロフィール画像がアップロードされたかどうかを確認
        if ($request->has('img_path')) {
            // 古い画像をストレージから削除
            if ($student->img_path !== null) {
                Storage::delete('public/students/' . $student->img_path);
            }

            // 新しい画像を保存
            $image = $request->file('img_path');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/students', $filename);

            // 学生のプロフィール画像を更新
            $student->img_path = $filename;
        }

        // 学生を保存
        $student->save();

        //return redirect()->route('student.edit', $student->id);
        return view('student_edit', ['student' => $student]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Studentsテーブルから指定のIDのレコード1件を取得
        $student = Students::find($id);
    
        // 学生の画像を削除
        if ($student->img_path !== null) {
            Storage::delete('public/students/' . $student->img_path);
        }
    
        // レコードを削除
        $student->delete();
    
        // 削除したら一覧画面にリダイレクト
        return redirect()->route('students.index');
    }

    public function updateAllGrades()
    {
        // 全ての学生レコードを取得します。
        $students = Students::all();
    
        foreach ($students as $student) {
            // 学年が3年未満の場合のみ、学年を更新します。
            if ($student->grade < 3) {
                $student->grade += 1;
                $student->save();
            }
        }
    
        // 更新が完了したら一覧画面にリダイレクトします。
        return redirect()->route('students.index');
    }

    //以下、非同期処理追加
    
    //学生一覧検索機能
    public function search(Request $request)
{
    $students = Students::query();

    if ($request->has('name')) {
        $students->where('name', 'like', '%' . $request->name . '%');
    }

    if ($request->has('grade')) {
        $students->where('grade', $request->grade);
    }

    $students = $students->get();

    return response()->json($students);
}

//学生一覧ソート機能
public function sort(Request $request)
{
    $students = Students::query();

    if ($request->has('order')) {
        if ($request->order == 'asc') {
            $students->orderBy('grade', 'asc');
        } else {
            $students->orderBy('grade', 'desc');
        }
    }

    $students = $students->get();

    return response()->json($students);
}


}


