<header class="header">
    <div class="header__container">
        <a href="" class="header__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"><p class="header__logo__name">unicycle<span>map</span></p></a>
        <nav class="header__menu menu">
            <ul class="menu__list">
                <li class="menu__item">
                    <a href="{{route('map')}}"><button type="button" class="menu__link" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Карта
                        </button></a>
                </li>
            </ul>
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
                        <li><a href="{{route('profile',$_SESSION['User']->id)}}" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                        <li><a href="{{route('getsearch')}}" class="sub-menu__link"><img src="/PageMap/img/icons/search-icon.svg" alt="">Поиск</a></li>
                        <li><a href="{{route('edit')}}" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                        <li><a href="{{route('logout')}}" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</header>
