@extends('layouts.app')

@section('title', 'データ一覧')

@section('content')
    <div class="container mt-4">
        <h1>データ一覧</h1>
        <a href="{{ route('dashboard.exportCSV') }}" class="btn btn-primary">CSV出力 (export CSV)</a>
        <table class="table table-bordered">
            <thead class="thead-light">
                <tr>
                    <th>タイトル</th>
                    <th>カテゴリ</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($dataEntries as $entry)
                    <tr>
                        <td>{{ $entry->title }}</td>
                        <td>{{ $entry->category }}</td>
                        <td>
                            <a href="{{ route('dashboard.update', $entry->id) }}" class="btn btn-warning btn-sm">編集</a>
                            <form action="{{ route('dashboard.destroy', $entry->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ route('register') }}" class="btn btn-primary mt-3">データ登録</a>
    </div>
@endsection