<?php
include 'backend/database.php';
define ('SITE_ROOT', realpath(dirname(__FILE__)));

?>
<!DOCTYPE html>
<html lang="en">
<head>
	
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Inventory System</title>
<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="ajax/ajax.js"></script>


 <!-- Bootstrap core CSS -->
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<!-- Latest compiled and minified CSS -->


<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="styles.css">

	
</head>
<body>

<div class="container">

    <!-- Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="modalValidation" data-backdrop="false">
      <div class="modal-dialog validation-modal" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Error!</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p class="message"></p>
          </div>
          <div class="modal-footer">
           <!-- <button type="button" class="btn btn-primary">Save changes</button>-->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end Modal -->
            
	<p id="success"></p>
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6" >
					<h2 class="text-success" style="--bs-text-opacity: .5;">Exam Inventory System</h2>
					</div>
					<div class="col-sm-6">
						<a href="#addModal" class="btn btn-success" data-toggle="modal"><i class="material-icons"></i> <span>Add product</span></a>
						<a href="JavaScript:void(0);" class="btn btn-danger" id="delete_multiple"><i class="material-icons"></i> <span>Delete</span></a>						
					</div>
                </div>
            </div>

            <table class="table table-success table-striped">
			<thead class="thead-dark">
                    <tr>
						<th scope="col">
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
						
						<th scope="col">Stock No.</th>
						<th scope="col">Product Name</th>
                        <th scope="col">Unit</th>
                        <th scope="col">Price</th>
						<th scope="col">Expiry Date</th>
                        <th scope="col">Stock</th>
						<th scope="col">Cost</th>
                        <th scope="col">Image</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
				<tbody>
				
				<?php
				$result = mysqli_query($conn,"SELECT * FROM crud");
					$i=1;
					while($row = mysqli_fetch_array($result)) {
						$formula = $row['price'] * $row['stock'];
				?>
				<tr id="<?php echo $row["id"]; ?>">
				<td>
							<span class="custom-checkbox">
								<input type="checkbox" class="user_checkbox" data-user-id="<?php echo $row["id"]; ?>">
								<label for="checkbox2"></label>
							</span>
						</td>
					<td><?php echo $i; ?></td>
					<td><?php echo $row["prodname"]; ?></td>
					<td><?php echo $row["un"]; ?></td>
					<td>Php<?php echo $row["price"]; ?></td>
					<td><?php echo date('F j, Y',strtotime($row['ed'])); ?></td>
                    <td><?php echo $row["stock"]; ?></td>
					<td> Php <?php echo $formula ?> </td>
					
					<td>
					<div class="parent">
						<img src="<?php echo $row["file"]; ?>">
						</div>
					</td>
					
					<td>
						<a href="#editModal" class="edit" data-toggle="modal">
							<i class="material-icons update" data-toggle="tooltip" 
							data-id="<?php echo $row["id"]; ?>"
							data-prodname="<?php echo $row["prodname"]; ?>"
							data-un="<?php echo $row["un"]; ?>"
							data-price="<?php echo $row["price"]; ?>"
							data-ed="<?php echo $row["ed"]; ?>"
							data-stock="<?php echo $row["stock"]; ?>"
                            data-file="<?php echo $row["file"]; ?>"
							 title="Edit"></i>
						</a>
						<a href="#deleteModal" class="delete" data-id="<?php echo $row["id"]; ?>" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete"></i></a>
                    </td>
				</tr>
				<?php
				$i++;
				}
				?>
				</tbody>
			</table>
			
        </div>
    </div>
	<!-- Add Modal HTML -->
	<div id="addModal" class="modal fade">
	<div class="modal-dialog">
			<div id="addM" class="modal-content">
				<form id="user_form">
					<div class="modal-header">						
						<h4 class="modal-title">Add Product Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" id="prodname" name="prodname" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Unit</label>
							<input type="un" id="un" name="un" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="number" id="price" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Expiry Date</label>
							<input type="date" id="ed" name="ed" class="form-control" required>
						</div>	
						<label>Stock</label>
							<input type="number" id="stock" name="stock" class="form-control" required>
						</div>	
                        <!--image-->
                        <div class="form-group">
							<label>Image</label>
							<input id="uploadImage" type="file" accept="image/*" name="file" class="uploadimg"/>
						</div>	

					<div class="modal-footer">
					    <input type="hidden" value="1" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-success" id="btn-add">Add</button>
						<!-- <button type="button" class="btn btn-success" type="submit">Add</button> -->
                        
					</div>
				</form>
			</div>
		</div>
	</div>
		
	<!-- Edit Modal HTML -->
	<div id="editModal" class="modal fade">
		<div class="modal-dialog">
			<div id="addM" class="modal-content">
				<form id="update_form">
					<div class="modal-header">						
						<h4 class="modal-title">Edit Product Details</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_u" name="id" class="form-control" required>					
						<div class="form-group">
							<label>Product Name</label>
							<input type="text" id="prodname_u" name="prodname" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Unit</label>
							<input type="un" id="un_u" name="un" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Price</label>
							<input type="number" id="price_u" name="price" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Expiry Date</label>
							<input type="date" id="ed_u" name="ed" class="form-control" required>
						</div>	
						<div class="form-group">
							<label>Stock</label>
							<input type="number" id="stock_u" name="stock" class="form-control" required>
						</div>	
                    <!--image-->
                        <div class="form-group">
							<label>IMAGE</label>
							<input id="uploadImage_u" type="file" accept="image/*" name="file" class="uploadimg"/>
						</div>					
					</div>
					<div class="modal-footer">
					<input type="hidden" value="2" name="type">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-info" id="update">Update</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteModal" class="modal fade">
		<div class="modal-dialog">
			<div id="addM" class="modal-content">
				<form>
						
					<div class="modal-header">						
						<h4 class="modal-title">Delete Product</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					</div>
					<div class="modal-body">
						<input type="hidden" id="id_d" name="id" class="form-control">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<button type="button" class="btn btn-danger" id="delete">Delete</button>
					</div>
				</form>
			</div>
		</div>
	</div>

</body>
</html>    