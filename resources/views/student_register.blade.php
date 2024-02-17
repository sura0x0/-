@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('学生登録画面') }}</div>
                <div class="card-body">
                <!-- ここに内容入力 -->

                <form action="{{ route('student.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p>氏名：<input type="text" name="name" value="{{ old('name') }}"></p>
                    <p>住所：<input type="text" name="address" value="{{ old('address') }}"></p>
                    <p>顔写真：<input type="file" name="img_path" class="form-control"></p>
                    <div class="d-flex justify-content-start align-items-center">
                        <button class="btn btn-primary mr-5" type="submit">登録</button>
                        <a class="btn btn-primary" href="{{ url('/home') }}">戻る</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
