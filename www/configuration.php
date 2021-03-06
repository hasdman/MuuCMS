<?php 
/**
 * Access from index.php:
 */
if(!defined("_access")) {
	die("Error: You don't have permission to access here...");
}

$Configuration_Model = $Load->model("Configuration_Model");

$data = $Configuration_Model->getConfig();

if(is_array($data)) {
	set("webLanguage", $data[0]["Language"]);

	if(whichLanguage() === get("webLanguage")) { 
		set("webLang", $data[0]["Lang"]);
	} else {
		set("webLang", getLang(whichLanguage(), FALSE));
	}

	set("webName", 		   $data[0]["Name"]);
	set("webSlogan",       $data[0]["Slogan_" . get("webLanguage")]);
	set("webURL", 		   $data[0]["URL"]);
	set("webTheme", 	   $data[0]["Theme"]);
	set("webGallery", 	   $data[0]["Gallery"]);
	set("webValidation",   $data[0]["Validation"]);
	set("webMessage",      $data[0]["Message"]);
	set("webActivation",   $data[0]["Activation"]);
	set("webEmailRecieve", $data[0]["Email_Recieve"]);
	set("webEmailSend",    $data[0]["Email_Send"]);
	set("webSituation",    	$data[0]["Situation"]);
	set("defaultApplication", $data[0]["Application"]);

	if(!get("modRewrite")) {
		set("webBase", get("webURL") . _sh . _index);
	} else {
		set("webBase", get("webURL"));
	}
}

if(get("translation") === "gettext") {
	$languageFile = _dir ."/lib/languages/gettext/". whichLanguage(TRUE, TRUE) .".mo";
		
	if(file_exists($languageFile)) { 			
		$Load->library("streams", NULL, NULL, "gettext");

		$Gettext_Reader = $Load->library("gettext", "Gettext_Reader", array($languageFile), "gettext");
	
		$Gettext_Reader->load_tables();
	}
}