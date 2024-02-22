<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SchoolGrades extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'grade',
        'term',
        'japanese',
        'math',
        'science',
        'social_studies',
        'music',
        'home_economics',
        'engrish',
        'art',
        'health_and_physical_education'
    ];

    public function student()
    {
        return $this->belongsTo(Students::class,'student_id');
    }

    //検索メソッド
//検索メソッド
public static function search($student_id, $keyword_grade, $keyword_term)
{
    // クエリビルダーを初期化
    $query = self::query();

    // 学生IDで絞り込みます。
    $query->where('student_id', $student_id);

    // 学年が指定されている場合、その学年で絞り込みます。
    if (!empty($keyword_grade)) {
        $query->where('grade', $keyword_grade);
    }

    // 学期が指定されている場合、その学期で絞り込みます。
    if (!empty($keyword_term)) {
        $query->where('term', $keyword_term);
    }

    // 絞り込んだ結果を取得
    $grades = $query->get();

    return $grades;
}

}