@extends('layouts.app')

@if (session('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

@section('content')
<form method="POST" action="{{ route('grade.update', ['id' => $data->id]) }}">
    @csrf
    @method('PUT')

    <p>
    <label for="grade">学年:</label>
    <select name="grade">
        <option value="1"@if(1 === (int)old('grade', $data)) selected @endif>1年生</option>
        <option value="2"@if(2 === (int)old('grade', $data)) selected @endif >2年生</option>
        <option value="3"@if(3 === (int)old('grade', $data)) selected @endif >3年生</option>
    </select>

    <label for="term">学期:</label>
    <select name="term">
        <option value="1"@if(1 === (int)old('term', $data)) selected @endif>1学期</option>
        <option value="2"@if(2 === (int)old('term', $data)) selected @endif>2学期</option>
        <option value="3"@if(3 === (int)old('term', $data)) selected @endif>3学期</option>
    </select>
    </p>

    <label for="japanese">国語:</label>
    <select name="japanese">
        <option value="1"@if(1 === (int)old('japanese', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('japanese', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('japanese', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('japanese', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('japanese', $data)) selected @endif>5</option>
    </select>

    <label for="math">数学:</label>
    <select name="math">
        <option value="1"@if(1 === (int)old('math', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('math', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('math', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('math', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('math', $data)) selected @endif>5</option>
    </select>

    <label for="science">理科:</label>
    <select name="science">
        <option value="1"@if(1 === (int)old('science', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('science', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('science', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('science', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('science', $data)) selected @endif>5</option>
    </select>

    <label for="social_studies">社会:</label>
    <select name="social_studies">
        <option value="1"@if(1 === (int)old('social_studies', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('social_studies', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('social_studies', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('social_studies', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('social_studies', $data)) selected @endif>5</option>
    </select>

    <label for="music">音楽:</label>
    <select name="music">
        <option value="1"@if(1 === (int)old('music', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('music', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('music', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('music', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('music', $data)) selected @endif>5</option>
    </select>
    </p>

    <p>
    <label for="home_economics">家庭科:</label>
    <select name="home_economics">
        <option value="1"@if(1 === (int)old('home_economics', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('home_economics', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('home_economics', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('home_economics', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('home_economics', $data)) selected @endif>5</option>
    </select>

    <label for="engrish">英語:</label>
    <select name="engrish">
        <option value="1"@if(1 === (int)old('engrish', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('engrish', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('engrish', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('engrish', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('engrish', $data)) selected @endif>5</option>
    </select>

    <label for="art">美術:</label>
    <select name="art">
        <option value="1"@if(1 === (int)old('art', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('art', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('art', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('art', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('art', $data)) selected @endif>5</option>
    </select>

    <label for="health_and_physical_education">保健体育:</label>
    <select name="health_and_physical_education">
        <option value="1"@if(1 === (int)old('health_and_physical_education', $data)) selected @endif>1</option>
        <option value="2"@if(2 === (int)old('health_and_physical_education', $data)) selected @endif>2</option>
        <option value="3"@if(3 === (int)old('health_and_physical_education', $data)) selected @endif>3</option>
        <option value="4"@if(4 === (int)old('health_and_physical_education', $data)) selected @endif>4</option>
        <option value="5"@if(5 === (int)old('health_and_physical_education', $data)) selected @endif>5</option>
    </select>
　　　　<input type="submit" value="更新">
    </p>
    <div class="d-flex justify-content-start align-items-center">
    <a class="btn btn-primary" href="{{ route('show', $student->id) }}">戻る</a>
    </div>

    </form>

@endsection
