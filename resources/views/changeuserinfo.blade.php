<form method="POST" action="" >
    <p>
        <label>Имя</label>
        <input type="text" name="name" value={{$_SESSION['userinfo']->name}}>
    </p>
    <p>
        <label>Фамилия</label>
        <input type="text" name="surname" value="{{$_SESSION['userinfo']->surname}}">
    </p>
    @csrf
    <input type="submit">
</form>
