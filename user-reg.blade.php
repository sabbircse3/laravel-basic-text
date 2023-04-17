<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reg</title>
</head>
<body>
    <h>User Registration</h>
	
	
    <!-- error check start -->
    @if (count($errors) > 0)
        @foreach ($errors->all() as $error)
            <h2>{{ $error }}</h2>
        @endforeach
    @endif
	<!-- error check end -->


    <p style="color: green;font-weight: bold;">{{ Session::get('success') }} {{ Session::put('success',NULL) }}</p>
    <p style="color: red;font-weight: bold;">{{ Session::get('failed') }} {{ Session::put('failed',NULL) }}</p>

    {!! Form::open(['url' =>'save-user','method' => 'post','role' => 'form']) !!}
    <table>
        <tr>
            <td>email</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Register"></td>
        </tr>
    </table>
    {!! Form::close() !!}

</body>
</html>
