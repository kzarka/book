@extends('admin.layouts.main')

@section('title', 'Posts')

@section('content')

<input type="hidden" id="load_post_url" value="{{ route('posts_load_api') }}">
<input type="hidden" id="delete_post_url" value="{{ route('admin_post_delete', '') }}">
<input type="hidden" id="edit_post_url" value="{{ route('admin_edit_post', '') }}">

<div class="col-xs-12">
    <div class="box">                
    <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Table</h3>

            <div class="box-tools pull-right">
                <a href="{{ route('admin_create_post') }}" class="search-submit btn btn-primary">New Post</a>
            </div>
        </div>
        <div class="box-body">
            
            <table id="posts_table" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Public</th>
                        <th>Author</th>
                        <th>Create At</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
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
                <input type="hidden" name="post-id">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Delete Post</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to delete this post?</p>
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

<!-- Modal add category -->
<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="class-id">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Add New Category</h4>
            </div>
            <div class="modal-body">
                    <div class="box-body form-horizontal" id="category_form">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" name="name" class="form-control" placeholder="Name"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Parent</label>
                            <div class="col-sm-4">
                                <select name="parent_id" class="form-control">
                                    <option>Select parent</option>
                                </select>
                            </div>

                            <label class="col-sm-2 control-label">Active</label>
                            <div class="col-sm-4">
                                <select name="active" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-sm-2 control-label">Slug</label>
                            <div class="col-sm-10">
                                <input type="text" name="slug" class="form-control" placeholder="Slug"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" placeholder="Enter ..." name="desc"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="save_btn">Save</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

        
@endsection

@section('js')
<script type="text/javascript">

</script>
<script src="{{ asset('admin/js/posts.js') }}"></script>

@endsection