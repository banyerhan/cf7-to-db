<?php
function wpcf7_send_to_external ( $cf7 ) {

	//external db details
	$username = 'username';
	$password = 'password';
	$database = 'database';
	$host = 'host_ip';

	//create new wpdb instance
	$mydb = new wpdb($username, $password, $database, $host);
    
    	//limit hook to only fire on particular form ID (optional)
	    if ( $cf7->id == 1 ) {

		//get select box for different enquiry types (optional)
		$type = $cf7->posted_data["your-select"];

		//if form type is equal to above value (optional)
		//optional means if you required condition   
		if ( $type == 'Form Name' ){

			//code added for wordpress 4.9 !important ***
			$cf7 = WPCF7_ContactForm::get_current();
    			$submission = WPCF7_Submission::get_instance();
			$data = $submission->get_posted_data();
			
			
			//get posted form fields
			//these are example form fields
			$field1 = $data["name"];
			$field2 = $data["email"];
			$field3 = $data["address"];
			$field4 = $data["city"];
			$field5 = $data["state"];
			$field6 = $data["zip"];
			$field7 = $data["phone"];
			
			
			//insert into external db
			$mydb->insert( 
				//name of external db table
				'table_name',
				
				//name of table columns and which fields to insert 
				
				array( 
					'name' => $field1, 
					'email' => $field2,
					'address' => $field3,
					'city' => $field4,
					'state' => $field5,
					'zip' => $field6,
					'phone' => $field7	

				),
				//field formats: %s = string, %d = integer, %f = float
				array( 
					'%s','%s','%s','%s','%s','%s','%s'
				) 
			);

		}

	}

}
add_action("wpcf7_before_send_mail", "wpcf7_send_to_external");
?>
