<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <title></title>
    <link rel="stylesheet" href="" />
</head>
<body>

Тестовая страница
<?//  echo $_SESSION['CurrentEditPoint']->name.' ';
//echo $_SESSION['CurrentEditPoint']->type.' ';
//echo $_SESSION['CurrentEditPoint']->address.' '; ?>
<form action="{{route('UpdatePoint',1)}}}" method="POST">

    имя<input type="text" name="name" value="{{$_SESSION['CurrentEditPoint']->name}}"><br>
    адрес <input type="text" name="address" value="{{$_SESSION['CurrentEditPoint']->address}}"><br>
    описание<input type="text" name="description" value=" {{$_SESSION['CurrentEditPoint']->description}}"><br>
    <select  required name="type">
        <option value="{{$_SESSION['CurrentEditPoint']->type}}"  style="display:none;">Выберите категорию</option>
        <option value="socket,zpoints">Розетка</option>
        <option value="house,dpoints">Достопримечательность</option>
        </select>
          @csrf
            <input type="submit">
          </p>
</form>
</body>
</html>
