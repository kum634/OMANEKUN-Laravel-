<div class="login_info text-right">
  <p class="user text-center">{{ Auth::user()->name }}</p>
  <p class="logout_btn text-center">
    <a href="{{ route('logout') }}"
    onclick="event.preventDefault();
    document.getElementById('logout-form').submit();">
      ログアウト
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
    </form>
  </p>
</div>
