@extends('layouts.app')
<!-- 成績登録ページに -->
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('成績登録画面') }}</div>
                <div class="card-body">
                <!-- ここに内容入力 -->

                <form action="{{ route('grade.store', ['id' => $student->id]) }}" method="post">
                    @csrf
                <p>学年：
                    <select name="grade">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </p>
                <p>学期：
                    <select name="term">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </p>
                <p>国語：
                    <select name="japanese">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>数学：
                    <select name="math">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>科学：
                    <select name="science">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>社会：
                    <select name="social_studies">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>音楽：
                    <select name="music">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>社会：
                    <select name="home_economics">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>英語：
                    <select name="engrish">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>美術：
                    <select name="art">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>
                <p>保健体育：
                    <select name="health_and_physical_education">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="3">4</option>
                        <option value="3">5</option>
                    </select>
                </p>



                    <div class="d-flex justify-content-start align-items-center">
                        <button class="btn btn-primary mr-5" type="submit">登録</button>　
                        <a class="btn btn-primary" href="{{ route('show', $student->id) }}">戻る</a>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
