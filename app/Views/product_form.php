<!-- New Product form  -->
<!DOCTYPE html>
<html>
<head>
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

<h2>Product Form</h2>


<div class="container">
  
  <form id="product-form" data-url="<?= ('/store'); ?>">
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
  <div class="row">
    <input type="submit" value="Submit">
  </div>
  </form>
  
</div>


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
        </tr>
    </thead>
    <tbody>
        <!-- Table rows will be dynamically added here -->
    </tbody>
</table>

</body>
</html>

<!-- added jquery to send it to database  -->
<!-- Add jQuery library (if not already included) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Add SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11">

<!-- Add SweetAlert JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(document).ready(function() {
    $('#product-form').submit(function(e) {
        e.preventDefault(); // Prevent default form submission
        

        // Serialize form data
        var formData = $(this).serialize();
        
        // Send AJAX request
        $.ajax({
            type: 'POST',
            url: $('#product-form').data('url'),
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
                          '</tr>';
                $('#product-table tbody').append(row);
            });
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





