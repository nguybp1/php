<?php
	// Variables
	$stitle = 'CTS2857C';
	$header = 'CTS2857C - Team Project 4';
	$ptitle = 'Order Form';
	$footer = '2016 &copy; Bravo Team';
	$brch = $ctm = '';
	// Require files
	require_once 'database.php'; 
	// Get all fields
	$query1 = "SELECT * FROM branch";
	$branches = $db->query($query1);
	$query2 = "SELECT * FROM customer";
	$customers = $db->query($query2);
	$query3 = "SELECT * FROM items";
	$items = $db->query($query3);
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $brch = trimData($_POST['branch']);
    $ctm = trimData($_POST['customer']);
	};
	function trimData($value) {
		$value = htmlspecialchars(stripslashes(trim($value)));
		return $value;
	};
	function IsSelected($name,$value) {
		if(isset($name) && $name==$value) {
			echo 'selected';
		};
  };
	// Header
	include 'header.php';
?>
	<!-- Display Order form -->
	<form action="order.php" method="post" name="order" id="order">
	  <fieldset>
		<legend>Branch Information</legend><br/>
		  <div id="data"> 
          
		   <!-- List Branch -->
			<label>Branch:</label>
            <select name="branch">
                <option value="">Select One</option>
                <?php foreach ($branches as $branch) : ?>
                    <option value="<?php echo $branch['BranchNo']; ?>" <?php IsSelected($brch,'<?php echo $branch[\'BranchNo\']; ?>');?>><?php echo $branch['BranchNo']; ?></option>
                <?php endforeach; ?>
            </select><small>*</small> <br><br>
				
           <!-- List Customer -->
            <label>Customer:</label>
            <select name="customer">
                <option value="">Select One</option>
                <?php foreach ($customers as $customer) : ?>
                    <option value="<?php echo $customer['CustomerID']; ?>" <?php IsSelected($ctm,'<?php echo $customer[\'CustomerID\']; ?>');?>><?php echo $customer['Name']; ?></option>
                <?php endforeach; ?>
            </select><small>*</small><br><br>
            
           <!-- Input OrderID -->
            <label>Order No:</label>
            <input type="text" size="4" maxlength="4" name="ID"><small>*(Input New Order No.)</small><br><br>
            
           <!-- Display table of items -->
            <table>
                <tr>
                    <th class="smalcol">Item No</th>
                    <th class="bigcol">Description</th>
                    <th class="smalcol">Quantity</th>
                    <th class="smalcol">Price</th>
                </tr>
                <?php foreach ($items as $item) : ?>
                <tr>
                    <td class="right"><input type="hidden" name="ItemNo[]" value="<?php echo $item['ItemNo']; ?>"><?php echo $item['ItemNo']; ?></td>
                    <td><?php echo $item['Description']; ?></td>
                    <td class="right"><input type="text" size="4" maxlength="4" name="quantity[]"></td>
                    <td class="right"><input type="hidden" name="price[]" value="<?php echo $item['Price']; ?>"><?php echo '$'.$item['Price']; ?></td>
                </tr>
                <?php endforeach; ?>
            </table>
	
            <br>
            <small>Select Branch, Customer, input Order Number, input quantity in selected item(s) then click "Place Order" button</small>
		  </div>
      </fieldset>
	
          <div id="buttons">
			<label>&nbsp;</label>
			<input type="submit" value="Place Order"><br>
		  </div>
      <p><a href="index.php" id="home">HOME</a></p>
	  </form>
<?php
	// Footer
	require 'footer.php';
?>
