<?php
	$route = 'admin_create_class';
	$isNew = !($class->id);
	if(!$isNew) $route = 'admin_edit_class';
?>
@extends('admin.layouts.main')

@section('title', ($isNew) ? 'New Class' : 'Edit Class')

@section('content')
<div class="col-lg-7">
    <div class="box box-info">                
    <!-- /.box-header -->
    	<div class="box-header with-border">
            <h3 class="box-title">{{ ($isNew) ? 'New ' : 'Edit ' }}Class</h3>
        </div>
    	<form action="{{ route($route, $class->id) }}" method='POST' class="form-horizontal" id="class_form">
    		{{ csrf_field() }}
    		<input type="hidden" name="id" value="{{ $class->id }}">
        	<div class="box-body">
            	<div class="form-group">
            		<label class="col-sm-2 control-label">Name</label>
            		<div class="col-sm-10">
            			<input type="text" name="name" class="form-control" value="{{ $class->name }}" placeholder="Name"/>
            		</div>
            	</div>
            	<div class="form-group">
            		<label class="col-sm-2 control-label">Enable</label>
            		<div class="col-sm-4">
            			<select name="active" class="form-control">
            				<option value="1"{{ ($class->active === 1) ? ' selected' : '' }}>Enable</option>
            				<option value="0"{{ ($class->active === 0) ? ' selected' : '' }}>Disable</option>
            			</select>
            		</div>

            		<label class="col-sm-2 control-label">Awaken</label>
            		<div class="col-sm-4">
            			<select name="has_awk" class="form-control">
            				<option value="1"{{ ($class->has_awk === 1) ? ' selected' : '' }}>Yes</option>
            				<option value="0"{{ ($class->has_awk === 0) ? ' selected' : '' }}>Not Yet</option>
            			</select>
            		</div>
            	</div>
            	<div class="form-group">
                  	<label class="col-sm-2 control-label">Normal Description</label>
                  	<div class="col-sm-10">
                  		<textarea class="form-control" rows="4" placeholder="Enter ..." name="desc_normal">{{ $class->desc_normal }}</textarea>
                  	</div>
                </div>
                <div class="form-group">
                  	<label class="col-sm-2 control-label">Awaken Description</label>
                  	<div class="col-sm-10">
                  		<textarea class="form-control" rows="4" placeholder="Enter ..." name="desc_awaken">{{ $class->desc_awaken }}</textarea>
                  	</div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Normal Video</label>
                    <div class="col-sm-10">
                        <input type="text" name="normal_video" class="form-control" value="{{ $class->normal_video }}" placeholder="Name"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">Awaken Video</label>
                    <div class="col-sm-10">
                        <input type="text" name="awaken_video" class="form-control" value="{{ $class->awaken_video }}" placeholder="Name"/>
                    </div>
                </div>
                <button type="button" class="pull-right btn btn-default" id="save">Save</button>
        	</div>
        </form>
    <!-- /.box-body -->
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('admin/js/classes.js') }}"></script>
@endsection