@extends('movies.layout')
   
@section('contents')

    <section>
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>รายการหลัง :</h2>
                <hr style="width: 90%;">
                <!-- <a href="{{ route('movies.create')}}" class="btn btn-success my-3">Create new post</a> -->
            </div>
            @if($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
            <!-- Start loop show list movie -->
            @foreach($dataMovie as $key => $value)
                <div class="card my-2" style="width: 18rem;">
                    <img class="card-img-top" src="{{$value['Poster']}}" alt="Card image cap">
                    <div class="card-body">
                        <h6 class="card-title">ชื่อเรื่อง :{{$value['Title']}}</h6>
                        <p class="card-text"></p>
                        @if(!empty(Auth::user()->id))
                        <a href="{{ route('insert',[$value['imdbID'],Auth::user()->id])}}" class="btn btn-primary">เพิ่มภาพยนตร์</a>
                        @endif
                    </div>
                </div>
            @endforeach
            </div>
    </section>
        <!--End loop show list movie -->
    <section>
        <br><br>
        @if(!empty(Auth::user()->id))
        <h2>รายการหนังที่เพิ่ม :</h2>
        <hr>        
            <table class="table table-bordered">
                <tr>
                    <th>No.</th>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Type</th>
                    <th>Poster</th>
                    <th width="280px">Action</th>
                </tr>

                @foreach ($data as $key => $value)
                    @if( Auth::user()->id == $value-> user_id)
                    <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $value->Title }}</td>
                        <td>{{ $value->Year }}</td>
                        <td>{{ $value->Type }}</td>
                        <td>{{ Str::limit($value->Poster, 50) }}</td>
                        <td>
                            <form action="{{ route('movies.destroy', $value->id)}}" method="post">
                                <a data-toggle="modal" id="smallButton" data-target="#exampleModal{{ $value->id }}" title="show" class="btn btn-primary">Show</a>
                                <a href="{{ route('movies.edit', $value->id)}}" class="btn btn-primary" >Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                      <!-- Modal -->
                    <div class="modal fade" id="exampleModal{{ $value->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $value->Title }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-gtoup">
                                                <img class="card-img-top" src="{{$value['Poster']}}" alt="Card image cap" style="width:auto; height :100%;">
                                            </div>
                                        </div>
                                    <div class="col-md-7">
                                        <div class="form-gtoup">
                                            <p style="font-size:18px;">ชื่อภาพยนตร์ :  {{ $value->Title }}</p>
                                            <p style="font-size:18px;">ปีที่เข้าฉาย :  {{ $value->Year }}</p>
                                            <p style="font-size:18px;">ประเภทภาพยนตร์ :  {{ $value->Type  }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                @endforeach
            </table>
        {!! $data->links() !!}
        @endif
    </section>
@endsection

