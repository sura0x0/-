@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">学生情報詳細</h1>

    <a href="{{ route('students.index') }}" class="btn btn-primary mt-3">学生一覧画面に戻る</a>

    <div class="row mt-3">
        <div class="col-sm-6">
            <dt>顔写真</dt>
            @if ($student->img_path !== null)
                <dd><img src="{{ asset('storage/students/' . $student->img_path) }}" width="200"></dd>
            @else
                <dd>画像が未登録です</dd>
            @endif
        </div>
        <div class="col-sm-6">
            <dl>
                <dt>氏名</dt>
                <dd>{{ $student->name }}</dd>

                <dt>学年</dt>
                <dd>{{ $student->grade }}</dd>

                <dt>住所</dt>
                <dd>{{ $student->address }}</dd>

                <dt>コメント</dt>
                <dd>{{ $student->comment }}</dd>
            </dl>
        </div>
        <div class="col-sm-6">
            <!-- 学生編集ボタン -->
            <a href="{{ route('student.edit', ['id' => $student->id]) }}" class="btn btn-primary mt-3">学生情報編集</a>
        </div>
    </div>
    <br>
    <div class="col-sm-6">
        <form action="{{ route('student.destroy', ['id' => $student->id]) }}" method="POST" onsubmit="return confirm('本当に削除しますか？');">
            @csrf
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </div>
</div>
<!-- 成績一覧 -->
<br>
<br>
<div class="container">
    <h1>成績一覧</h1>
    <br>
        <!-- 検索フォーム -->
        <form action="{{ route('grade.search', ['id' => $student->id]) }}" method="GET">
    <div class="form-group">
        <label for="grade">学年</label>
        <select name="grade" id="grade" class="form-control">
            <option value="">選択してください</option>
            <option value="1" {{ request('grade') == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ request('grade') == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ request('grade') == 3 ? 'selected' : '' }}>3</option>
        </select>
    </div>
    <div class="form-group">
        <label for="term">学期</label>
        <select name="term" id="term" class="form-control">
            <option value="">選択してください</option>
            <option value="1" {{ request('term') == 1 ? 'selected' : '' }}>1</option>
            <option value="2" {{ request('term') == 2 ? 'selected' : '' }}>2</option>
            <option value="3" {{ request('term') == 3 ? 'selected' : '' }}>3</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">検索</button>
    </form>

    <br>
    <table class="table">
        <thead>
            <tr>
                <th>学年</th>
                <th>学期</th>
                <th>教科</th>
                <th>成績</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>国語</td>
                <td>{{ $grade->japanese }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>数学</td>
                <td>{{ $grade->math }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>科学</td>
                <td>{{ $grade->science }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>社会</td>
                <td>{{ $grade->social_studies }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>音楽</td>
                <td>{{ $grade->music }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>家庭科</td>
                <td>{{ $grade->home_economics }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>英語</td>
                <td>{{ $grade->engrish }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>美術</td>
                <td>{{ $grade->art }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            <tr>
                <td>{{ $grade->grade }}</td>
                <td>{{ $grade->term }}</td>
                <td>保健体育</td>
                <td>{{ $grade->health_and_physical_education }}</td>
                <td><a href="{{ route('grade.edit', ['id' => $grade->id]) }}" class="btn btn-primary btn-sm">編集</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('grade.store', ['id' => $student->id]) }}" class="btn btn-primary mt-3">成績追加</a>
</div>

<!-- 非同期処理 -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#search-form').on('submit', function(e) {
        e.preventDefault();

        var grade = $('#grade').val();
        var term = $('#term').val();

        $.ajax({
            url: '{{ route('grade.search', ['id' => $student->id]) }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'grade': grade,
                'term': term
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var rows = '';
                $.each(response, function(key, value) {
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>国語</td>';
                    rows = rows + '<td>' + value.japanese + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>数学</td>';
                    rows = rows + '<td>' + value.math + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>科学</td>';
                    rows = rows + '<td>' + value.science + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>社会</td>';
                    rows = rows + '<td>' + value.social_studies + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>音楽</td>';
                    rows = rows + '<td>' + value.music + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>家庭科</td>';
                    rows = rows + '<td>' + value.home_economics + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>英語</td>';
                    rows = rows + '<td>' + value.engrish + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>美術</td>';
                    rows = rows + '<td>' + value.art + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td>' + value.term + '</td>';
                    rows = rows + '<td>保健体育</td>';
                    rows = rows + '<td>' + value.health_and_physical_education + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '/edit" class="btn btn-primary btn-sm">編集</a></td>';
                    rows = rows + '</tr>';
                });

                $('tbody').html(rows);
            }
        });
    });
});


@endsection
