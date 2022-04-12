<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Формы</title>
</head>
<body>
<form method="POST" action="{{route('formput')}}" enctype="multipart/form-data" >
    <label><input type="text" name="text"></label>
    <input type="file" name="file">
    <select name = 'spisok'>
        <option >CSV</option>
        <option >GPX</option>
    </select>
        <input type="submit">
@csrf
</form>
</body>
</html>
