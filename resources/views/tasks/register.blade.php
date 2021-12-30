

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <h2>Register</h2>
    <form  action="{{ url('/doRegister') }}" method="post">

        @csrf

        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" name="name" class="form-control" id="exampleInputName" placeholder="Enter Name" value="{{ old('name') }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="email" name="email"  class="form-control" id="exampleInputEmail1"  placeholder="Enter email" value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword"> Password</label>
            <input type="password"  name="password"  class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>


        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>

</body>
</html>

