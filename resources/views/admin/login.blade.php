@extends('layouts.login')

@section('content')
    <div class="container mt-4">
        <h1>管理者ユーザーログイン</h1>
        <form action="{{ route('admin.login') }}" method="POST" class="mt-4">
            @csrf
            <table class="table">
                <tr>
                    <td><label for="email">メールアドレス</label></td>
                    <td><input type="email" name="email" id="email" class="form-control" required></td>
                </tr>
                <tr>
                    <td><label for="password">パスワード</label></td>
                    <td><input type="password" name="password" id="password" class="form-control" required></td>
                </tr>
                <tr>
                    <td colspan="2" class="text-center">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    @endsection
