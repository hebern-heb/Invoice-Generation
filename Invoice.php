<?php
class Invoice{
  
	private $invoiceUserTable = 'invoice_user';	
    private $invoiceOrderTable = 'invoice_order';
	private $invoiceOrderItemTable = 'invoice_order_item';
	private $dbConnect = false;


    public function __construct(){
        if(!$this->dbConnect){ 
            $conn =  new mysqli('localhost', 'admin_mlms_test', 'hNqPD6llt9', 'admin_mlms_test22');

            if($conn->connect_error){
                die("Error failed to connect to MySQL: " . $conn->connect_error);
            }else{
                $this->dbConnect = $conn;
            }
        }
    }
	private function getData($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$data= array();
		while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
			$data[]=$row;            
		}
		return $data;
	}
	private function getNumRows($sqlQuery) {
		$result = mysqli_query($this->dbConnect, $sqlQuery);
		if(!$result){
			die('Error in query: '. mysqli_error());
		}
		$numRows = mysqli_num_rows($result);
		return $numRows;
	}
	
	
	public function saveInvoice($POST) {	
		//print_r($_POST);
		$sqlInsert = "
			INSERT INTO ".$this->invoiceOrderTable."(order_receiver_name, order_receiver_address, order_total_with_tax, order_total_without_tax, order_discount_type,order_tax_amount,order_discount_amount,order_total_discount, order_total_amount) 
			VALUES ( '".$POST['companyName']."', '".$POST['address']."', '".$POST['subTotal']."', '".$POST['taxAmount']."', '".$POST['tax_amnt']."', '".$POST['discount_type']."','".$POST['discount']."','".$POST['discountedAmount']."', '".$POST['amountDue']."')";		
		mysqli_query($this->dbConnect, $sqlInsert);
		$lastInsertId = mysqli_insert_id($this->dbConnect);
		for ($i = 0; $i < count($POST['productName']); $i++) {
			$sqlInsertItem = "
			INSERT INTO ".$this->invoiceOrderItemTable."(order_id, item_name, order_item_quantity, order_item_price,order_item_tax,order_item_tax_amount, order_item_final_amount) 
			VALUES ('".$lastInsertId."',  '".$POST['productName'][$i]."', '".$POST['quantity'][$i]."', '".$POST['price'][$i]."', '".$POST['taxType'][$i]."', '".$POST['taxAmount'][$i]."', '".$POST['total'][$i]."')";			
			mysqli_query($this->dbConnect, $sqlInsertItem);
		}       

	}	
	
	public function getInvoiceList(){
		$sqlQuery = "SELECT * FROM ".$this->invoiceOrderTable;
		return  $this->getData($sqlQuery);
	}	
	public function getInvoice($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderTable." 
			WHERE order_id = '$invoiceId'";
		$result = mysqli_query($this->dbConnect, $sqlQuery);	
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		return $row;
	}	
	public function getInvoiceItems($invoiceId){
		$sqlQuery = "
			SELECT * FROM ".$this->invoiceOrderItemTable." 
			WHERE order_id = '$invoiceId'";
		return  $this->getData($sqlQuery);	
	}
	
}
?>