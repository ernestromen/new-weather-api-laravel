<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="resources/css/app.css" rel="stylesheet">
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <title></title>
    </head>
    <body style="background:#009688 !important">
        
    @if($favorites->count() > 0)
        <table class="table table-striped" style="width:50% !important; margin:auto !important; margin-top:20px !important;">
            <thead>
                <tr style="background:#f9f9f9">
                    <th>Flag</th>
                    <th>ID</th>
                    <th>Favorite country</th>
                    <th>Favorite city</th>
                    <th>Creation date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($favorites as $favorite)
                    <tr  class="border border-dark" style="background:#f9f9f9">
                    <td class="pt-0 "><img class="w-50" src="https://flagsapi.com/{{ $favorite->country_flag }}/flat/64.png"/></td>
                        <td>{{ $favorite->id }}</td>
                        <td>{{ $favorite->favorite }}</td>
                        <td>{{ $favorite->favorite_city }}</td>
                        <td>{{ $favorite->created_at}}</td>
                        <td><a href="{{ route('delete_favorite_by_id', ['id' => $favorite->id]) }}" class="btn btn-danger">Delete</a></td>
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <h1 class="text-center">List is empty</h1>
        @endif
        <script src="/js/app.js"></script>
</html>
