$(document).ready(function() {
    "use strict";

    var table = null;
    initTable();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('input[name=title]').on('change', function (){
        let slug = toSlug($(this).val());
        $('input[name=slug]').val(slug);
    });

    $('#save_btn').on('click', function (e){
        e.preventDefault();
        if(!$('input[name=title]').val()) {
            $('input[name=title]').addClass('border-red');
            return;
        }
        if(!$('input[name=slug]').val()) {
            $('input[name=slug]').addClass('border-red');
            return;
        }
        let parent = $(this).closest('.box-body');
        parent.find('input').removeClass('border-red');
        $('#post_form').submit();
        return;
    });

    $('#delete_btn').on('click', function (e){
        let id = $('input[name=post-id]').val();
        $.ajax({
            url: $('#delete_post_url').val()+'/'+id,
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

    $('#posts_table').on('click', '.delete-post', function (e){
        let id = $(this).data('id');
        $('input[name=post-id]').val(id);
        $('#modal-delete').modal('show');
    });

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
        $('input[name=name]').val(data.title);
        $('input[name=slug]').val(data.slug);
        $('select[name=active]').val(data.active);
        $("select[name=category]").val(data.selectedCategories).change();
        
        $('select[name=public]').val(data.public);
        
        $('textarea[name=desc]').val(data.content);
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
        str = str.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        str = str.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        str = str.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        str = str.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        str = str.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        str = str.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        str = str.replace(/đ/gi, 'd');

        str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

        return str;
    }

    function initTable() {
        if(table) table.destroy();
        
        table = $('#posts_table').DataTable({
            'paging'      : true,
            'lengthChange': false,
            'searching'   : false,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false,
            "ajax" : {
                "url": $('#load_post_url').val(),
                "type": "POST"
            },
            "columns": [
                { "data": "id" },
                { "data": "title" },
                { 
                    "data": "public",
                    "render": function (data, type, row, meta) {
                        if(data == 1) {
                            return 'Yes';
                        }
                        return 'No';
                    }
                },
                { "data": "author_name" },
                { "data": "created_at" },
                { 
                    "data": "id",
                    "render": function (data, type, row, meta) {
                        let edit_post_url = $('#edit_post_url').val()+'/'+data;
                        let html = '<a href="'+edit_post_url+'" class="edit-post" data-id="'+data+'"><i class="fa fa-cog"></i> </a>'
                            + '<a href="#" title="" class="delete-post" data-id="'+data+'"><i class="fa fa-trash"></i></a>';
                        return html;
                    }
                }
            ]
        });
    }
});