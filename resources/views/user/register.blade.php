@extends('layouts.app')

@section('title', 'ユーザ登録')

@section('content')
    <div class="container mt-4">
        <h1>ユーザ登録</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.register.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">氏名 </label>
                <input type="text" id="name" name="name" required class="form-control" value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">メールアドレス </label>
                <input type="email" id="email" name="email" required class="form-control" value="{{ old('email') }}">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">パスワード </label>
                <input type="password" id="password" name="password" required class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">登録</button>
        </form>
    </div>
@endsection