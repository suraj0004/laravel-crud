<!DOCTYPE html>
<html>

<head>
    <title>Subjects- PDF</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center">
        <h1>{{ $title }}</h1>
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Sno.</th>
                    <th>Title</th>
                    <th>Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($subjects as $subject)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ $subject->title }} </td>
                        <td> {{ $subject->name }} </td>
                        <td> {{ $subject->description }} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
