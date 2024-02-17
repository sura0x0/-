<?php
//学生登録画面用
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//以下、追記
use App\Models\students; // Studentモデルを現在のファイルで使用できるようにするための宣言

class student_registerController extends Controller //コントローラーclass継承（コントローラー機能実装）
{
    public function create()
    {
        return view('student_register');
    }

    public function store(Request $request)
    {
        $student = new students; // 正しいモデル名を使用
        $student->name = $request->name;
        $student->address = $request->address;
        $student->img_path = $request->img_path;

        //保存
        $student->save();

        // リダイレクト処理
        return redirect('/student_register')
            ->with('message','登録完了！');
    }
}
