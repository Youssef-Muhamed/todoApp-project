

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tasks</title>
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


    <h2>Create Task</h2>
    <form  action="{{ url('/Tasks') }}" method="post" enctype="multipart/form-data">

        @csrf

        <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputName" placeholder="Enter Title" value="{{ old('title') }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail">Description</label>
            <textarea  name="description"  class="form-control" id="exampleInputEmail1" >{{old('description')}}</textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputName">Start Date</label>
            <input type="date" name="sDate" class="form-control" id="exampleInputName"  >
        </div>
        <div class="form-group">
            <label for="exampleInputName">End Date</label>
            <input type="date" name="eDate" class="form-control" id="exampleInputName">
        </div>


        <div class="form-group">
            <label for="exampleInputPassword">Image</label>
            <input type="file" name="image">
        </div>


        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>

</body>
</html>
