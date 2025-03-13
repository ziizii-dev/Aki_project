@extends('layouts.app')

@section('title', 'ユーザ―データ一覧')

@section('content')
    <div class="container mt-4">
        <h1>ユーザ―データ一覧</h1>

                <a href="{{ route('user.register') }}" class="btn btn-primary mb-3">ユーザー登録</a>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>名前</th>
                            <th>メールアドレス</th>
                          
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">削除</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection