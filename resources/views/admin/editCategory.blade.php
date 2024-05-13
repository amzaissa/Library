<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('categories.update',$category->id)}}" method="post">
        @method('PUT')
        @csrf
    <label for="">actegory name</label>
    <input type="text" name="name" value="{{$category->name}}"><br>
    <input type="submit" name="update">
    
    </form>
</body>
</html>