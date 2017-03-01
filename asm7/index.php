<?php
	// Session
	session_start();
	
	// Variables
	$stitle = 'Brandon Nguyen - CTS2857C';
	$ptitle = 'Assignment 7';
	$header = 'CTS2857C';
	$footer = '2016 &copy; Brandon Nguyen';
	
	// Object Vehicle with four properties
  class Vehicle {
		// Properties
    private $Type, $Engine, $Seat, $Direction; 
		// Constructor
    public function __construct($type, $engine, $seat, $direction) {
      $this->Type = $type;
      $this->Engine = $engine;
      $this->Seat = $seat;
      $this->Direction = $direction;
    }
		/* Reset value of Direction always between 0 and 360 */
		private function resetPosition($position) {
			if($position > 360) {
				$position -= 360;
			}
			if($position < 0) {
				$position += 360;
			}
			if($position == 360) {
				$position = 0;
			}
			return $position;
		}
		/* Left method */
		public function left($Direction) {
			/* Get current value respectively to the left */
			$this->Direction = $Direction;
			/* Change value respectively to the left */
			$this->Direction = $this->Direction - 10;
			/* Reset value respectively to the left */
			$this->Direction = $this->resetPosition($this->Direction);
		}
		/* Right method */
		public function right($Direction) {
			/* Get current value respectively to the right */
			$this->Direction = $Direction;
			/* Change value respectively to the right */
			$this->Direction = $this->Direction + 10;
			/* Reset value respectively to the right */
			$this->Direction = $this->resetPosition($this->Direction);
		} 
    // Combine properties
    public function Features() {
      return array('Type'=>$this->Type,'Engine'=>$this->Engine,'Seat'=>$this->Seat,'Direction'=>$this->Direction);
    }
  } // End object Vehicle
	
  // Instantiate Instances
  $car = new Vehicle('Car', 'Small', 4, 0);
  $truck = new Vehicle('Truck', 'Big', 2, 0);
	// Set session variables
	if (!isset($_SESSION['car'])) {
		$_SESSION['car'] = $car->Features();
	}
	if (!isset($_SESSION['truck'])) {
		$_SESSION['truck'] = $truck->Features();
	}
	// Functions for buttons
	function setValue($name,$pos) {
		foreach($_SESSION[$name] as $key=>$value) {
			if($key=='Direction') { 
				$GLOBALS[$name]->$pos($value);
			}
		}		
		$_SESSION[$name] = $GLOBALS[$name]->Features();
		header("Location: index.php");
	}
	if(isset($_POST['cleft'])) {
		setValue('car','left');
	}
	if(isset($_POST['cright'])) {
		setValue('car','right');
	}
	if(isset($_POST['tleft'])) {
		setValue('truck','left');
	} 
	if(isset($_POST['tright'])) {
		setValue('truck','right');
	} 
	// Functions for display
	function display($name) {
		foreach($_SESSION[$name] as $key=>$value) {
			echo "				$key: $value";
			echo "<br>\n";		
		}
	}
	// Header
	include 'header.php';
?>
			<!-- Show form -->
			<form method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
<?php
	// Content
  // Output method for first instance
  echo "				<div class=\"para\">Vehicle 1 info:</div>";
	echo "\n";
	display('car');
?>
				<input type='submit' name='cleft' value='Left' /> 
				<input type='submit' name='cright' value='Right' /> 
				<hr>
<?php
  // Output method for second instance
  echo "				<div class=\"para\">Vehicle 2 info:</div>";
	echo "\n";
	display('truck');
?>
				<input type='submit' name='tleft' value='Left' /> 
				<input type='submit' name='tright' value='Right' /> 
			</form>
<?php
	// Footer
	require 'footer.php';
?>
