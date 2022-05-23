<!DOCTYPE html>
<html>
<head>
    <title>Профиль</title>

    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/PageEditPoints/css/headerPages.css">
    <link rel="stylesheet" href="/PageEditPoints/css/footerPages.css">
    <link rel="stylesheet" href="/PageProfile/css/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="../favicon.png"/>
</head>
<body>
<div class="wrapper">
    <!--------------HEADER-------------------->
@include('Components.headerPages')
<!--------------/HEADER-------------------->
    <div class="content__wrapper">
        <h1 class="profile__title">Мой профиль</h1>
        <div class="content__container">
            <div class="user">
                <img class="user__avatar" src="{{$_SESSION['User']->avatar}}" alt="avatar">
                <div class="user__name">{{$_SESSION['User']->nickname}}</div>
                <div class="user__grade"><img src="/PageProfile/img/cool-watermelon.svg" alt="">{{$_SESSION['User']->rname}}</div>
            </div>
            <div class="user__info">
                <div class="user__rating">
                    <div class="rating__title title">Рейтинг</div>
                    <div class="rating__points">Набрано очков: <span class="points">{{$_SESSION['User']->rating}}</span></div>
                    <div class="rating__level">Уровень: <span>{{$_SESSION['User']->rname}}</span></div>
                    <div class="rating__nextlevel">
                        <div class="nextlevel">Следующий уровень</div>
                        <div class="points-received">
                            <span class="points">{{$_SESSION['User']->rating}}</span>/<span class="target">{{$_SESSION['User']->maxrating}}</span>
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
                </div>
                <div class="achievements">
                    <div class="achievements__title title">Активность</div>
                    <div class="achievements__cards">
                        <div class="point__count card">
                            <div class="card__count">
                                <img src="/PageProfile/img/point.svg" alt="point">
                                <div class="point__title title">{{$_SESSION['UserInfo']['points']}}</div>
                            </div>
                            <div class="point__subtitle">меток</div>
                        </div>
                        <div class="route__count card">
                            <div class="card__count">
                                <img src="/PageProfile/img/route.svg" alt="route">
                                <div class="route__title title">{{$_SESSION['UserInfo']['routes']}}</div>
                            </div>
                            <div class="route__subtitle">маршрутов</div>
                        </div>
                        <div class="feedback__count card">
                            <div class="card__count">
                                <img src="/PageProfile/img/star.svg" alt="star">
                                <div class="feedback__title title">{{$_SESSION['UserInfo']['comments']}}</div>
                            </div>
                            <div class="feedback__subtitle">отзывов</div>
                        </div>
                    </div>
                </div>
                <div class="transport-model">
                    <div class="transport-model__title title">Модель транспорта</div>
                    <div class="transport-model__type">{{$_SESSION['User']->transport}}</div>
                </div>
            </div>
        </div>
    </div>
    <!--------------FOOTER-------------------->
@include('Components.footer')
<!--------------/FOOTER-------------------->
</div>
<script src="Script/menu.js"></script>
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
