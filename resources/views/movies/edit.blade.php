@extends('movies.layout')

@section('contents')
    <div class="row mt-5">
        <div class="col-md-12">
            <h2>แก้ไขรายการหนัง :</h2>
            <hr style="width: 90%;">
        </div>
    @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
    @endif  
    <form action="{{ route('movies.update',$movie->id)}}" method="post" >
        @csrf
        @method('PUT')
            <div class="container" style="margin-left:5%;">
             <div class="row ">
                <div class="col-md-10">
                    <div class="form-gtoup">
                        <strong>รหัสผู้ใช้งาน :</strong>
                        <input type="text" disabled name="id" class="form-control" placeholder="Enter id" value="{{$movie->id}}" >
                        <input type="hidden" name="user_id" value="{{$movie->user_id}}">
                     </div>
                </div>
                <div class="col-md-10">
                    <div class="form-gtoup">
                        <strong>Title :</strong>
                        <input type="text" name="Title" value="{{$movie->Title}}" class="form-control"  >
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-gtoup">
                        <strong>Year :</strong>
                        <input type="text" name="Year"value="{{$movie->Year}}" class="form-control" placeholder="Enter Year">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-gtoup">
                        <strong>Type :</strong>
                        <input type="text" name="Type" value="{{$movie->Type}}" class="form-control" placeholder="Enter Type">
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="form-gtoup">
                        <strong>Poster :</strong>
                        <input type="text" name="Poster" value="{{$movie->Poster}}" class="form-control" placeholder="Enter Poster">
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary my-3" style="width:80%;">ยืนยัน</button>
            </div>
    </form>
    </div><br><br><br><br><br>
@endsection

