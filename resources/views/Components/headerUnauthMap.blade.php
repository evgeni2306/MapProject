<header class="header">
    <div class="header__container">
        <a href="" class="header__logo"><img src="/PageRegistration/img/logo.svg" alt="logo"><p class="header__logo__name">unicycle<span>map</span></p></a>
        <nav class="header__menu menu">
            <ul class="menu__list">
                <li class="menu__item">
                    <button type="button" disabled class="menu__link active-menu" id="menu__link__view"><img
                            src="/PageMap/img/header/02.svg" alt="view"><p class="button-name">Просмотр</p>
                    </button>
                </li>
                <li class="menu__item">
                    <button type="button" disabled class="menu__link" id="menu__link__add-object"><img
                            src="/PageUnauthorizedMap/img/02.svg" alt="object"><p class="button-name">Добавить точку</p>
                    </button>
                    <div class="authorization-popup">
                        <p class="authorization-popup-text">Зарегистрируйтесь или войдите в аккаунт, чтобы добавить точку.</p>
                    </div>
                </li>
                <li class="menu__item">
                    <button type="button" disabled class="menu__link" id="menu__link__add-route"><img
                            src="/PageUnauthorizedMap/img/03.svg" alt="route"><p class="button-name">Проложить маршрут</p>
                    </button>
                    <div class="authorization-popup">
                        <p class="authorization-popup-text">Зарегистрируйтесь или войдите в аккаунт, чтобы проложить маршрут.</p>
                    </div>
                </li>
                <li class="menu__item menu__load-route__mobile">
                    <button type="button" disabled class="menu__link" id="menu__link__load-route__mobile"><img
                            src="/PageMap/img/header/loadroutegray.svg" alt="route">
                    </button>
                </li>
            </ul>
            <li class="menu__load-route">
                <button type="button" disabled class="menu__link" id="menu__link__load-route"><img
                        src="/PageMap/img/header/loadroutegray.svg" alt="route">
                </button>
                <div class="authorization-popup">
                    <p class="authorization-popup-text">Зарегистрируйтесь или войдите в аккаунт, чтобы загрузить маршрут.</p>
                </div>
            </li>
        </nav>
        <div class="menu__icon">
            <span></span>
        </div>
        <div class="authorization-btn">
            <p class="authorization-notification">Войдите или создайте аккаунт</p>
            <a href="{{route('login')}}" class="to-authorization"><img src="/PageUnauthorizedMap/img/04.svg" alt="">Войти</a>
        </div>
    </div>
</header>
