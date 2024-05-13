<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('dashboard.update',$book->id)}}" method="post">
        @method('PUT')
        @csrf
        <label for="">book title</label>
        <input type="text" name="name" value="{{$book->name}}"><br>
        <label for="">auther name</label>
        <input type="text" name="auther_name" value="{{$book->auther_name}}"><br>
        <label for="">price</label>
        <input type="text" name="price" value="{{$book->price}}"><br>
        <label for="">descreption</label>
        <input type="text" name="descreption" value="{{$book->descreption}}"><br>
        <select name="category">
            @foreach ($category as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <input type="submit" value="update">
    </form>
</body>
</html>