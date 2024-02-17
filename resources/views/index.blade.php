@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <!-- 検索機能 -->
            <div>
                <form action="{{ route('students.index') }}" method="GET">

                @csrf

                <input type="text" name="name" placeholder="氏名">
                <select name="grade">
                    <option value="">全学年</option>
                    <option value="1">1年生</option>
                    <option value="2">2年生</option>
                    <option value="3">3年生</option>
                    <!-- 他の学年も同様に追加 -->
                </select>
                <input type="submit" value="検索">
                </form>
            </div>

            <div class="card">
                <div class="card-header">学生一覧</div>
                <table width="100%" border="1">
                    <thead>
                    <tr style="background-color: lightgray">
                        <th>氏名</th>
                        <th>学年</th>
                        <th>詳細</th>
                    </tr>
                    </thead>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td> {{-- 各要素を表示 --}}
                            <td>{{ $student->grade }}</td>
                            <td><a href="{{ route('show', $student->id) }}">詳細</a></td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-2">
            <a href="{{ url('/home') }}" class="btn btn-primary">戻る</a>
        </div>
    </div>
</div>

@endsection
