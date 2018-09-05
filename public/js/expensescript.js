
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();

    //display modal form for creating new product *********************
    $('#btn_add').click(function(){
        $('#btn-save').val("add");
        $('#frmProducts').trigger("reset");
        $('#myModal').modal('show');
    });



    //display modal form for product EDIT ***************************
    $(document).on('click','.open_modal',function(){
        var expense_id = $(this).val();

        // Populate Data in Edit Modal Form
        $.ajax({
            type: "GET",
            url: url + '/' + expense_id,
            success: function (data) {
                console.log(data);
                $('#expense_id').val(data.id);
                $('#name').val(data.name);
                $('#price').val(data.price);

                $('#btn-save').val("update");
                $('#myModal').modal('show');
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });



    //create new product / update existing product ***************************
    $("#btn-save").click(function (e) {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })

        e.preventDefault();
        var formData = {
            name: $('#name').val(),
            price: $('#price').val(),


        }

       // console.log(formData);

        //used to determine the http verb to use [add=POST], [update=PUT]
        var state = $('#btn-save').val();
        var type = "POST"; //for creating new resource
        var expense_id = $('#expense_id').val();;
        var my_url = url;
        if (state == "update"){
            type = "PUT"; //for updating existing resource
            my_url += '/' + expense_id;
        }
        $.ajax({
            type: type,
            url: my_url,
            data: formData,
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var expense = '<tr id="expense' + data.id + '"><td>' + data.id + '</td><td>' + data.name + '</td><td>' + data.price + '</td>';
                expense += '<td><button class="btn btn-warning btn-detail open_modal" value="' + data.id + '">Edit</button>';
                expense += ' <button class="btn btn-danger btn-delete delete-expense" value="' + data.id + '">Delete</button></td></tr>';
                if (state == "add"){ //if user added a new record
                    $('#products-list').append(expense);
                }else{ //if user updated an existing record
                    $("#expense" + expense_id).replaceWith( expense );
                }
                $('#frmProducts').trigger("reset");
                $('#myModal').modal('hide')
            },
            error: function (data) {
                console.log('Error:', data);

                // $('#myModal').append(data.responseText);
               // console.log('Error:', data.responseText);
            }
        });
    });


    //delete product and remove it from TABLE list ***************************
    $(document).on('click','.delete-expense',function(){
        var expense_id = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        })
        $.ajax({
            type: "DELETE",
            url: url + '/' + expense_id,
            success: function (data) {
                console.log(data);
                $("#expense" + expense_id).remove();
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});