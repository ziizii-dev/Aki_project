@extends('layouts.app')

@section('title', 'データ編集')

@section('content')
<div class="container mt-4">
    <h1>データ編集</h1>


<form action="{{ route('dashboard.update', $data->id) }}" method="POST">
    @csrf
    @method('PUT')

  
    <div class="mb-3">
        <label for="title" class="form-label">タイトル</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $data->title) }}" required>
        @error('title')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>


    <div class="mb-3">
        <label for="category" class="form-label">カテゴリ</label>
        <select name="category" class="form-select" required>
            <option value="カテゴリ１" {{ old('category', $data->category) == 'カテゴリ１' ? 'selected' : '' }}>カテゴリ１</option>
            <option value="カテゴリ２" {{ old('category', $data->category) == 'カテゴリ２' ? 'selected' : '' }}>カテゴリ２</option>
            <option value="カテゴリ３" {{ old('category', $data->category) == 'カテゴリ３' ? 'selected' : '' }}>カテゴリ３</option>
        </select>
        @error('category')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

   
    <div class="mb-3">
        <label for="content" class="form-label">本文</label>
        <textarea name="content" class="form-control" rows="5" required>{{ old('content',$data->content) }}</textarea>
        @error('content')
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>


    <button type="submit" class="btn btn-primary">編集</button>
</form>
@endsection
