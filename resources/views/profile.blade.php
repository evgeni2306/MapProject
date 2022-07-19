<!DOCTYPE html>
<html>
<head>
    <title>Профиль</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageUnauthorizedMap/css/headerUnauthPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageProfile/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
</head>
<body>
<div class="wrapper">
@if(isset($_SESSION['User']))
    <!--------------HEADER-------------------->
    @include('Components.headerPages')
    <!--------------/HEADER-------------------->
        <div class="content__wrapper">
            @if($user->id == $_SESSION['User']->id)
                <h1 class="profile__title">Мой профиль</h1>
            @endif
            @if($user->id != $_SESSION['User']->id)
                <h1 class="profile__title">Профиль {{$user->nickname}}</h1>
            @endif
@endif

@if(!isset($_SESSION['User']))
    <!--------------HEADER-------------------->
    @include('Components.headerUnauthPages')
    <!--------------/HEADER-------------------->
        <div class="content__wrapper">
            <h1 class="profile__title">Профиль {{$user->nickname}}</h1>
    @endif
        <div class="content__container">
            <div class="user">
                <img class="user__avatar" src="{{$user->avatar}}" alt="avatar">
                <div class="user__name">{{$user->nickname}}</div>
                <div class="user__grade"><img src="{{$roleicon}}" alt="">{{$user->rname}}</div>
            </div>
            <div class="user__info">
                <div class="user__rating">
                    <div class="rating__title title">Рейтинг</div>
                    <div class="rating__points">Набрано очков: <span class="points">{{$user->rating}}</span></div>
                    <div class="rating__level">Уровень: <span>{{$user->rname}}</span></div>
                    @if($user->rankid !=4)
                    <div class="rating__nextlevel">
                        <div class="nextlevel">Следующий уровень: <span class="nextlevel__name">{{$nextrank}}</span></div>
                        <div class="points-received">
                            <span class="points">{{$user->rating}}</span>/<span class="target">{{$user->maxrating}}</span>
                        </div>
                    </div>
                    <div class="rating__nextlevel__progress">
                        <div class="progress-bar">
                            <div class="percent-count"></div>
                        </div>
                    </div>
                    <div class="rating__nextlevel__hint">Делитесь интересными местами, маршрутами, оценивайте и
                        комментируйте существующие, чтобы зарабатывать очки опыта!
                    </div>
                    @endif
                </div>
                <div class="achievements">
                    <div class="achievements__title title">Активность</div>
                    <div class="achievements__cards">
                        <div class="point__count card">
                            <div class="card__count">
                                <img src="/PageProfile/img/point.svg" alt="point">
                                <div class="point__title title">{{$userinfo['points']}}</div>
                            </div>
                            <div class="point__subtitle">меток</div>
                        </div>
                        <div class="route__count card">
                            <div class="card__count">
                                <img src="/PageProfile/img/route.svg" alt="route">
                                <div class="route__title title">{{$userinfo['routes']}}</div>
                            </div>
                            <div class="route__subtitle">маршрутов</div>
                        </div>
                        <div class="feedback__count card">
                            <div class="card__count">
                                <img src="/PageProfile/img/star.svg" alt="star">
                                <div class="feedback__title title">{{$userinfo['comments']}}</div>
                            </div>
                            <div class="feedback__subtitle">отзывов</div>
                        </div>
                    </div>
                </div>
                <div class="transport-model">
                    <div class="transport-model__title title">Модель транспорта</div>
                    <div class="transport-model__type">{{$user->transport}}</div>
                </div>
            </div>
        </div>
    </div>
    <!--------------FOOTER-------------------->
@include('Components.footer')
<!--------------/FOOTER-------------------->
</div>
    @if(isset($_SESSION['User']))
        <!--------------MENU-------------------->
            <script src="Script/menu.js"></script>
            <!--------------MENU-------------------->
    @endif
    @if(!isset($_SESSION['User']))
        <!--------------MENU-------------------->
            <script src="Script/menuUnauth.js"></script>
            <!--------------MENU-------------------->
        @endif
<script>
    /*-------------------------------*/

    /*--------------------------------*/
    let points = document.querySelector('.points').textContent;
    let target = document.querySelector('.target').textContent;
    const progress = document.querySelector('.progress-bar');
    let percent = document.querySelector('.percent-count');
    let result = (points * 100) / target;
    setTimeout(() => {
        progress.style.opacity = 1;
        progress.style.width = result + '%';
        percent.textContent = Math.round(result) + '%';
    })
</script>
</body>
</html>
