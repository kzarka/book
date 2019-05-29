$(document).ready(function() {
    "use strict";

    var table = null;
    initTable();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#new_tip_btn').on('click', function (){
        resetForm();
    	$('#modal-add').modal('show');
    });

    $('#save_btn').on('click', function (){
        let data = getFormData();
        console.log(data);
        let id = $('input[name=id]').val();
        let url = $('#new_tip_url').val()
        if(id) {
            url = $('#update_tip_url').val()+'/'+id;
        }
        if(!data) return;
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: (data, textStatus, xhr) => {
                $('#modal-add').modal('hide');
                initTable();
                resetForm();
            }
        });
    });

    $('#delete_btn').on('click', function (e){
        let id = $('input[name=tip-id]').val();
        $.ajax({
            url: $('#delete_tip_url').val()+'/'+id,
            type: 'delete',
            success: (data, textStatus, xhr) => {
                $('#modal-delete').modal('hide');
                initTable();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
           }
        });
        
    });

    $('#tips_table').on('click', '.delete-tip', function (e){
        let id = $(this).data('id');
        $('input[name=tip-id]').val(id);
        $('#modal-delete').modal('show');
    });

    $('#tips_table').on('click', '.edit-tip', function (e){
        let row = $(this).closest('tr');
        let rowData = table.row(row).data();
        fillFormData(rowData);
        $('#modal-add').modal('show');
    });

    function resetForm() {
        $('#tip_form').find('input, textarea').removeClass('border-red').val('');
        $('#tip_form').find('select').prop('selectedIndex', 0);
    }

    function getFormData() {
        let content = $('textarea[name=content]').val();
        let active = $('select[name=public]').val();
        if(!content) {
            $('textarea[name=content]').addClass('border-red');
            return false;
        }
        return {
            content: content,
            public: active
        }
    }

    function fillFormData(data) {
        $('input[name=id]').val(data.id);
        $('textarea[name=content]').val(data.content);
        $('select[name=public]').val(data.public);
    }


    function initTable() {
        if(table) table.destroy();
        
        table = $('#tips_table').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "ajax" : {
                "headers": $('meta[name="csrf-token"]').attr('content'),
                "url": $('#load_tip_url').val(),
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "content" },
                { 
                    "data": "public",
                    "render": function (data, type, row, meta) {
                        if(data === 1) {
                            return 'Yes';
                        }
                        return 'No';
                    }
                },
                { "data": "created_at" },
                { 
                    "data": "id",
                    "render": function (data, type, row, meta) {
                        let html = '<a href="#" class="edit-tip" data-id="'+data+'"><i class="fa fa-cog"></i> </a>'
                            + '<a href="#" title="" class="delete-tip" data-id="'+data+'"><i class="fa fa-trash"></i></a>';
                        return html;
                    }
                }
            ]
        });
    }
});