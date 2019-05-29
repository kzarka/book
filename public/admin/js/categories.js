$(document).ready(function() {
    "use strict";

    var table = null;
    initTable();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name=name]').on('change', function (){
        let slug = toSlug($('input[name=name]').val());
        $('input[name=slug]').val(slug);
    });

    $('#new_cat_btn').on('click', function (){
        resetForm();
    	$('#modal-add').modal('show');
    });

    $('#save_btn').on('click', function (){
        let data = getFormData();
        let id = $('input[name=id]').val();
        let url = $('#new_category_url').val()
        if(id) {
            url = $('#update_category_url').val()+'/'+id;
        }
        if(!data) return;
        $.ajax({
            url: url,
            type: 'POST',
            dataType: 'JSON',
            data: data,
            success: (data, textStatus, xhr) => {
                $('#modal-add').modal('hide');
                loadParents();
                initTable();
                resetForm();
            }
        });
    });

    $('#delete_btn').on('click', function (e){
        let id = $('input[name=category-id]').val();
        $.ajax({
            url: $('#delete_category_url').val()+'/'+id,
            type: 'delete',
            success: (data, textStatus, xhr) => {
                $('#modal-delete').modal('hide');
                loadParents();
                initTable();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
           }
        });
        
    });

    $('#categories_table').on('click', '.delete-cate', function (e){
        let id = $(this).data('id');
        $('input[name=category-id]').val(id);
        $('#modal-delete').modal('show');
    });

    $('#categories_table').on('click', '.edit-cate', function (e){
        let row = $(this).closest('tr');
        let rowData = table.row(row).data();
        fillFormData(rowData);
        $('#modal-add').modal('show');
    });

    function resetForm() {
        $('#category_form').find('input, textarea').removeClass('border-red').val('');
        $("select[name=parent_id]").empty();
        $("select[name=parent_id]").append(new Option('Select parent'));
        for(let i = 0; i < parent.length; i++) {
            $("select[name=parent_id]").append(new Option(parent[i].name, parent[i].id));
        }
        
        $('#category_form').find('select').prop('selectedIndex', 0);
    }

    function getFormData() {
        let name = $('input[name=name]').val();
        let parent_id = 0;
        let slug = $('input[name=slug]').val();
        let active = $('select[name=active]').val();
        let desc = $('textarea[name=desc]').val();
        if(!name) {
            $('input[name=name]').addClass('border-red');
            return false;
        }
        if($('select[name=parent_id]')[0].selectedIndex > 0) {
            parent_id = $('select[name=parent_id]').val();
        }
        return {
            name: name,
            parent_id: parent_id,
            active: active,
            slug: slug,
            desc: desc
        }
    }

    function fillFormData(data) {
        $('input[name=id]').val(data.id);
        $('input[name=name]').val(data.name);
        $('input[name=slug]').val(data.slug);
        $('select[name=active]').val(data.active);
        $("select[name=parent_id]").empty();
        $("select[name=parent_id]").append(new Option('Select parent'));
        for(let i = 0; i < parent.length; i++) {
            if(data.id === parent[i].id) continue;
            $("select[name=parent_id]").append(new Option(parent[i].name, parent[i].id));
        }
        if(data.parent_id === 0) {
            $('select[name=parent_id]')[0].selectedIndex[0];
        } else {
            $('select[name=parent_id]').val(data.parent_id);
        }
        $('textarea[name=desc]').val(data.desc);
    }

    function loadParents() {
        $.ajax({
            url: $('#load_parent_category_url').val(),
            type: 'GET',
            success: (data, textStatus, xhr) => {
                parent = data;
            },
            error: function(xhr) {
                console.log(xhr.responseText);
           }
        });
    }

    function toSlug(str) {
        str = str.replace(/^\s+|\s+$/g, ''); // trim
        str = str.toLowerCase();
        // remove accents, swap ñ for n, etc
        var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
        var to   = "aaaaaeeeeeiiiiooooouuuunc------";
        for (var i=0, l=from.length ; i<l ; i++) {
            str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
        }

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

        return str;
    }

    function initTable() {
        if(table) table.destroy();
        
        table = $('#categories_table').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "ajax" : {
                "headers": $('meta[name="csrf-token"]').attr('content'),
                "url": $('#load_category_url').val(),
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "name" },
                { 
                    "data": "active",
                    "render": function (data, type, row, meta) {
                        if(data === 1) {
                            return 'Yes';
                        }
                        return 'No';
                    }
                },
                { "data": "parent_name" },
                { "data": "created_at" },
                { 
                    "data": "id",
                    "render": function (data, type, row, meta) {
                        let html = '<a href="#" class="edit-cate" data-id="'+data+'"><i class="fa fa-cog"></i> </a>'
                            + '<a href="#" title="" class="delete-cate" data-id="'+data+'"><i class="fa fa-trash"></i></a>';
                        return html;
                    }
                }
            ]
        });
    }
});