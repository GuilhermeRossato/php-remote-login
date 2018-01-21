<?php

class FormKey
{
    //Here we store the generated form key
    private $formKey;
     
    //Here we store the old form key (more info at step 4)
    private $old_formKey;
	
	function __construct()
	{
		//We need the previous key so we store it
		if(isset($_SESSION['form_key']))
		{
			$this->old_formKey = $_SESSION['form_key'];
		}
	}
	
	//Function that validated the form key POST data
	public function validate()
	{
		//We use the old formKey and not the new generated version
		if($_POST['form_key'] == $this->old_formKey)
		{
			//The key is valid, return true.
			return true;
		} else {
			//The key is invalid, return false.
			return false;
		}
	}

     
	private function generateKey()
	{
		$ip = $_SERVER['REMOTE_ADDR'];
		$uniqid = uniqid(mt_rand(), true);
		return md5($ip . $uniqid);
	}

	public function outputKey()
	{
		$this->formKey = $this->generateKey();
		$_SESSION['form_key'] = $this->formKey;
		echo "<input type='hidden' name='form_key' id='form_key' value='".$this->formKey."' />";
	}
}
?>