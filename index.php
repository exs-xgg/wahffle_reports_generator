<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<?php 
	require_once 'hf.php';
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "root";
	
	/*if(!isset($_POST['rhu']))
	{
		$_POST['rhu']=$dbarray;
	}*/
?>

<html>

	<head>
		<title>Wireless Access for Health</title>
	
		<link rel="stylesheet" type="text/css" href="src/jquery-ui-1.8.13.custom.css">
	    <link rel="stylesheet" type="text/css" href="src/ui.dropdownchecklist.themeroller.css">
		<!-- Include the basic JQuery support (core and ui) -->
	    <script type="text/javascript" src="src/jquery-1.6.1.min.js"></script>
	    <script type="text/javascript" src="src/jquery-ui-1.8.13.custom.min.js"></script>
	    
	    <!-- Include the DropDownCheckList supoprt -->
	    <!-- <script type="text/javascript" src="ui.dropdownchecklist.js"></script> -->
	    <script type="text/javascript" src="src/ui.dropdownchecklist-1.4-min.js"></script>
	    
	    <!-- Apply dropdown check list to the selected items  -->
	    <script type="text/javascript">
	        $(document).ready(function() {
	            $("#s1").dropdownchecklist();
	            $("#s2").dropdownchecklist( {icon: {}, width: 150 } );
	            $("#s3").dropdownchecklist( { width: 150 } );
	            $("#s4").dropdownchecklist( { maxDropHeight: 150 } );
	            $("#s5").dropdownchecklist( { maxDropHeight: 500, firstItemChecksAll: true, explicitClose: '...close' } );
	            $("#s6").dropdownchecklist();
	            $("#s7").dropdownchecklist();
	            $("#s8").dropdownchecklist( { emptyText: "Please Select...", width: 150 } );
	            $("#s9").dropdownchecklist( { textFormatFunction: function(options) {
	                var selectedOptions = options.filter(":selected");
	                var countOfSelected = selectedOptions.size();
	                switch(countOfSelected) {
	                    case 0: return "<i>Nobody<i>";
	                    case 1: return selectedOptions.text();
	                    case options.size(): return "<b>Everybody</b>";
	                    default: return countOfSelected + " People";
	                }
	            } });
	            $("#s4").dropdownchecklist( { forceMultiple: true
	, onComplete: function(selector) {
		var values = "";
	  	for( i=0; i < selector.options.length; i++ ) {
	    	if (selector.options[i].selected && (selector.options[i].value != "")) {
	      		if ( values != "" ) values += ";";
	      		values += selector.options[i].value;
	    	}
	  	}
	  	alert( values );
	} 
	, onItemClick: function(checkbox, selector){
		var justChecked = checkbox.prop("checked");
		var checkCount = (justChecked) ? 1 : -1;
		for( i = 0; i < selector.options.length; i++ ){
			if ( selector.options[i].selected ) checkCount += 1;
		}
	    if ( checkCount > 3 ) {
			alert( "Limit is 3" );
			throw "too many";
		}
	}
	            });
	        });
	    </script>
			<style type="text/css">
			form,label,body {
				font-size: 12pt;
				font-family: Arial;
			}
			
			table {
				border-collapse: collapse;
				font-size: 10pt;
				font-family: Sans-Serif;
			}
			
			th,td {
				border: 1px solid black;
				margin: 0;
				text-align: center;
			}
			.mouse:hover {
				background-color:yellow;
			}

			.noborderleft {
				border-left-style: none;
			}
			
			.noborderright {
				border-right-style: none;
			}
			
			.bold,label,legend {
				font-weight: bold;
			}
			
			
			#container {
				padding: 20px 0 0 30px;
			}
			
			#tab {
				width: 80%;
				margin: 20px 0 0 5%;
			}
			
		</style>
	</head>
	
	<body>
    	<div id='container'>
        
		<form method='post' action='' name='form_statistics'>
			<div class='container1'>
          			<select id='s8' name='rhu'>
			              <?php 
			  		foreach($dbarray as $key => $value){
					if($_POST['rhu'] == $value){
						$rhu = $key;
					}
					  echo "<option value='$value' ".($_POST['rhu'] == $value ? 'selected' : '').">$key</option>";
					}
			 	      ?>
          			  </select>
				  <input type='submit' name='go' value='Submit'>
			</div>
        	
		</form>
		
		
		<?php
			if (isset($_REQUEST['go']) && $_REQUEST['go'] == 'Submit')
			{
				
					$dbName = $_POST['rhu'];
	
					$dbConnect = mysql_connect($dbHost,$dbUser,$dbPass);
					mysql_select_db($dbName,$dbConnect);
					
		$querypr1 = mysql_query("SELECT * FROM phie_response  WHERE data_type LIKE '%PatientData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querypr2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PatientData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querypr3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PatientData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryprdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%PatientData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querype1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%EncounterData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querype2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%EncounterData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querype3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%EncounterData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querypedate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%EncounterData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querypmh1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querypmh2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querypmh3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querypmhdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");



		$querypsh1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querypsh2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querypsh3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querypshdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryfhd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryfhd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryfhd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryfhdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querypshd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PersonalSocialHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querypshd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PersonalSocialHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querypshd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PersonalSocialHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querypshddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%PersonalSocialHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryihdc1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryihdc2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryihdc3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryihdcdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryihdyw1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryihdyw2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryihdyw3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryihdywdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryihdp1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryihdp2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryihdp3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryihdpdate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryihde1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryihde2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryihde3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryihdedate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querymhd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%MenstrualHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querymhd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%MenstrualHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querymhd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%MenstrualHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querymhddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%MenstrualHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryphd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PregnancyHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryphd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PregnancyHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryphd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%PregnancyHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryphddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%PregnancyHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryfad1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%FamilyAccessData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryfad2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%FamilyAccessData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryfad3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%FamilyAccessData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryfaddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%FamilyAccessData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querydmi1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DrugMedicineIntakeData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querydmi2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DrugMedicineIntakeData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querydmi3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DrugMedicineIntakeData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querydmidate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%DrugMedicineIntakeData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryvsd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%VitalSignData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryvsd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%VitalSignData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryvsd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%VitalSignData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryvsddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%VitalSignData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");

	
		$querysd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%SkinData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querysd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%SkinData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querysd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%SkinData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querysddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%SkinData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryhd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%HeentData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryhd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%HeentData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryhd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%HeentData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryhddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%HeentData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querycld1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ChestLungsData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querycld2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ChestLungsData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querycld3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ChestLungsData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryclddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ChestLungsData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryheartd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%HeartData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryheartd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%HeartData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryheartd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%HeartData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryheartddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%HeartData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryad1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%AbdomenData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryad2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%AbdomenData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryad3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%AbdomenData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryaddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%AbdomenData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryed1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ExtremitiesData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryed2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ExtremitiesData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryed3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ExtremitiesData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryeddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ExtremitiesData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryalertd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%AlertData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryalertd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%AlertData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryalertd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%AlertData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryalertddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%AlertData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$queryid1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$queryid2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$queryid3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%ImmunizationData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$queryiddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%ImmunizationData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


		$querydmpd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DrugMedicinePrescriptionData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querydmpd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DrugMedicinePrescriptionData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querydmpd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DrugMedicinePrescriptionData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querydmpddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%DrugMedicinePrescriptionData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");

		$querydd1 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DeliveryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
		$querydd2 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DeliveryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
		$querydd3 = mysql_query("SELECT * FROM phie_response WHERE data_type LIKE '%DeliveryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
		$querydddate = mysql_query("SELECT response_date FROM phie_response WHERE data_type LIKE '%DeliveryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y' ORDER BY `phie_response`.`response_date` ASC LIMIT 1");


			$rowpr1 = mysql_num_rows($querypr1);
			$rowpr2 = mysql_num_rows($querypr2);
			$rowpr3 = mysql_num_rows($querypr3);
	
  
			$rowpe1 = mysql_num_rows($querype1);
			$rowpe2 = mysql_num_rows($querype2);
			$rowpe3 = mysql_num_rows($querype3);
  
			$rowpmh1 = mysql_num_rows($querypmh1);
			$rowpmh2 = mysql_num_rows($querypmh2);
			$rowpmh3 = mysql_num_rows($querypmh3);
  
			$rowpsh1 = mysql_num_rows($querypsh1);
			$rowpsh2 = mysql_num_rows($querypsh2);
			$rowpsh3 = mysql_num_rows($querypsh3);

			$rowfhd1 = mysql_num_rows($queryfhd1);
			$rowfhd2 = mysql_num_rows($queryfhd2);
			$rowfhd3 = mysql_num_rows($queryfhd3);
  
			$rowpshd1 = mysql_num_rows($querypshd1);
			$rowpshd2 = mysql_num_rows($querypshd2);
			$rowpshd3 = mysql_num_rows($querypshd3);
  
  
			$rowihdc1 = mysql_num_rows($queryihdc1);
			$rowihdc2 = mysql_num_rows($queryihdc2);
			$rowihdc3 = mysql_num_rows($queryihdc3);
    
			$rowihdyw1 = mysql_num_rows($queryihdyw1);
			$rowihdyw2 = mysql_num_rows($queryihdyw2);
			$rowihdyw3 = mysql_num_rows($queryihdyw3);
  
			$rowihdp1 = mysql_num_rows($queryihdp1);
			$rowihdp2 = mysql_num_rows($queryihdp2);
			$rowihdp3 = mysql_num_rows($queryihdp3);
   
			$rowihde1 = mysql_num_rows($queryihde1);
			$rowihde2 = mysql_num_rows($queryihde2);
			$rowihde3 = mysql_num_rows($queryihde3);
  
			$rowmhd1 = mysql_num_rows($querymhd1);
			$rowmhd2 = mysql_num_rows($querymhd2);
			$rowmhd3 = mysql_num_rows($querymhd3);
 
			$rowphd1 = mysql_num_rows($queryphd1);
			$rowphd2 = mysql_num_rows($queryphd2);
			$rowphd3 = mysql_num_rows($queryphd3);
  
			$rowfad1 = mysql_num_rows($queryfad1);
			$rowfad2 = mysql_num_rows($queryfad2);
			$rowfad3 = mysql_num_rows($queryfad3);
  
			$rowdmi1 = mysql_num_rows($querydmi1);
			$rowdmi2 = mysql_num_rows($querydmi2);
			$rowdmi3 = mysql_num_rows($querydmi3);
 
			$rowvsd1 = mysql_num_rows($queryvsd1);
			$rowvsd2 = mysql_num_rows($queryvsd2);
			$rowvsd3 = mysql_num_rows($queryvsd3);
  
			$rowsd1 = mysql_num_rows($querysd1);
			$rowsd2 = mysql_num_rows($querysd2);
			$rowsd3 = mysql_num_rows($querysd3);
  
  
			$rowhd1 = mysql_num_rows($queryhd1);
			$rowhd2 = mysql_num_rows($queryhd2);
			$rowhd3 = mysql_num_rows($queryhd3);
 
			$rowcld1 = mysql_num_rows($querycld1);
			$rowcld2 = mysql_num_rows($querycld2);
			$rowcld3 = mysql_num_rows($querycld3);
 
			$rowheartd1 = mysql_num_rows($queryheartd1);
			$rowheartd2 = mysql_num_rows($queryheartd2);
			$rowheartd3 = mysql_num_rows($queryheartd3);

			$rowad1 = mysql_num_rows($queryad1);
			$rowad2 = mysql_num_rows($queryad2);
			$rowad3 = mysql_num_rows($queryad3);
  
  
			$rowed1 = mysql_num_rows($queryed1);
			$rowed2 = mysql_num_rows($queryed2);
			$rowed3 = mysql_num_rows($queryed3);

			$rowalertd1 = mysql_num_rows($queryalertd1);
			$rowalertd2 = mysql_num_rows($queryalertd2);
			$rowalertd3 = mysql_num_rows($queryalertd3);

			$rowid1 = mysql_num_rows($queryid1);
			$rowid2 = mysql_num_rows($queryid2);
			$rowid3 = mysql_num_rows($queryid3);
 
			$rowdmpd1 = mysql_num_rows($querydmpd1);
			$rowdmpd2 = mysql_num_rows($querydmpd2);
			$rowdmpd3 = mysql_num_rows($querydmpd3);
 
			$rowdd1 = mysql_num_rows($querydd1);
			$rowdd2 = mysql_num_rows($querydd2);
			$rowdd3 = mysql_num_rows($querydd3);

			$rowpr4 = mysql_fetch_array($queryprdate);
			$rowpe4  = mysql_fetch_array($querypedate);
			$rowpmh4  = mysql_fetch_array($querypmhdate);
			$rowpsh4  = mysql_fetch_array($querypshdate);
			$rowfhd4  = mysql_fetch_array($queryfhdate);
			$rowpshd4  = mysql_fetch_array($querypshddate);
			$rowihdc4  = mysql_fetch_array($queryihdcdate);
			$rowihdyw4  = mysql_fetch_array($queryihdywdate);
			$rowihdp4  = mysql_fetch_array($queryihdpdate);
			$rowihde4  = mysql_fetch_array($queryihdedate);
			$rowmhd4  = mysql_fetch_array($querymhddate);
			$rowphd4  = mysql_fetch_array($queryphddate);
			$rowfad4  = mysql_fetch_array($queryfaddate);
			$rowdmi4  = mysql_fetch_array($querydmidate);
			$rowvsd4  = mysql_fetch_array($queryvsddate);
			$rowsd4  = mysql_fetch_array($querysddate);
			$rowhd4  = mysql_fetch_array($queryhddate);
			$rowcld4  = mysql_fetch_array($queryclddate);
			$rowheartd4  = mysql_fetch_array($queryheartddate);
			$rowad4  = mysql_fetch_array($queryaddate);
			$rowed4  = mysql_fetch_array($queryeddate);
			$rowalertd4  = mysql_fetch_array($queryalertddate);
			$rowid4  = mysql_fetch_array($queryiddate);
			$rowdmpd4  = mysql_fetch_array($querydmpddate);
			$rowdd4  = mysql_fetch_array($querydddate);


	//SUM OF PER SUBMISSION
			$totalinvalid = $rowpr1+$rowpe1 +$rowpmh1 +$rowpsh1 +$rowfhd1 +$rowpshd1 +$rowihdc1 +$rowihdyw1 +$rowihdp1 +$rowihde1 +$rowmhd1 +$rowphd1 +$rowfad1 +$rowdmi1 +$rowvsd1 +$rowsd1 +$rowhd1 +$rowcld1 +$rowheartd1 +$rowad1 +$rowed1 +$rowalertd1 +$rowid1 +$rowdmpd1 +$rowdd1;
			
			$totalsuccess = $rowpr2+$rowpe2 +$rowpmh2 +$rowpsh2 +$rowfhd2 +$rowpshd2 +$rowihdc2 +$rowihdyw2 +$rowihdp2 +$rowihde2 +$rowmhd2 +$rowphd2 +$rowfad2 +$rowdmi2 +$rowvsd2 +$rowsd2 +$rowhd2 +$rowcld2 +$rowheartd2 +$rowad2 +$rowed2 +$rowalertd2 +$rowid2 +$rowdmpd2 +$rowdd2;

			$totalotherdata = $rowpmh2 +$rowpsh2 +$rowfhd2 +$rowpshd2 +$rowihdc2 +$rowihdyw2 +$rowihdp2 +$rowihde2 +$rowmhd2 +$rowphd2 +$rowfad2 +$rowdmi2 +$rowvsd2 +$rowsd2 +$rowhd2 +$rowcld2 +$rowheartd2 +$rowad2 +$rowed2 +$rowalertd2 +$rowid2 +$rowdmpd2 +$rowdd2;

			$totalfailed = $rowpr3+$rowpe3 +$rowpmh3 +$rowpsh3 +$rowfhd3 +$rowpshd3 +$rowihdc3 +$rowihdyw3 +$rowihdp3 +$rowihde3 +$rowmhd3 +$rowphd3 +$rowfad3 +$rowdmi3 +$rowvsd3 +$rowsd3 +$rowhd3 +$rowcld3 +$rowheartd3 +$rowad3 +$rowed3 +$rowalertd3 +$rowid3 +$rowdmpd3 +$rowdd3;

			$totaldata = $rowpr2 + $rowpe2 + $totalotherdata;
			
			$totalpr = number_format($rowpr2);
			$totalpe = number_format($rowpe2);
			$totalother = number_format($totalotherdata);
			$numberform = number_format($totaldata);
			}
		?>

			<div style="width: 50%; margin: 0 0 0 30%;">
				<table style="border: 0;">
					<tr>
					   <td colspan="3" style="font-weight: bold;"><?php printf($rhu); ?></td>
					</tr>
					<tr>
					   <td></td>
					   <td style="font-weight: bold;">Successfully Submitted</td>
					   <td style="font-weight: bold;">Date Submitted</td>
					</tr>
					<tr>
					   <td style="text-align: left; font-weight: bold;">Patient Record:</td>
					   <td><?php printf($totalpr); ?></td>
					   <td><?php printf($rowpr4['response_date']); ?></td>
					</tr>
					<tr>
					   <td style="text-align: left; font-weight: bold;">Patient Encounter:</td>
					   <td><?php printf($totalpe); ?></td>
					   <td><?php printf($rowpe4['response_date']); ?></td>
					</tr>
					<tr>
					   <td style="text-align: left; font-weight: bold;">Other Data:</td>
					   <td><?php printf($totalother); ?></td>
					   <td><?php printf($rowdd4['response_date']); ?></td>
					</tr>
					<tr>
					   <td style="text-align: center; font-weight: bold;">Total:</td>	
					   <td style="text-align: center; font-weight: bold;";><?php printf($numberform); ?></td>
					   <td></td>
					</tr>
				</table>
			</div>

			<table id="tab">
				<tr>
					<th></th>
					<th style="text-align: center">Invalid Submission</th>
					<th style="text-align: center">Successfully Submitted</th>
					<th style="text-align: center">Failed Submission</th>
					<th style="text-align: center">Date Succesfully Submitted</th>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Patient Record</td>
					<td><?php printf($rowpr1); ?></td>
					<td><?php printf($rowpr2); ?></td>
					<td><?php printf($rowpr3); ?></td>
					<td><?php printf($rowpr4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Patient Encounter</td>
					<td><?php printf($rowpe1); ?></td>
					<td><?php printf($rowpe2); ?></td>
					<td><?php printf($rowpe3); ?></td>
					<td><?php printf($rowpe4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Past Medical History Data</td>
					<td><?php printf($rowpmh1); ?></td>
					<td><?php printf($rowpmh2); ?></td>
					<td><?php printf($rowpmh3); ?></td>
					<td><?php printf($rowpmh4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Past Surgical History Data</td>
					<td><?php printf($rowpsh1); ?></td>
					<td><?php printf($rowpsh2); ?></td>
					<td><?php printf($rowpsh3); ?></td>
					<td><?php printf($rowpsh4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Family History Data</td>
					<td><?php printf($rowfhd1); ?></td>
					<td><?php printf($rowfhd2); ?></td>
					<td><?php printf($rowfhd3); ?></td>
					<td><?php printf($rowfhd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Personal Social History Data</td>
					<td><?php printf($rowpshd1); ?></td>
					<td><?php printf($rowpshd2); ?></td>
					<td><?php printf($rowpshd3); ?></td>
					<td><?php printf($rowpshd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Immunization History Data for Chidren</td>
					<td><?php printf($rowihdc1); ?></td>
					<td><?php printf($rowihdc2); ?></td>
					<td><?php printf($rowihdc3); ?></td>
					<td><?php printf($rowihdc4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Immunization History Data for Young Women</td>
					<td><?php printf($rowihdyw1); ?></td>
					<td><?php printf($rowihdyw2); ?></td>
					<td><?php printf($rowihdyw3); ?></td>
					<td><?php printf($rowihdyw4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Immunization History Data for Pregnancy</td>
					<td><?php printf($rowihdp1); ?></td>
					<td><?php printf($rowihdp2); ?></td>
					<td><?php printf($rowihdp3); ?></td>
					<td><?php printf($rowihdp4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Immunization History Data for Elderly</td>
					<td><?php printf($rowihde1); ?></td>
					<td><?php printf($rowihde2); ?></td>
					<td><?php printf($rowihde3); ?></td>
					<td><?php printf($rowihde4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Menstrual History Data</td>
					<td><?php printf($rowmhd1); ?></td>
					<td><?php printf($rowmhd2); ?></td>
					<td><?php printf($rowmhd3); ?></td>
					<td><?php printf($rowmhd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Pregnancy History Data</td>
					<td><?php printf($rowphd1); ?></td>
					<td><?php printf($rowphd2); ?></td>
					<td><?php printf($rowphd3); ?></td>
					<td><?php printf($rowphd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Family Access Data</td>
					<td><?php printf($rowfad1); ?></td>
					<td><?php printf($rowfad2); ?></td>
					<td><?php printf($rowfad3); ?></td>
					<td><?php printf($rowfad4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Drug Medicine Intake Data</td>
					<td><?php printf($rowdmi1); ?></td>
					<td><?php printf($rowdmi2); ?></td>
					<td><?php printf($rowdmi3); ?></td>
					<td><?php printf($rowdmi4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Vital Sign Data</td>
					<td><?php printf($rowvsd1); ?></td>
					<td><?php printf($rowvsd2); ?></td>
					<td><?php printf($rowvsd3); ?></td>
					<td><?php printf($rowvsd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Skin Data</td>
					<td><?php printf($rowsd1); ?></td>
					<td><?php printf($rowsd2); ?></td>
					<td><?php printf($rowsd3); ?></td>
					<td><?php printf($rowsd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Heent Data</td>
					<td><?php printf($rowhd1); ?></td>
					<td><?php printf($rowhd2); ?></td>
					<td><?php printf($rowhd3); ?></td>
					<td><?php printf($rowhd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Chest/Lungs Data</td>
					<td><?php printf($rowcld1); ?></td>
					<td><?php printf($rowcld2); ?></td>
					<td><?php printf($rowcld3); ?></td>
					<td><?php printf($rowcld4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Heart Data</td>
					<td><?php printf($rowheartd1); ?></td>
					<td><?php printf($rowheartd2); ?></td>
					<td><?php printf($rowheartd3); ?></td>
					<td><?php printf($rowheartd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Abdomen Data</td>
					<td><?php printf($rowad1); ?></td>
					<td><?php printf($rowad2); ?></td>
					<td><?php printf($rowad3); ?></td>
					<td><?php printf($rowad4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Extremities Data</td>
					<td><?php printf($rowed1); ?></td>
					<td><?php printf($rowed2); ?></td>
					<td><?php printf($rowed3); ?></td>
					<td><?php printf($rowed4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Alert Data</td>
					<td><?php printf($rowalertd1); ?></td>
					<td><?php printf($rowalertd2); ?></td>
					<td><?php printf($rowalertd3); ?></td>
					<td><?php printf($rowalertd4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Immunization Data</td>
					<td><?php printf($rowid1); ?></td>
					<td><?php printf($rowid2); ?></td>
					<td><?php printf($rowid3); ?></td>
					<td><?php printf($rowid4['response_date']); ?></td>
				</tr>

				<tr class="mouse">
					<td style="text-align: left">Drug Medicine Prescription Data</td>
					<td><?php printf($rowdmpd1); ?></td>
					<td><?php printf($rowdmpd2); ?></td>
					<td><?php printf($rowdmpd3); ?></td>
					<td><?php printf($rowdmpd4['response_date']); ?></td>
				</tr>

				<tr>
					<td style="text-align: left">Delivery Data</td>
					<td><?php printf($rowdd1); ?></td>
					<td><?php printf($rowdd2); ?></td>
					<td><?php printf($rowdd3); ?></td>
					<td><?php printf($rowdd4['response_date']); ?></td>
				</tr>

				<tr>
					<td style="text-align: center; font-weight: bold;">TOTAL</td>
					<td style="font-weight: bold"><?php printf($totalinvalid); ?></td>
					<td style="font-weight: bold"><?php printf($numberform); ?></td>
					<td style="font-weight: bold"><?php printf($totalfailed); ?></td>
					<td></td>
				</tr>
			</table>
		</div>
	</body>
	
</html>
