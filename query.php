<?php

#Queries for Invalid Submission, Successfully Submitted and Failed Submission

#Patient Record Queries and Counts
$prinvalid = "SELECT *  FROM phie_response  WHERE data_type LIKE '%PatientData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'";
	$countprinvalid = mysql_num_rows($prinvalid);
$prsuccess = mysqli_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PatientData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countprsuccess = mysql_num_rows($prsuccess);
$prfailed = mysqli_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PatientData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countprfailed = mysql_num_rows($prfailed);


#Patient Encounter Queries
$peinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%EncounterData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countpeinvalid = mysql_num_rows($peinvalid);
$pesuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%EncounterData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countpesuccess = mysql_num_rows($pesuccess);
$pefailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%EncounterData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countpefailed = mysql_num_rows($pefailed);


#Past Medical History Queries
$pmhinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countpmhinvalid = mysql_num_rows($pmhinvalid);
$pmhsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countpmhsuccess = mysql_num_rows($pmhsuccess);
$pmhfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PastMedicalHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countpmhfailed = mysql_num_rows($pmhfailed);


#Past Surgical History Queiries
$pshinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countpshinvalid = mysql_num_rows($pshinvalid);
$pshsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countpshsuccess = mysql_num_rows($pshsuccess);
$pshfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%PastSurgicalHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countpshfailed = mysql_num_rows($pshfailed);


#Family History Data Queries
$fhinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countfhinvalid = mysql_num_rows($fhinvalid);
$fhsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countfhsuccess = mysql_num_rows($fhsuccess);
$fhfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countfhfailed = mysql_num_rows($fhfailed);


#Personal Social History Data Queries
$pshdinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countpshdinvalid = mysql_num_rows($pshdinvalid);
$pshdsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countpshdsuccess = mysql_num_rows($pshdsuccess);
$pshdfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%FamilyHistoryData%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countpshdfailed = mysql_num_rows($pshdfailed);


#Immunization History Data for Children Queries
$ihdcinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countihdcinvalid = mysql_num_rows($ihdcinvalid);
$ihdcsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countihdcsuccess = mysql_num_rows($ihdcsuccess);
$ihdcfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Children%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$ihdcfailed = mysql_num_rows($ihdcfailed);


#Immunization History Data for Young Women Queries
$ihdywinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countihdywinvalid = mysql_num_rows($ihdywinvalid);
$ihdywsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countihdywsuccess = mysql_num_rows($ihdywsuccess);
$ihdywfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_YoungWomen%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countihdywfailed = mysql_num_rows($ihdywfailed);


#Immunization History Data for Pregnacy Queries
$ihdpinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countihdpinvalid = mysql_num_rows($ihdpinvalid);
$ihdpsuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countpshdsuccess = mysql_num_rows($ihdpsuccess);
$ihdpfailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Pregnancy%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countihdpfailed = mysql_num_rows($ihdpfailed);


#Immunization History Data for Elderly Queries
$ihdeinvalid = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND error_desc LIKE '%Invalid Data Content%' AND phie_sync LIKE 'N'");
	$countihdeinvalid = mysql_num_rows($ihdeinvalid);
$ihdesuccess = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND response_desc LIKE '%PHIE Data Successfully Uploaded%' AND phie_sync LIKE 'Y'");
	$countihdesuccess = mysql_num_rows($ihdesuccess);
$ihdefailed = mysql_query("SELECT *  FROM phie_response WHERE data_type LIKE '%ImmunizationHistoryData_Elderly%' AND response_desc LIKE '%PHIE Data Failed to Upload%' AND phie_sync LIKE 'N'");
	$countihdefailed = mysql_num_rows($ihdefailed);

?>
