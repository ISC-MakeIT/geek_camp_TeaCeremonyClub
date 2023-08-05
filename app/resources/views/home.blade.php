<p>ようこそ、{{ Auth::user()->name }}さん</p>
<form action="{{ route('logout') }}" method="post">
    @csrf 
    <button type="submit">ログアウト</button>
</form>