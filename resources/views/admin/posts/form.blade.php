<?php
use Cartalyst\Sentinel\Native\Facades\Sentinel;
$route = 'admin_create_post';
$isNew = !($post->id);
if(!$isNew) $route = 'admin_edit_post';
?>
@extends('admin.layouts.main')

@section('title', ($isNew) ? 'New Post' : 'Edit Post')

@section('content')
<div class="col-lg-12">
    <div class="box box-info">                
    <!-- /.box-header -->
    	<div class="box-header with-border">
            <h3 class="box-title">{{ ($isNew) ? 'New ' : 'Edit ' }}Post</h3>
        </div>
    	<form action="{{ route($route, $post->id) }}" method='POST' class="" id="post_form">
    		{{ csrf_field() }}
    		<input type="hidden" name="id" value="{{ $post->id }}">
            <input type="hidden" name="author_id" value="{{ $post->author_id ?: Sentinel::getUser()->id }}">
        	<div class="box-body">
            	<div class="form-group">
            		<label>Title</label>
            		<input type="text" name="title" class="form-control" value="{{ $post->title }}" placeholder="Name"/>
            	</div>
                <div class="row">
                    <div class="form-group col-xs-6">
                        <label>Category</label>
                        <select class="form-control select2" multiple="multiple" data-placeholder="Select a Category"
                                    style="width: 100%;" name="category[]">
                            @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                	<div class="form-group col-xs-6">
                		<label>Public</label>
            			<select name="public" class="form-control">
            				<option value="1"{{ ($post->public == 1) ? ' selected' : '' }}>Enable</option>
            				<option value="0"{{ ($post->public == 0) ? ' selected' : '' }}>Disable</option>
            			</select>
                	</div>
                </div>
                <div class="form-group">
                    <label>Slug</label>
                    <input type="text" name="slug" class="form-control" value="{{ $post->slug }}" placeholder="Slug"/>
                </div>
                <div class="form-group">
                    <label>Thumbnail</label>
                    <input type="text" name="thumbnail" class="form-control" value="{{ $post->thumbnail }}" placeholder="Thumbnail"/>
                </div>
                <div class="form-group">
                    <label>Top Image</label>
                    <input type="text" name="top_image" class="form-control" value="{{ $post->top_image }}" placeholder="Top Image"/>
                </div>
            	<div class="form-group">
                  	<label>Content</label>
                  	<textarea class="ckeditor form-control" rows="4" placeholder="Enter ..." name="content">{{ $post->content }}</textarea>
                </div>
                <div class="form-group">
                    <label>Excert</label>
                    <textarea class="form-control" rows="4" placeholder="Enter ..." name="excert">{{ $post->excert }}</textarea>
                </div>
                
                <button type="button" class="pull-right btn btn-default" id="save_btn">Save</button>
        	</div>
        </form>
    <!-- /.box-body -->
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('admin/js/posts.js') }}"></script>
<!-- jQuery 3 -->
<script src="{{ asset('admin/js/ckeditor/ckeditor.js') }}"></script>
<!-- Select 2 -->
<script src="{{ asset('admin/js/select2.full.min.js') }}"></script>
<script>
    $(function () {
        //Initialize Select2 Elements
        $('.select2').select2()
    });
    @if (isset($selectedArray))
    $(document).ready(function() {
        $(".select2").val({{ $selectedArray }}).change();
    });
    @endif
</script>
@endsection