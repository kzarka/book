@extends('admin.layouts.main')

@section('title', 'Classes')

@section('content')
<input type="hidden" id="delete_class_url" value="{{ route('admin_delete_class', '') }}">
<div class="col-xs-12">
    <div class="box">                
    <!-- /.box-header -->
        <div class="box-body">
            <table id="classes" class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Enable</th>
                        <th>Has Awaken</th>
                        <th>Create At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classes as $class)
                    <tr>
                        <td>{{ $class->name }}</td>
                        <td>{{ $class->active ? 'Yes' : 'No' }}</td>
                        <td>{{ $class->has_awk ? 'Yes' : 'Not Yet' }}</td>
                        <td>{{ $class->created_at }}</td>
                        <td>
                            <a href="{{ route('admin_edit_class', $class->id) }}"><i class="fa fa-cog"></i> </a>
                            <a href="#" title="" class="delete-class" data-id="{{ $class->id }}"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    <!-- /.box-body -->
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade" id="modal-delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="class-id">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Delete Class</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to delete this class?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="delete_btn">Yes</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@endsection

@section('js')
<script src="{{ asset('admin/js/classes.js') }}"></script>
@endsection