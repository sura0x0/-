@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メニュー一覧') }}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('student.updateAllGrades') }}" method="POST" onsubmit="return confirm('全ての学年を更新しますか？');" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-primary btn-block">全ての学年を更新</button>
                    </form>

                    <a href="{{ url('/student_register') }}" class="btn btn-secondary btn-block">学生登録</a>
                    <a href="{{ url('/index') }}" class="btn btn-secondary btn-block">学生表示</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
