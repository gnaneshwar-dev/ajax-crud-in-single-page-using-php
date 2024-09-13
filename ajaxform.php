<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>form</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js'></script>
  
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="notify.js"></script>

 
     <script>
        $(document).on('submit', '#form', function (e) {
            e.preventDefault();

            $.ajax({
                method: "POST",
                url: "ajax2.php",
                data: $(this).serialize(),
                success:function(response)
                { 
                    console.log(response);
                    var result = JSON.parse(response);
                   
                    if (result['result']['status']['statusCode'] == '0') 
                    {       
                            
                            notification("", "ok", "logged in", "success");
                            viewdetails();
                            
                        } 
                        else 
                        {
                            notification("Error", "exclamation-sign", result['result']['status']['errorMessage'], "error");
                        }                
                }
            });
        });
        

        function notification(title, icon, message, type){
            $.notify({
                // options
                    icon: 'glyphicon glyphicon-'+icon,
                    title: title,
                    message: message,
                    url: '',
                    target: ''
                },{
                // settings
                element: 'body',
                position: null,
                type: type,
                allow_dismiss: true,
                newest_on_top: false,
                showProgressbar: false,
                placement: {
                    from: "top",
                    align: "center"
                },
                offset: 20,
                spacing: 10,
                z_index: 1999,
                delay: 2000,
                timer: 2000,
                url_target: '_blank',
                mouse_over: null,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                },
                onShow: null,
                onShown: null,
                onClose: null,
                onClosed: null,
                icon_type: 'class',
                template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                    '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                    '<span data-notify="icon"></span> ' +
                    '<span data-notify="title">{1}</span> ' +
                    '<span data-notify="message">{2}</span>' +
                    '<div class="progress" data-notify="progressbar">' +
                        '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                    '</div>' +
                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>' 
            });
        }

        $(document).ready(function() 
        {
        $('#form').submit(function(e)
        {
        e.preventDefault();
        });

      viewdetails(); 
});

function viewdetails() {
    $.ajax({
        url: 'ajax3.php',
        method: 'GET',
        success: function(response) {
            var data = JSON.parse(response);
           
            var tableBody = $('#tableBody');
            tableBody.empty();

            $.each(data, function(index, row) 
            {
                var newRow = $('<tr>');
                newRow.append('<td>' + row.emp_id + '</td>');
                newRow.append('<td>' + row.username + '</td>');
                newRow.append('<td>' + row.password + '</td>');
                newRow.append('<td>' + row.phoneno + '</td>');
                newRow.append('<td><button class="editBtn" data-emp_id="' + row.emp_id + '" data-username="' + row.username + '" data-password="' + row.password+'" data-phoneno="' + row.phoneno+'">Edit</button></td>');

                newRow.append('<td><button class="deleteBtn" id="deleteBtn" data-emp_id="' + row.emp_id + '" data-username="' + row.username + '" data-password="' + row.password+'" data-phoneno="' + row.phoneno+'">Delete</button></td></tr>');
                tableBody.append(newRow);
            });
        }
    });
}
</script>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <div class="div">
                <form action="" id="form">
                
                <div>
                <label for="username">username</label>
                </div>
                <div>
                    <input type="text" id="username" name="username">
                </div><br><br>
                <div>
                <label for="password">password</label>
                </div>
                <div>
                <input type="text" id="password" name="password">
                </div>
                <div><br><br>
                <label for="phoneno">phoneno</label>
                </div>
                <div>
                    <input type="text" id="phoneno" name="phoneno">
                </div><br><br>
               
                <input type="hidden" id="emp_id" name="emp_id"> 
                <input type="submit" id="submit" name="submit">
          </form>
            </div>
        </div>

        <div class="view" id="tableContainer">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>user Name</th>
                        <th>password</th>
                        <th>phoneno</th>
                        <th rowspan="2">action</th>
                    </tr>
                </thead>
            <tbody id="tableBody">
                 
                </tbody>
            </table>
        </div>
    </div>
      <!-- this is modal -->
    
<div class="modal fade" id="updateModal" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header" style="color:#fff;background-color: #e35f14;padding:6px;">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Update</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-3">
                        <label>Empid</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="emp_id" class="form-control-sm" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>username</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="username" class="form-control-sm" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>password</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="password" class="form-control-sm" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>phoneno</label>
                    </div>
                    <div class="col-md-9">
                        <input type="text" id="phoneno" class="form-control-sm" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding-bottom:0px !important;text-align:center !important;">
                <p style="text-align:center;float:center;">
                    <button type="button" id="updateBtn" class="btn btn-default btn-sm" style="background-color: #e35f14;color:#fff;">Save</button>
                    <button type="button" class="btn btn-default btn-sm" data-dismiss="modal" style="background-color: #e35f14;color:#fff;">Close</button>
                </p>
            </div>
        </div>
    </div>
</div>

 
    <script>
        // delete
       
   $(document).on("click", "#deleteBtn", function(e)
     { 
        e.preventDefault();
        var emp_id=$(this).attr('data-emp_id');
        var row=$(this).closest('tr');
  
        
        if(confirm("are you sure?"))
        {
		$.ajax({
            method: "POST",
			url: "ajaxdelete.php",
			data:{emp_id:emp_id},
			success: function(response)
            {
                var result = JSON.parse(response);
				if(result['result']['status']['statusCode']==0)
                {
                   console.log(response);
					notification("", "ok", "deleted", "success");
                    viewdetails();
				}
                else
                {
                    notification("", "ok", " not deleted", "error");
                }
			}
		});
	}});

    $(document).on('click', '.editBtn', function () 
    {
        var emp_id = $(this).data('emp_id');
        var username = $(this).data('username');
        var password = $(this).data('password');
        var phoneno = $(this).data('phoneno');

        $('#updateModal #emp_id').val(emp_id);
        $('#updateModal #username').val(username);
        $('#updateModal #password').val(password);
        $('#updateModal #phoneno').val(phoneno);
        $('#updateModal').modal('show');
    });
    

   // update
    $(document).on('click', '#updateBtn', function ()
     {
        var emp_id = $('#updateModal #emp_id').val();
        var username = $('#updateModal #username').val();
        var password = $('#updateModal #password').val();
        var phoneno = $('#updateModal #phoneno').val();

        $.ajax({
            method: 'POST',
            url: 'ajaxupdate.php',
            data: { emp_id: emp_id, username: username, password: password,phoneno: phoneno },
            
            success: function (response)
             {
                var result = JSON.parse(response);
                
                if (result['result']['status']['statusCode']== '0') 
                {   
                    
                    $('#updateModal').modal('hide');
                    notification('', 'ok', 'Data updated successfully!', 'success');
                    viewdetails();
                } else {
                    notification('Error', 'exclamation-sign', 'Failed to update data.', 'error');
                }
            }
        });
    });
</script>

</body>
</html>




