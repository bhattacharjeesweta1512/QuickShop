<!-- app/Views/auth/login.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<!-- added jquery to send it to database  -->
<!-- Add jQuery library (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

<!-- Add SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <meta charset="UTF-8">
    <title>Login</title>
</head>
<script>
$(document).ready(function() {
    $('#login_form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        

        // Serialize form data
        var formData = $(this).serialize();
        let cunterr = 0;
    let errhtml = "<ul class='swalerrli'>";
        const csrfTestName = formData.csrf_test_name;
      const username = formData.username;
      const password = formData.password;
     
          
            
              if (password == "") {
                cunterr += 1;
                errhtml +=
                  "<li>UserName : <span class='text-danger'>required</span></li>";
              }
            
            
           
              if (password == '') {
                cunterr += 1;
                errhtml +=
                  "<li>Password : <span class='text-danger'>required</span></li>";
              }
         
           
            
     
   
   errhtml += "</ul>";
   if (cunterr != 0) {
      Swal.fire({
        icon: "error",
        title: "Mandatory Inputs Missing!",
        html: errhtml,
      });
    } 
        
        // Send AJAX request
        $.ajax({
            headers: {
        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
    },
            type: 'POST',
            url: $('#login_form').data('url'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                if(response.status == 1 && response.isLoggedIn  == true){
                    Swal.fire({
                    
                    text: response.message,
                    icon: 'success',
                    
                })
                sessionStorage.setItem('username', response.username);
            // Redirect to the 'create' page
            window.location.href = 'create';

                }else{
                    Swal.fire({
                    title: 'Sorry',
                    text: response.message,
                    icon: 'warning',
                    
                })
              

                }
                
            },
           
    });
    });
   
}
   


   
    
    // Function to fetch products via AJAX and update table
 
);
</script>
<body>
    <h2>Login</h2>
   
    <form id ="login_form" data-url="<?= ('login'); ?>">
    <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
        <div>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>

