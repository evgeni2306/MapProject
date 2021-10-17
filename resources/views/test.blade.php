<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="" />
</head>
<body>

Тестовая страница
<?//var_dump($_SESSION['CurrentPoint']) ?>
<?foreach ($_SESSION['Pcomments'] as $pcomment ) {?>
<? var_dump($pcomment->avatar).' ';?>

<? }?>
{{--<form action="{{route('AddPcomment')}}" method="POST">--}}
{{--      <p>Pcomment:<br>--}}
{{--            Text: <input type="text" name="text" value=""><br>--}}
{{--        <select name="rating">--}}
{{--            <option value=1>1</option>--}}
{{--            <option value=2>2</option>--}}
{{--            <option value=3>3</option>--}}
{{--            <option value=4>4</option>--}}
{{--            <option value=5>5</option>--}}
{{--            </select>--}}
{{--          @csrf--}}
{{--            <input type="submit">--}}
{{--          </p>--}}
{{--</form>--}}
</body>
</html>
