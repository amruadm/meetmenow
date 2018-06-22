<div class="row">
    <div class="col-md-12">
    <header>
        <img class="img-responsive" src="logo.png" alt="Нотариус">
    </header>
     </div>
</div>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Нотариус VL</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? "active": ""}}"><a href="{{ route('main') }}">Главная</a></li>
                <li class="{{ Request::is('service') ? "active": ""}}"><a href="{{ route('services') }}">Услуги</a></li>
                <li class="{{ Request::is('about') ? "active": ""}}"><a href="/rates">Тарифы</a></li>

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Информация <span class="caret"></span></a>
                    <ul class="dropdown">
                        <li><a href="{{ route('common') }}">Справочник</a></li>
                        <li><a href="{{ route('heirs') }}">Наследникам</a></li>
                        <li><a href="{{ route('estate') }}">Сделки с недвижимостью</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('corporate') }}">Юридические лица</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('contact') ? "active": ""}}"><a href="{{ route('contact') }}" href="/contact">Контакты</a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())

                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Hello {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown">
                            <li><a href="{{ route('places.index') }}">Места на карте</a></li>
                            <li><a href="{{ route('places.index') }}">События на карте</a></li>
                            <li><a href="{{ route('places.index') }}">Добавленное к местам</a></li>
                            <li><a href="{{ route('places.index') }}">Добавленное к событиям</a></li>
                            <li><a href="{{ route('places.index') }}">Настройки</a></li>
                            <li><a href="{{ route('places.index') }}">Мои маршруты</a></li>

                            <li><a href="{{ route('posts.index') }}">Posts</a></li>
                            <li><a href="{{ route('categories.index') }}">Категории</a></li>
                            <li><a href="{{ route('tags.index') }}">Tags</a></li>
                            <li role="separator" class="divider"></li>
                            <li> <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                    Выход
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>

                @else
                    <a href="{{ route('login') }}" class="btn btn-default">Login</a>
                @endif

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
