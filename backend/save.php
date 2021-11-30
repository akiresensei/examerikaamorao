<?php
include 'database.php';

if(count($_POST)>0){
    json_encode($_POST);
	if($_POST['type']==1){
		$prodname=$_POST['prodname'];
		$un=$_POST['un'];
		$price=$_POST['price'];
		$ed=$_POST['ed'];
		$stock=$_POST['stock'];
        // $size=$_POST['fileSize'];
        // $ext=$_POST['ext'];
        // $name = $_POST['fileName'];
        
        $code=mt_rand(10,100000);
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        
        $thePath = $_SERVER['DOCUMENT_ROOT'] . '../uploads/';
        
        $result = move_uploaded_file($_FILES['file']['tmp_name'], $thePath . $code.'.'.$ext);
        $fileUploaded = 'uploads/' . $code.'.'.$ext;
        
        
		$sql = "INSERT INTO `crud`( `prodname`, `un`,`price`,`ed`,`stock`,`file`) 
		VALUES ('$prodname','$un','$price','$ed','$stock','$fileUploaded')";
		if (mysqli_query($conn, $sql)) {
			json_encode(array("statusCode"=>200));
		} 
		else {
			json_encode("Error: " . $sql . "<br>" . mysqli_error($conn));
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==2){
		$id=$_POST['id'];
		$prodname=$_POST['prodname'];
		$un=$_POST['un'];
		$price=$_POST['price'];
		$ed=$_POST['ed'];
		$stock=$_POST['stock'];
        $file=$_POST['file'];
        
        $code=mt_rand(10,100000);
        $ext = strtolower(pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION));
        
        $thePath = $_SERVER['DOCUMENT_ROOT'] . '../uploads/';
        
        $result = move_uploaded_file($_FILES['file']['tmp_name'], $thePath . $code.'.'.$ext);
        $fileUploaded = 'uploads/' . $code.'.'.$ext;
        

		$sql = "UPDATE `crud` SET `prodname`='$prodname',`un`='$un',`price`='$price',`ed`='$ed', `stock`='$stock',`file`='$fileUploaded' WHERE id=$id";
		if (mysqli_query($conn, $sql)) {
			json_encode(array("statusCode"=>200));
		} 
		else {
			json_encode("Error: " . $sql . "<br>" . mysqli_error($conn));
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `crud` WHERE id=$id ";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}
if(count($_POST)>0){
	if($_POST['type']==4){
		$id=$_POST['id'];
		$sql = "DELETE FROM crud WHERE id in ($id)";
		if (mysqli_query($conn, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}

?>
