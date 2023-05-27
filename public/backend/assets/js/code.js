$(document).ready(function(){
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).on('submit','#createcode', function(e){
        e.preventDefault();
        $('.error').html("");
        $('#createcode input').each(function(index,value){
            $(this).removeClass('is-invalid');
        });
        $('#createcode .error').show();
        var insertdata = new FormData($('#createcode')[0]);
        var $this = $(this);

        $.ajax({
            type : "POST",
            url : createcode,
            data : insertdata,
            contentType : false,
            processData : false,
            cache : false,
            async : false,

            beforeSend : function(){
                $($this).find('button[type="submit"]').prop('disabled',true);
            },
            success : function(result){
                
                $($this).find('button[type="submit"]').prop('disabled',false);
                if(result.status == true){
                    $this[0].reset();
                    $('#success').append(`<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success - </strong> ${result.message}!
                </div>`);
                $('#addproductcode').modal('hide');
                $('#code_datatable').DataTable().ajax.reload();
                hidealert();
                }else{
                    first_input = '';
                    $('.error').html("");
                    $.each(result.error, function(key){
                        if(first_input == "") first_input = key;
                        $('#createcode .error-'+key).html(result.error[key]);
                        $('#' + key).addClass('is-invalid');
                    });
                    $('#createcode').find('#' + first_input).focus();
                }
            },
            error : function(error){
                $($this).find('button[type="submit"]').prop('disabled',false);
                alert('Something went wrong!','error');
            }
        });
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
            error : function(error){
                $($this).find('button[type="submit"]').prop('disabled',false);
                alert('Something went wrong!','error');
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



    $('body').on('click','.edit-code',function(){
        var id = $(this).attr('data-id');
        $('.code-id').val(id);

        $.ajax({
            type : "POST",
            url : getcode,
            data : {id : id},
            dataType : 'json',
            success : function(data){
                $('#addproductcode').modal('show');
                $('#code').val(data.code);
                $('#addproductcode').find('button[type="submit"]').html("Update Code");
                $('#addproductcode').find('#exampleModalLabel').html("Update Code");
            }
        });
    });

    $('body').on('click','.delete-code',function(){
        var id = $(this).attr('data-id');

        $.ajax({
            type : "POST",
            url : deletecode,
            data : {id : id},
            dataType : 'json',
            success : function(result){
                $('#success').append(`<div class="alert alert-success alert-dismissible bg-success text-white border-0 fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success - </strong> ${result.message}!
                </div>`);
                $('#code_datatable').DataTable().ajax.reload();
                hidealert();
            }
        });
    });

    var codetable = $('#code_datatable').DataTable({
        processing : true,
        serverSide : true,
        bStateSave: true,
        pageLength: 25,
        ajax : {
            type : "GET",
            url : codelist,
        },
        columns : [
            { data : 'id', name:'product_codes.id'},
            { data : 'code', name:'product_codes.code'},
            { data : 'user_name', name: 'users.user_name'},
            { data : 'created_at',name:'product_codes.created_at',
              render: function(data, type, row) {
                var formattedDate = moment(data).format('D-M-Y h:mm A');
                return formattedDate;
              }
            },
            { data : 'code_checked_on', name:'code_checked_on'},
            { "data": 'id',
               sortable: false,
               render: function(_,_, full){
                var codeid = full['id'];
                if(codeid){
                    var actions='<button class="btn btn-primary btn-sm edit-code m-1" type="button"data-id="'+ codeid + '">Edit</button><a class="btn btn-primary btn-sm delete-code m-1"data-id="'+ codeid + '">delete</a>';
                    return actions;
                    }
                    return '';
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