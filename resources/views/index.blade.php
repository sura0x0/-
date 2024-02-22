@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <!-- 検索機能 -->
            <div>
                <form id="search-form">

                @csrf

                <input type="text" name="name" placeholder="氏名">
                <select name="grade">
                    <option value="">全学年</option>
                    <option value="1">1年生</option>
                    <option value="2">2年生</option>
                    <option value="3">3年生</option>
                    <!-- 他の学年も同様に追加 -->
                </select>
                <input type="submit" value="検索" id="search">
                </form>
            </div>

            <div class="card">
                <div class="card-header">学生一覧</div>
                <table width="100%" border="1">
                    <thead>
                    <tr style="background-color: lightgray">
                        <th>氏名</th>
                        <th>学年
                        <!-- 昇順降順ボタン -->
                        <button id="sort-asc">▲</button>
                        <button id="sort-desc">▼</button>
                        </th>
                        <th>詳細</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($students as $student)
                        <tr>
                            <td>{{ $student->name }}</td> {{-- 各要素を表示 --}}
                            <td>{{ $student->grade }}</td>
                            <td><a href="{{ route('show', $student->id) }}">詳細</a></td>
                        </tr>
                    @endforeach
                    </tbody>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#search').on('click', function(e) {
        e.preventDefault();

        var name = $('input[name="name"]').val();
        var grade = $('select[name="grade"]').val();

        // リクエストデータ作成
        var data = {
            '_token': '{{ csrf_token() }}'
        };

        // 各フィールドが空でない場合にのみ、そのフィールドをリクエストデータに追加
        if (name !== '') {
            data['name'] = name;
        }
        if (grade !== '') {
            data['grade'] = grade;
        }

        $.ajax({
            url: '{{ route('search') }}',
            data: data,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var rows = '';
                $.each(response, function(key, value) {
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.name + '</td>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '">詳細</a></td>';
                    rows = rows + '</tr>';
                });

                $('tbody').html(rows);
            }
        });
    });

    // ソート機能
    $('#sort-asc, #sort-desc').on('click', function(e) {
        e.preventDefault();

        var order = $(this).attr('id') == 'sort-asc' ? 'asc' : 'desc';

        $.ajax({
            url: '{{ route('sort') }}',
            data: {
                '_token': '{{ csrf_token() }}',
                'order': order
            },
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                var rows = '';
                $.each(response, function(key, value) {
                    rows = rows + '<tr>';
                    rows = rows + '<td>' + value.name + '</td>';
                    rows = rows + '<td>' + value.grade + '</td>';
                    rows = rows + '<td><a href="{{ url('/index') }}/' + value.id + '">詳細</a></td>';
                    rows = rows + '</tr>';
                });

                $('tbody').html(rows);
            }
        });
    });
});
</script>

@endsection
