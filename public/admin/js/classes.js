$(document).ready(function() {
    "use strict";

    var className = 'darkknight';
    var awaken = false;

    $('#save').on('click', function (e){
    	let name = $('input[name=name]').val();
        let desc_awaken = $('textarea[name=desc_awaken]').val();
        let desc_normal = $('textarea[name=desc_normal]').val();
        if(!name || !desc_normal || !desc_awaken) {
            console.log('error');
            return;
        }

        $('#class_form').submit();
    });

    $('#classes').on('click', '.delete-class', function (e){
        let id = $(this).data('id');
        $('input[name=class-id]').val(id);
        $('#modal-delete').modal('show');
    });
    
    $('#delete_btn').on('click', function (e){
        let id = $('input[name=class-id]').val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: $('#delete_class_url').val()+'/'+id,
            type: 'delete',
            success: (data, textStatus, xhr) => {
                $('#modal-delete').modal('hide');
                location.reload();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
           }
        });
        
    });

    $('#classes').DataTable({
        'paging'      : true,
        'lengthChange': false,
        'searching'   : false,
        'ordering'    : true,
        'info'        : true,
        'autoWidth'   : false
      })
});