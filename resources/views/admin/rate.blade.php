<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('addRate',$book->id)}}" method="post">
        @csrf
        <label for="">rate</label>
        <input type="number" name="rate"><br>
        <button type="submit">rate</button>
    </form>
</body>
</html>