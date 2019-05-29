@extends('admin.layouts.main')

@section('title', 'Bosses')

@section('content')
<div class="col-lg-7">
    <div class="box box-info">                
    <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Edit Boss</h3>
        </div>
        <form action="{{ route('admin_bosses') }}" method='POST' id="class_form">
            {{ csrf_field() }}
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label">JSON Content</label>
                    <textarea class="form-control" rows="15" placeholder="Enter ..." name="data">{{ $data->data }}</textarea>
                </div>
                
                <input type="submit" type="button" class="pull-right btn btn-default" value="Save" />
            </div>
        </form>
    <!-- /.box-body -->
    </div>
</div>
@endsection