<!-- 学生編集画面 -->

@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('学生編集画面') }}</div>
                <div class="card-body">
                <!-- ここに内容入力 -->

                <form action="{{ route('student.update', ['id' => $student->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <p>学生ID：{{ old('student_id', $student->id) }}</p>
                    <p>学年：
                    <select name="grade">
                        <option value="1"@if(1 === (int)old('grade', $student->grade)) selected @endif >1年生</option>
                        <option value="2"@if(2 === (int)old('grade', $student->grade)) selected @endif >2年生</option>
                        <option value="3"@if(3 === (int)old('grade', $student->grade)) selected @endif >3年生</option>
                    </select>
                    </p>
                    <p>氏名：<input type="text" name="name" value="{{ old('name', $student->name) }}"></p>
                    <p>住所：<input type="text" name="address" value="{{ old('address', $student->address) }}"></p>
                    <!-- <p>顔写真：<input type="file" name="img_path" class="form-control" ></p> -->
                    <p>現在の顔写真：
                    @if ($student->img_path !== null)
                    <p><img src="{{ asset('storage/students/' . $student->img_path) }}" width="100"></p>
                    @else
                    画像が未登録です
                    @endif
                    <p>新しい顔写真をアップロード：<input type="file" name="img_path" class="form-control"></p>
                    <p>コメント：<textarea name="comment" class="form-control">{{ old('comment', $student->comment) }}</textarea></p>
                    <div class="d-flex justify-content-start align-items-center">
                        <button class="btn btn-primary mr-5" type="submit">変更</button>　　
                        <a class="btn btn-primary" href="{{ route('show', $student->id) }}">戻る</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
