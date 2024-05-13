<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="{{ route('logout') }}"
           onclick="event.preventDefault();
                         document.getElementById('logout-form').submit();">
            {{ __('Logout') }}
        </a><br>
    <a href="{{route('dashboard.create')}}">create books</a>
    <a href="{{route('categories.create')}}">create category</a>
    {{-- <a href="{{route('dashboard.show')}}">view book</a> --}}

    <table>
        <tr>
            <td>#</td>
            <td>Book name</td>
            <td>Auther name</td>
            <td>price</td>
            <td>descreption</td>
            <td>category name</td>
            <td>rate</td>
            <td>Action</td>
        </tr>

        @foreach ($book as $book)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$book->name}}</td>
            <td>{{$book->auther_name}}</td>
            <td>{{$book->price}}</td>
            <td>{{$book->descreption}}</td>
            <td>{{$book->category->name}}</td>
            <td>{{$book->ratings->avg('rate')}}</td>
            <td><a href="{{route('rate',$book->id)}}">rate this book</a></td>
            <td>
                <a href="{{route('dashboard.edit',$book->id)}}">edit</a>
            </td>
            <td>
                <form action="{{route('dashboard.destroy',$book->id)}}" method="post">
                    @method('DELETE')
                    @csrf
                    <input type="submit" value="delete" >
                </form>
            </td>
                
        </tr>
        @endforeach
    </table>
    <table>
        <tr>
            <td>#</td>
            <td>category name</td>
            <td>Action</td>
        </tr>
       <tr>
        @foreach ($category as $category)
            <td>{{$loop->iteration}}</td>
            <td>{{$category->name}}</td>
            <td><a href="{{route('categories.edit',$category->id)}}">edit</a></td>
        
        <td>
            <form action="{{route('categories.destroy',$category->id)}}" method="post">
                @method('DELETE')
                @csrf
                <input type="submit" value="delete" >
            </form>
        </td>
    </tr>
        @endforeach
    </table>
</body>
</html>