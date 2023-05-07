<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>

    <h3> Your account has been created , that is your data</h3>
    <p> Name : {{ $data['name'] }}</p>
    <p> Email : {{ $data['email'] }}</p>
    <p> Password : {{ $data['password'] }}</p>
    <p> Permissions :</p>
    <?php $models = ['users', 'categories', ' orders', 'products'];
    $cruds = ['create', 'read', 'update', 'delete'];
    ?>

    @foreach ($models as $model)

        @foreach ($cruds as $crud)

            @foreach ($data['permission'] as $permission)

                @if ($permission == $model . '_' . $crud)
                    <p>{{ $crud }} {{ $model }}</p>
                @endif

            @endforeach

        @endforeach

    @endforeach



</body>

</html>