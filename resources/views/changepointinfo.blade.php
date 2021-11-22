<form method="POST" action="" >
    <p>
        <label>Название</label>
        <input type="text" name="name" value={{$_SESSION['ChangingPoint']->id}}>
    </p>
    <p>
        <label>Название</label>
        <input type="text" name="name" value={{$_SESSION['ChangingPoint']->name}}>
    </p>
    <p>
        <label>Адрес</label>
        <input type="text" name="surname" value="{{$_SESSION['ChangingPoint']->address}}">
    </p>
    <p>
        <label>Описание</label>
        <input type="text" name="surname" value="{{$_SESSION['ChangingPoint']->description}}">
    </p>
    @csrf
    <input type="submit" placeholder="изменить">
</form>
