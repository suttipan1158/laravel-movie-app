@extends('movies.layout')

@section('content')
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>Add new post</h2>
            <a href="/" class="btn btn-primary">Back</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong>
            there were some problems with your input. <br><br>
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movies.store')}}" method="post">
        @csrf

        <div class="row">
            <div class="col-md-12">
                <div class="form-gtoup">
                    <strong>imdbID :</strong>
                    <input type="text" name="imdbID" class="form-control" placeholder="Enter imdbID">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-gtoup">
                    <strong>user_id :</strong>
                    <input type="text" name="user_id" class="form-control" placeholder="Enter user_id">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-gtoup">
                    <strong>Title :</strong>
                   <textarea name="Title" class="form-control" style="height:"></textarea>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-gtoup">
                    <strong>Year :</strong>
                    <input type="text" name="Year" class="form-control" placeholder="Enter Year">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-gtoup">
                    <strong>Type :</strong>
                    <input type="text" name="Type" class="form-control" placeholder="Enter Type">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-gtoup">
                    <strong>Poster :</strong>
                    <input type="text" name="Poster" class="form-control" placeholder="Enter Poster">
                </div>
            </div>
           
        </div>
            <button type="submit">ยืนยัน</button>
    </form>
@endsection