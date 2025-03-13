@extends('layouts.app')

@section('title', 'データ登録')

@section('content')
<div class="container mt-4">
    <h1>データ登録</h1>

    <form action="{{ route('dashboard.store') }}" method="POST" onsubmit="return confirm('データを登録します。よろしいですか？');" novalidate>
        @csrf
       
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <input type="text" id="title" name="title" required class="form-control" value="{{ old('title') }}">
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">カテゴリ</label>
            <select id="category" name="category" required class="form-select">
                <option value="">選択してください</option>
                <option value="カテゴリ１" {{ old('category') == 'カテゴリ１' ? 'selected' : '' }}>カテゴリ１</option>
                <option value="カテゴリ２" {{ old('category') == 'カテゴリ２' ? 'selected' : '' }}>カテゴリ２</option>
                <option value="カテゴリ３" {{ old('category') == 'カテゴリ３' ? 'selected' : '' }}>カテゴリ３</option>
            </select>
            @error('category')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="mb-3">
            <label for="content" class="form-label">本文 </label>
            <textarea id="content" name="content" rows="4" required class="form-control">{{ old('content') }}</textarea>
            @error('content')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        
        <button type="submit" class="btn btn-primary">登録</button>
    </form>
</div>
@endsection