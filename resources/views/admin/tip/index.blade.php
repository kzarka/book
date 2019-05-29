@extends('admin.layouts.main')

@section('title', 'Classes')

@section('content')

<input type="hidden" id="new_tip_url" value="{{ route('admin_tip_create') }}">
<input type="hidden" id="load_tip_url" value="{{ route('tips_load_api') }}">
<input type="hidden" id="update_tip_url" value="{{ route('admin_tip_update', '') }}">
<input type="hidden" id="delete_tip_url" value="{{ route('admin_tip_delete', '') }}">
<div class="col-xs-12">
    <div class="box">                
    <!-- /.box-header -->
        <div class="box-header with-border">
            <h3 class="box-title">Table</h3>

            <div class="box-tools pull-right">
                <button class="search-submit btn btn-primary" type="submit" id="new_tip_btn">New Tip</button>
            </div>
        </div>
        <div class="box-body">
            
            <table id="tips_table" class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Active</th>
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
                <input type="hidden" name="tip-id">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Delete Tip</h4>
            </div>
            <div class="modal-body">
                <p>Do you want to delete this tip?</p>
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
                    <div class="box-body form-horizontal" id="tip_form">
                        <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Public</label>
                            <div class="col-sm-10">
                                <select name="public" class="form-control">
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" rows="4" placeholder="Enter ..." name="content"></textarea>
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
<script src="{{ asset('admin/js/tips.js') }}"></script>

@endsection