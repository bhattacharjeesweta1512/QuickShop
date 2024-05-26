<!-- New Product form  -->
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
 




<style>
    
* {
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #04AA6D;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row::after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<body>
<div id = "add">
<h2>Product Add Form</h2>


<div class="container">
  
  <form id="product-form" data-url="<?= ('/store'); ?>" method="post" enctype="multipart/form-data">
  
  <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
  
  <input type= "hidden" name ="hidden_username" >
  <div class="row">
    <div class="col-25">
      <label for="name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="name" name="name" placeholder="Enter the Product Name ..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="description">Description</label>
    </div>
    <div class="col-75">
      <input type="text" id="description" name="description" placeholder="Enter the Description ..">
    </div>
   
  </div>
 
  <div class="row">
    <div class="col-25">
      <label for="brand">Brand</label>
    </div>
    <div class="col-75">
    <input type="text" id="brand" name="brand" placeholder="Enter the color ..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="size">Size</label>
    </div>
    <div class="col-75">
    <input type="text" id="size" name="size" placeholder="Enter the size ..">
    </div>
  </div>
  <br> 
  <div class="form-group">
        <label for="csv_file">Upload CSV File:</label>
        <input type="file" class="form-control-file" id="csv_file" name="csv_file" accept=".csv" multiple
        onchange="Filechange(event)"> 
    </div>
    <button type="submit" id="uploadButton" class="btn btn-primary">Upload</button>


  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
  
  </div>
</div>

<div id = "edit" style="display: none;" >
<h2>Product Edit Form</h2>


<div class="container">
  
  <form id="edit_product-form" data-url="<?= ('/updateProducts'); ?>">
  <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
  <div class="row">
  <input type="hidden" id="edit_id" name="edit_id" >
    <div class="col-25">
      <label for="edit_name">Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="edit_name" name="edit_name" placeholder="Enter the Product Name ..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="edit_description">Description</label>
    </div>
    <div class="col-75">
      <input type="text" id="edit_description" name="edit_description" placeholder="Enter the Description ..">
    </div>
   
  </div>
 
  <div class="row">
    <div class="col-25">
      <label for="brand">Brand</label>
    </div>
    <div class="col-75">
    <input type="text" id="edit_brand" name="edit_brand" placeholder="Enter the color ..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="edit_size">Size</label>
    </div>
    <div class="col-75">
    <input type="text" id="edit_size" name="edit_size" placeholder="Enter the size ..">
    </div>
  </div>
  <br>
  <div class="row">
    <input type="submit" value="Update">
  </div>
  </form>
  
  </div>
</div>
<!-- Include jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
  function companyChange(event) {
    // You can handle file selection change here if needed
    console.log(event.target.files);
    
}

    $('#uploadButton').click(function(e) {
        e.preventDefault(); // Prevent default form submission
        var formData = $(this).serialize();
        console.log(formData);
        
        

        $.ajax({
            type: 'POST',
            url: '<?= base_url('uploadCSV') ?>',
            data: formData,
            processData: false, // Prevent jQuery from processing data
            contentType: false, // Prevent jQuery from setting content type
            success: function(response) {
                // Handle success response
                console.log(response);
                // Redirect or display success message as needed
            },
            error: function(xhr, status, error) {
                // Handle error response
                console.error(xhr.responseText);
                // Display error message to user
            }
        });
    });
});
</script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JavaScript -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

  </script>
 
 



