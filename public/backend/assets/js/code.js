$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit','#importcode', function(e){
        e.preventDefault();
        $('.error').html("");
        $('#importcode input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('#importcode .error').show();
        var insertdata = new FormData(this);
        var $this = $(this);
        var $modalContent = $('#showimport').find('.modal-content');
        $('.ajax-loader').removeClass('d-none');
        $.ajax({
            type : "POST",
            url : importcode,
            data : insertdata,
            dataType: 'json',
            cache:false,
            contentType: false,
            processData: false,
            beforeSend : function(){
                $('#showimport').modal('hide');
                $($this).find('button[type="submit"]').prop('disabled',true);
            },
            success : function(result){
                // $loader.addClass('d-none');
                $('.ajax-loader').addClass('d-none');
                $($this).find('button[type="submit"]').prop('disabled',false);
                if(result.status == true){
                    $this[0].reset();
                    $('#success').append(`<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success - </strong> ${result.message}!
                </div>`);
                $('#showimport').modal('hide');
                $('#code_datatable').DataTable().ajax.reload();
                hidealert();
                }else{
                    first_input = '';
                    $('.error').html("");
                    $.each(result.error, function(key){
                        if(first_input == "") first_input = key;
                        $('#showimport .error-'+key).html(result.error[key]);
                        $('#' + key).addClass('is-invalid');
                    });
                    $('#showimport').find('#' + first_input).focus();
                }
            },
            error : function(xhr){
                $('.ajax-loader').addClass('d-none');
                $($this).find('button[type="submit"]').prop('disabled',false);
                toastr.error(xhr.responseJSON.error);
                
            }
        });
    });

    $('#addproductcode').on('hidden.bs.modal',function(e){
        $('#createcode')[0].reset();
        $('#createcode .error').html("");
        $('#createcode input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('.code-id').val("");
        $('#addproductcode').find('button[type="submit"]').html("Add Code");
        $('#addproductcode').find('#exampleModalLabel').html("Add Code");
    });

    $('#showimport').on('hidden.bs.modal', function(e){
        $('#importcode')[0].reset();
        $('#importcode .error').html("");
        $('#importcode input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });  
    });

    var codetable = $('#code_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        order: [[0, 'desc']], 
        pageLength: 25,
        ajax : {
            type : "GET",
            url : codelist,
        },
        columns : [
            { data : 'id'},
            { data : 'code', name:'code'},            
            { data : 'created_at',name:'created_at',
              render: function(data, type, row) {
                var formattedDate = moment(data).format('D-M-Y h:mm A');
                return formattedDate;
              }
            },            
            
        ],
    });

    function hidealert(){
        window.setTimeout(function() {
            $(".alert").fadeOut();
          }, 10000);
    } 
});