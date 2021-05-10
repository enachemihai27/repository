@extends('layout.main')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Boards page</h1>
                </div>              
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Boards Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th>user_id</th>
                            <th style="width: 60px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($boards as $board)
                            <tr>
                                <td>{{$board->id}}</td>
                                <td>{{$board->name}}</td>
                                <td>{{$board->user_id}}</td>
                                <td>
                                    <div class="btn-group">
                                    <div class="btn-group">
                                        <button class="btn btn-xs btn-primary" type="button" data-user="{{json_encode($board)}}" data-toggle="modal" data-target="#edit-modal">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button class="btn btn-xs btn-danger" type="button" data-user="{{json_encode($board)}}" data-toggle="modal" data-target="#delete-modal">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                    </div>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            
                </ul>
            </div>
        </div> -->
        <!-- /.card -->



@endsection