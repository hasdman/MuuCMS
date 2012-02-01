<?php 
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	print div("add-form", "class");
		print formOpen($href, "form-add", "form-add");
			print p(__(_(ucfirst(whichApplication()))), "resalt");
			
			print isset($alert) ? $alert : NULL;

			print formInput(array(	"name" 	=> "title", 
									"class" => "span14 required", 
									"field" => __(_("Title")), 
									"p" 	=> TRUE, 
									"value" => ($action === "edit") ? $title : recoverPOST("title")
			));

			print formTextarea(array(	"id" 	=> "editor", 
									 	"name" 	=> "content", 
									 	"class" => "span14",
									 	"style" => "height: 400px;", 
									 	"field" => __(_("Content")), 
									 	"p" 	=> TRUE, 
									 	"value" => ($action === "edit") ? $content : recoverPOST("content")
			));

			$vars["application"]     = isset($application)     ? $application 	  : NULL;
			$vars["categories"]      = isset($categories) 	   ? $categories   	  : NULL;
			$vars["categoriesRadio"] = isset($categoriesRadio) ? $categoriesRadio : NULL;
				
			$this->view("categories", $vars, "categories");

			print isset($imagesLibrary)    ? $imagesLibrary    : NULL;
			print isset($documentsLibrary) ? $documentsLibrary : NULL;
				
			if(isset($tags)) {
				$var["tags"] = $tags;
			
				$this->view("tags", $var, "tags");
			} else { 
				$this->view("tags", NULL, "tags");
			}
			
			print formField(NULL, __(_("Languages")) ."<br />". getLanguageRadios($language));

			$options = array(
				0 => array("value" => 1, "option" => __(_("Yes")), "selected" => TRUE),
				1 => array("value" => 0, "option" => __(_("No")))
			);

			print formSelect(array("name" => "enable_comments", "p" => TRUE, "field" => __(_("Enable Comments"))), $options);				
			
			$options = array(
				0 => array("value" => "Active",   "option" => __(_("Active")), "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __(_("Inactive")),  "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			print formSelect(array("name" => "situation", "p" => TRUE, "field" => __(_("Situation"))), $options);
			
						
			if(!isset($pwd)) { 
				print formInput(array("name" => "pwd", "class" => "span14", "field" => __(_("Password")), "p" => TRUE, "value" => $pwd));	
			} else { 
				print formField(NULL, __(_("Password")) ."<br />");
				print formInput(array("id" => "lock", "class" => "lock", "type" => "button"));
	
							
				print formInput(array("id" => "password", "type" => "hidden", "value" => $pwd));
			}
			
			print div("addflag", "class");
			print div(FALSE); 		

			print formInput(array("type" => "file", "name" => "image", "field" => __(_("Image for this post")), "p" => TRUE));

			if(isset($medium) and !is_null($medium)) {
				print img(_webURL . _sh . $medium);
			}
			
			print formInput(array("type" => "file", "name" => "mural", "field" => __(_("Mural image")) ." (". _muralSize .")", "p" => TRUE));
	
			if(isset($muralImage) and is_array($muralImage)) {
				print formInput(array("type" => "hidden", "name" => "mural_exist", "class" => "span14", "field" => __(_("Current mural image")), "p" => TRUE));
				
				print img(_webURL . _sh . $muralImage[0]["Image"], NULL, NULL, array("style" => "width: 98%; border: 1px solid #000;"));
                
                print '	<script type="text/javascript">
                    		var URL = \''. $muralDeleteURL .'\';
                		</script>';
 				
 				print formInput(array("type" => "submit", "id" => "delete_mural", "name" => "delete_mural_image", "value" => __(_("Delete Mural")), "class" => "btn error", "p" => TRUE));
			}
			
			print formSave($action);
			
			print formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		print formClose();
	print div(FALSE);