<style>
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {background-color: #f2f2f2;}
</style>
<div style="overflow-x: auto;">
<table id="product-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Brand</th>
            <th>Size</th>
            <th>User</th>
            <th>Date of creation</th>
            <th>Date of Updation</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <!-- Table rows will be dynamically added here -->
    </tbody>
</table>


</body>
</html>



<script>
$(document).ready(function() {
    $('#product-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        var username = sessionStorage.getItem('username');
        console.log("username",username);
    // Select the element with the ID 'hidden_username' using jQuery
      // Set the value of the input field with the name attribute "hidden_username" using jQuery
$('[name="hidden_username"]').val(username);


 
  
// Clear username from session storage (optional)

        // Serialize form data
        var formData = $(this).serialize();
        console.log("formData",formData);
        let cunterr = 0;
    let errhtml = "<ul class='swalerrli'>";
        const csrfTestName = formData.csrf_test_name;
      const name = formData.name;
      const description = formData.description;
      const brand = formData.brand;
      const size = formData.size;
      
          
            
              if (name == "") {
                cunterr += 1;
                errhtml +=
                  "<li>Name : <span class='text-danger'>required</span></li>";
              }
            
            
           
              if (description == '') {
                cunterr += 1;
                errhtml +=
                  "<li>Description : <span class='text-danger'>required</span></li>";
              }
         
            if (brand == "") {
              
                cunterr += 1;
                errhtml +=
                  "<li>Brand : <span class='text-danger'>required</span></li>";
              }
            
           
              if (size == "") {
                cunterr += 1;
                errhtml +=
                  "<li>Size : <span class='text-danger'>required</span></li>";
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
            url: $('#product-form').data('url'),
            data: formData,username,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                if(response.status == 1){
                    Swal.fire({
                    title: 'Congratulations',
                    text: response.message,
                    icon: 'success',
                    
                })
                fetchProducts();
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
    $('#edit_product-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        

        // Serialize form data
        var formData = $(this).serialize();
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: $('#edit_product-form').data('url'),
            data: formData,
            dataType: 'json',
            success: function(response) {
                // Handle success response
                console.log(response);
                if(response.status == 1){
                    Swal.fire({
                    title: 'Congratulations',
                    text: response.message,
                    icon: 'success',
                    
                })
                fetchProducts();
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



   
    
    // Function to fetch products via AJAX and update table
   function fetchProducts() {
    $.ajax({
        headers: {
        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
    },
        url: 'getProducts',
        type: 'GET',
        dataType: 'json',
        success: function(response) {
            // Clear existing table data
            $('#product-table tbody').empty();

            // Loop through fetched products and append rows to table
            $.each(response, function(index, product) {
                var row = '<tr>' +
                            '<td>' + product.id + '</td>' +
                            '<td>' + product.name + '</td>' +
                            '<td>' + product.description + '</td>' +
                            '<td>' + product.brand + '</td>' +
                            '<td>' + product.size + '</td>' +
                            '<td>' + product.username + '</td>' +
                            '<td>' + product.doc + '</td>' +
                            '<td>' + product.dou + '</td>' +
                            '<td>' +
                                '<button class="btn btn-primary btn-edit" data-id="' + product.id + '">Edit</button>' +
                                '<button class="btn btn-danger btn-delete" data-id="' + product.id + '">Delete</button>' +
                            '</td>' +
                          '</tr>';
                $('#product-table tbody').append(row);
            });

            // Attach event listeners for edit and delete buttons
           // Event listener for edit button
           $(document).ready(function() {  
            
            
        
       $('.btn-delete').click(function() {
        var productId = $(this).data('id');
        
        // Confirm deletion with user (optional)
        if (confirm('Are you sure you want to delete this product?')) {
            // AJAX request to delete the product
            $.ajax({
                headers: {
        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
    },
                url: 'delete/' + productId,
                type: 'GET',
                
                success: function(response) {
                    // Handle success response, e.g., remove the deleted product from the UI
                    console.log(response);
                    if(response.status == 1){
                    Swal.fire({
                   
                    text: response.message,
                    icon: 'success',
                    
                })
                fetchProducts();
                }else{
                    Swal.fire({
                    title: 'Sorry',
                    text: response.message,
                    icon: 'warning',
                    
                })
              

                }

                },
                error: function(xhr, status, error) {
                    // Handle error response
                    console.error(xhr.responseText);
                }
            });
        }
    });
       $('.btn-edit').click(function() {
          
          var productId = $(this).data('id');
          // Assuming you have a function to fetch product details by ID
          // and populate the edit form fields
          fetchProductDetails(productId);
          $('#edit').show(); // Assuming you have an element with id 'successMessage'
          $('#add').hide();  
          
      });
    });


          
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
            // Handle error
        }
    });
}






 
        
        // Function to fetch product details by ID and populate the edit form fields
        function fetchProductDetails(productId) {
            // AJAX request to fetch product details
            $.ajax({
                headers: {
        'X-CSRF-TOKEN': '<?= csrf_hash() ?>'
    },
                url: 'getProductDetails/' + productId,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log("response",response);

                    // Assuming you have form fields with IDs for editing
                    $('#edit_id').val(response.id);
                    $('#edit_name').val(response.name);
                    $('#edit_description').val(response.description);
                    $('#edit_brand').val(response.brand);
                    $('#edit_size').val(response.size);

                    // Populate other form fields similarly
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    // Handle error
                }
            });
        }
    });





    // Call fetchProducts function to load products on page load
    
</script>





