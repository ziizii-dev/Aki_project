<div class="sidebar bg-light p-3" style="width: 250px; height: 100vh; position: fixed; z-index: 100;">
    <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard.index') }}">データ一覧</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">データ登録</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/inquiry">お問い合わせ</a>
        </li>
        @if(Auth::guard('admin')->check())
            <li class="nav-item">
                <a class="nav-link" href="/user">ユーザー管理</a>
            </li>
        @endif
        <li class="nav-link">
            @if(Auth::guard('admin')->check())
                <form action="{{ route('admin.logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="padding: 0;">ログアウト </button>
                </form>
            @else
                <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link" style="padding: 0;">ログアウト </button>
                </form>
            @endif
        </li>
    </ul>
</div>