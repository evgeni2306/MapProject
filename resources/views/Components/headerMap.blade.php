<header class="header">
        <div class="header__container">
            <a href="" class="header__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"></a>
            <nav class="header__menu menu">
                <ul class="menu__list">
                    <li class="menu__item">
                        <button type="button" class="menu__link active-menu" id="menu__link__view"><img
                                src="/PageMap/img/header/02.svg" alt="view">Просмотр
                        </button>
                    </li>
                    <li class="menu__item">
                        <button type="button" class="menu__link" id="menu__link__add-object"><img
                                src="/PageMap/img/header/03.svg" alt="object">Добавить объект
                        </button>
                    </li>
                    <li class="menu__item__mobile">
                        <button type="button" class="menu__link" id="menu__link__view__mobile"><img
                                src="/PageMap/img/header/02.svg" alt="view">
                        </button>
                    </li>
                    <li class="menu__item__mobile">
                        <button type="button" class="menu__link" id="menu__link__add-object__mobile"><img
                                src="/PageMap/img/header/03.svg" alt="object">
                        </button>
                    </li>
                    <li class="menu__item__mobile">
                        <button type="button" class="menu__link" id="menu__link__add-route__mobile"><img
                                src="/PageMap/img/header/04.svg" alt="route">
                        </button>
                    </li>
                    <li class="menu__item">
                        <button type="button" class="menu__link" id="menu__link__add-route"><img
                                src="/PageMap/img/header/04.svg" alt="route">Добавить маршрут
                        </button>
                    </li>
                </ul>
            </nav>
            <div class="menu__icon">
                <span></span>
            </div>
            <nav class="user-menu">
                <ul class="user-menu__list">
                    <li class="user-name">
                        <img  class="avatar" src="/PageMap/img/user/user.png" alt="user">
                        <a href="#" class="user-menu__link" tabindex="1">Александр Иванов<!--<img src="/PageMap/img/user/arrow.svg" alt="">--></a><span class="menu__arrow"></span>
                        <ul class="sub-menu__list">
                            <li><a href="{{route('profile')}}" class="sub-menu__link"><img src="/PageMap/img/user/01.svg" alt="">Мой профиль</a></li>
                            <li><a href="{{route('settings')}}" class="sub-menu__link"><img src="/PageMap/img/user/02.svg" alt="">Настройки</a></li>
                            <li><a href="{{route('unauthorizedmap')}}" class="sub-menu__link"><img src="/PageMap/img/user/03.svg" alt="">Выйти</a></li>
                        </ul>
                    </li>
               </ul>
            </nav>
        </div>
    </header>