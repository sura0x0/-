<?php

namespace app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SchoolGrades;

// Studentsというクラス作成
class Students extends Model
{
    use HasFactory;


    //  モデルに関連付けるテーブル
    protected $table = 'students';

    //  テーブルに関連付ける主キー
    protected $primaryKey = 'id';

    // 登録・更新可能なカラムの指定
    protected $fillable = [
        'grade',
        'name',
        'address',
        'img_path',
        'comment'
    ];

    
    //リクエストデータを基に管理マスターユーザーに登録する
    public function StudentStore($request)
    {
        // リクエストデータを基に管理マスターユーザーに登録する
        return $this->create([
            'name'             => $request->name,
            'address'          => $request->address,
            'img_path'          => $request->img_path
        ]);
    
    }
    //SchoolGradesと一対多の関係
    public function grades()
    {
        return $this->hasMany(SchoolGrades::class, 'student_id');
    }

}
