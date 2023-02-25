{{--Шапка сайта--}}
<header class="header">
    <div class="header__container container">
        <a href="{{ route('index.index') }}" class="header__logo-content">
            <div class="header__logo">
                <img src="{{ asset('assets/images/logo.png') }}" alt="logo">
            </div>
            <p>С 8 марта!</p>
        </a>
        <nav class="header__nav">
            <ul class="header__menu">
                <li class="header__item"><a href="{{ route('index.index') }}" class="header__link">Главная</a></li>
                <li class="header__item"><a href="/#catalog" class="header__link">Каталог</a></li>
                <li class="header__item"><a href="#" class="header__link">Реклама</a></li>
                @auth
                    @if(\Illuminate\Support\Facades\Auth::user())
                        @if(\Illuminate\Support\Facades\Auth::user()->role === 3)
                            <li class="header__item"><a href="{{ route('admin.show') }}" class="header__link">Админ панель</a></li>
                        @endif
                    @endif
                @endauth
            </ul>
        </nav>
        <div class="header__buttons">
            @guest
                <a href="{{ route('index.login') }}" class="header__button auth-button button">Войти</a>
                <a href="{{ route('index.register') }}" class="header__button reg-button button">Создать</a>
            @endguest
            @auth
                <a href="{{ route('auth.logout') }}" class="header__button auth-button button">Выйти</a>
            @endauth
        </div>
    </div>
</header>
