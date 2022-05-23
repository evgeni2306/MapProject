<header class="header">
    <div class="header__container">
        <a href="" class="header__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"><p class="header__logo__name">unicycle<span>map</span></p></a>
        <nav class="header__menu menu">
            <ul class="menu__list">
                <li class="menu__item">
                    <button type="button" class="menu__link active-menu" id="menu__link__view"><img
                            src="/PageMap/img/header/02.svg" alt="view"><p class="button-name">Просмотр</p>
                    </button>
                </li>
                <li class="menu__item">
                    <button type="button" class="menu__link" id="menu__link__add-object"><img
                            src="/PageMap/img/header/03.svg" alt="object"><p class="button-name">Добавить точку</p>
                    </button>
                </li>
                <li class="menu__item">
                    <button type="button" class="menu__link" id="menu__link__add-route"><img
                            src="/PageMap/img/header/04.svg" alt="route"><p class="button-name">Проложить маршрут</p>
                    </button>
                </li>
                <li class="menu__item menu__load-route__mobile">
                    <a href="{{route('loadroute')}}"><div class="menu__link" id="menu__link__load-route"><img
                                src="/PageMap/img/header/loadroute.svg" alt="route">
                        </div></a>
                </li>
            </ul>
            <li class="menu__load-route">
                <a href="{{route('loadroute')}}"><div class="menu__link" id="menu__link__load-route"><img
                            src="/PageMap/img/header/loadroute.svg" alt="route">
                    </div></a>
            </li>
        </nav>
        <div class="menu__icon">
            <span></span>
        </div>
        <nav class="user-menu">
            <ul class="user-menu__list">
                <li class="user-name">
                    <img  class="avatar" src="{{$_SESSION['User']->avatar}}" alt="user">
                    <a href="#" class="user-menu__link" tabindex="1">{{$_SESSION['User']->nickname}}</a><span class="menu__arrow"></span>
                    <ul class="sub-menu__list">
                        <li><a href="{{route('myprofile')}}" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                        <li><a href="{{route('edit')}}" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                        <li><a href="{{route('logout')}}" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
