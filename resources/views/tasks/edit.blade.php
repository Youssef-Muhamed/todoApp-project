

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Task</title>
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


    <h2>Edit Task</h2>
    <form  action="{{ url('/Tasks/'.$data->id) }}" method="post" enctype="multipart/form-data">

        @csrf
        @method('put')
        <input type="hidden" value="{{$data->id}}" name="id">

        <div class="form-group">
            <label for="exampleInputName">Title</label>
            <input type="text" name="title" class="form-control" id="exampleInputName" placeholder="Enter Title" value="{{ $data->title }}">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail">Content</label>
            <textarea  name="description"  class="form-control" id="exampleInputEmail1"  >{{$data->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="exampleInputName">Start Date</label>
            <input type="date" name="sDate" class="form-control" id="exampleInputName"  value="{{ $data->sDate }}">
        </div>
        <div class="form-group">
            <label for="exampleInputName">End Date</label>
            <input type="date" name="eDate" class="form-control" id="exampleInputName" value="{{ $data->eDate }}">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword">Image</label>
            <input type="file" name="image">
            <input type="hidden" name="old_image"  value="{{ $data->image  }}">

        </div>
        <br>

        <img src="{{asset('images/'.$data->image)}}" alt="" height="100px" width="100px">
        <br>
        <br>
        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>

</body>
</html>
