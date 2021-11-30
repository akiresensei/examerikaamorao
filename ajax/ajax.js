/* $(document).ready(function(){
    $('.uploadimg').on('change', function() {
        console.log("test");
    var file_data = $(this).prop('files')[0];   
    var form_data = new FormData();
    var ext = $(this).val().split('.').pop().toLowerCase();
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        alert("only jpg and png images allowed");
        return;
    }  
    var picsize = (file_data.size);
    console.log(picsize); 
    if(picsize > 2097152) 
        {
            alert("Image allowd less than 2 mb")
            return;
        }
    form_data.append('file', file_data);   
    $.ajax({
        url: 'upload.php', 
        dataType: 'text',  
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(res){
           console.log(res);
        }
     });
});
})  */

$(document).on('click','#btn-add',function(e) {
    // var data = $("#user_form").serialize();
    var data = $("#user_form");
    var file_data = $('.uploadimg').prop('files')[0];   
    var form_data  = new FormData();
    var ext = $('.uploadimg').val().split('.').pop().toLowerCase();
    var picsize = (file_data.size);
    
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        // alert("only jpg and png images allowed");
        $('.message').text('only jpg and png images allowed');
        $('#modalValidation').modal('show');
        return;
    }  
    
    if(picsize > 2097152) 
    {
        // alert("Image allowed less than 2 mb")
        $('.message').text('Image allowed less than 2 mb');
        $('#modalValidation').modal('show');
        
        return;
    }   

   
    
    var prodname = $(this).closest("form").find("input[name='prodname']").val();
    var un = $(this).closest("form").find("input[name='un']").val();
    var price = $(this).closest("form").find("input[name='price']").val();
    var ed = $(this).closest("form").find("input[name='ed']").val();
    var stock = $(this).closest("form").find("input[name='stock']").val();
    var type = $(this).closest("form").find("input[name='type']").val();
    var image = $(this).closest("form").find("input[name='image']").val();
    
    
    form_data.append('prodname', prodname);
    form_data.append('un', un);
    form_data.append('price', price);
    form_data.append('ed', ed);
    form_data.append('stock', stock);
    form_data.append('type', type);
    form_data.append('file', file);
    form_data.append('file', file_data);
    
    /* var imgData = {
        'ext' : ext
    }; */
    
    // data = data.serialize() + '&' + $.param(imgData);
    
    // console.log("size = " + JSON.stringify(data)); 
    
    
    $.ajax({
        data: form_data,
        type: "post",
        url: "backend/save.php",
        cache: false,
        dataType:'text',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
        success: function(dataResult){
                var dataResult = dataResult;
                console.log("result = " + dataResult);
                if(dataResult.statusCode==200){
                    $('.message').text('Data added successfully !');
                    $('#modalValidation').modal('show');
                    $('#addEmployeeModal').modal('hide');
                    // alert('Data added successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   // alert(dataResult);
                   $('.message').text(dataResult);
                   $('#modalValidation').modal('show');
                }
        },
        error: function(req, err){ console.log('my message ' + err); }
    });
    
    console.log("there");
});
$(document).on('click','.update',function(e) {
    var id=$(this).attr("data-id");
    var prodname=$(this).attr("data-prodname");
    var un=$(this).attr("data-un");
    var price=$(this).attr("data-price");
    var ed=$(this).attr("data-ed");
    var stock=$(this).attr("data-stock");
    var file=$(this).attr("data-file");
    $('#id_u').val(id);
    $('#prodname_u').val(prodname);
    $('#un_u').val(un);
    $('#price_u').val(price);
    $('#ed_u').val(ed);
    $('#stock_u').val(stock);
    $('#file_u').val(file);
});

$(document).on('click','#update',function(e) {
    // var data = $("#update_form").serialize();
    var data = $("#update_form");
    // var file_data = $('#uploadImage_u').prop('files')[0];
    var file_data = $(this).closest("form").find("input[name='file']").prop('files')[0];    
    var form_data  = new FormData();
    var ext = $(this).closest("form").find("input[name='file']").val().split('.').pop().toLowerCase();
    var picsize = (file_data.size);
    
    if ($.inArray(ext, ['png','jpg','jpeg']) == -1)   {
        // alert("only jpg and png images allowed");
        $('.message').text('only jpg and png images allowed');
        $('#modalValidation').modal('show');
        return;
    }  
    
    if(picsize > 2097152) 
    {
        // alert("Image allowed less than 2 mb")
        $('.message').text('Image allowed less than 2 mb');
        $('#modalValidation').modal('show');
        
        return;
    }   
    
    var prodname = $(this).closest("form").find("input[name='prodname']").val();
    var un = $(this).closest("form").find("input[name='un']").val();
    var price = $(this).closest("form").find("input[name='price']").val();
    var ed = $(this).closest("form").find("input[name='ed']").val();
    var stock = $(this).closest("form").find("input[name='stock']").val();
    var type = $(this).closest("form").find("input[name='type']").val();
    var file = $(this).closest("form").find("input[name='file']").val();
    var id = $(this).closest("form").find("input[name='id']").val();
    
    
    form_data.append('prodname', prodname);
    form_data.append('id', id);
    form_data.append('un', un);
    form_data.append('price', price);
    form_data.append('ed', ed);
    form_data.append('stock', stock);
    form_data.append('type', type);
    form_data.append('file', file);
    form_data.append('file', file_data);
    
    $.ajax({
        data: form_data,
        type: "post",
        url: "backend/save.php",
        cache: false,
        dataType:'text',
        contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
        processData: false, // NEEDED, DON'T OMIT THIS
        success: function(dataResult){
                var dataResult = dataResult;
                if(dataResult.statusCode==200){
                    $('#editEmployeeModal').modal('hide');
                    alert('Data updated successfully !'); 
                    location.reload();						
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});
$(document).on("click", ".delete", function() { 
    var id=$(this).attr("data-id");
    $('#id_d').val(id);
    
});
$(document).on("click", "#delete", function() { 
    $.ajax({
        url: "backend/save.php",
        type: "POST",
        cache: false,
        data:{
            type:3,
            id: $("#id_d").val()
        },
        success: function(dataResult){
                $('#deleteEmployeeModal').modal('hide');
                $("#"+dataResult).remove();
        
        }
    });
});
$(document).on("click", "#delete_multiple", function() {
    var user = [];
    $(".user_checkbox:checked").each(function() {
        user.push($(this).data('user-id'));
    });
    if(user.length <=0) {
        alert("Please select records."); 
    } 
    else { 
        WRN_PROFILE_DELETE = "Are you sure you want to delete "+(user.length>1?"these":"this")+" row?";
        var checked = confirm(WRN_PROFILE_DELETE);
        if(checked == true) {
            var selected_values = user.join(",");
            console.log(selected_values);
            $.ajax({
                type: "POST",
                url: "backend/save.php",
                cache:false,
                data:{
                    type: 4,						
                    id : selected_values
                },
                success: function(response) {
                    var ids = response.split(",");
                    for (var i=0; i < ids.length; i++ ) {	
                        $("#"+ids[i]).remove(); 
                    }	
                } 
            }); 
        }  
    } 
});
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function(){
        if(this.checked){
            checkbox.each(function(){
                this.checked = true;                        
            });
        } else{
            checkbox.each(function(){
                this.checked = false;                        
            });
        } 
    });
    checkbox.click(function(){
        if(!this.checked){
            $("#selectAll").prop("checked", false);
        }
    });
});