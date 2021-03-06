<?php

	switch ($page) {
		case 'dashboard':
			break;
			
		case 'pages':
			# Handle "Save" button for pages
			if(isset($_POST['submitted']) == 1) {
				$title = mysqli_real_escape_string($dbc, $_POST['title']);
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$header = mysqli_real_escape_string($dbc, $_POST['header']);
				$body = mysqli_real_escape_string($dbc, $_POST['body']);
				
				if(isset($_POST['id']) != '') {
					$q = "UPDATE posts SET user=$_POST[user], slug='$_POST[slug]', title='$title', label='$label', header='$header', body='$body' WHERE id=$_GET[id]";
					$action = "updated";	
				} else {
					$q = "INSERT INTO posts (type,user,slug,title,label,header,body) VALUES (1,$_POST[user], '$_POST[slug]', '$title', '$label', '$header', '$body')";
					$action = "added";	
				}
				
				$r = mysqli_query($dbc,$q);
				
				if($r) {
					$message = '<p class="alert alert-success">Page was '.$action.'</p>';
				} else {
					$message = '<p class="alert alert-danger">Page could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					$message .= '<p class="alert alert-warning">'.$q.'</p>';
				}
			}
			if(isset($_GET['id'])) { $opened = data_post($dbc,$_GET['id']); }
			
			break;
			
			
			
		case 'users':
			# Handle "Save" button for users
			if(isset($_POST['submitted']) == 1) {
				$first = mysqli_real_escape_string($dbc, $_POST['first']);
				$last = mysqli_real_escape_string($dbc, $_POST['last']);
				
				if($_POST['password'] != '') {
					if ($_POST['password'] == $_POST['passwordv']) {
						$password = " password=SHA1('$_POST[password]'),";
						$verify = true;
					} else {
						$verify = false;
					}
				} else {
					$verify = false;
				}
				
				
				if(isset($_POST['id']) != '') {
					$q = "UPDATE users SET first='$first', last='$last', email='$_POST[email]', $password status=$_POST[status] WHERE id=$_GET[id]";
					$action = "updated";
					$r = mysqli_query($dbc,$q);
					
				} else {
					$action = "added";	
					
					$q = "INSERT INTO users (first,last,email,password,status) VALUES ('$first', '$last', '$_POST[email]', SHA1('$_POST[password]'), '$_POST[status]')";	
				
					if($verify == true) {
						$r = mysqli_query($dbc,$q);
					}
				}

				
				
				if($r) {
					$message = '<p class="alert alert-success">User was '.$action.'</p>';
				} else {
					$message = '<p class="alert alert-danger">User could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					if($verify == false) {
						$message .= '<p class="alert alert-danger">Password fields empty and/or do not match.</p>';	
					}
					$message .= '<p class="alert alert-warning">Query: '.$q.'</p>';
				}
			}

			if(isset($_GET['id'])) { $opened = data_user($dbc,$_GET['id']); }
			break;
			
			
			
		case 'navigation':
			# Handle "Save" button for settings
			if(isset($_POST['submitted']) == 1) {
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$url = mysqli_real_escape_string($dbc, $_POST['url']);

				
				if(isset($_POST['id']) != '') {
					$q = "UPDATE navigation SET id = '$_POST[id]', label='$label', url='$url', position=$_POST[position], status=$_POST[status] WHERE id='$_POST[openedid]'";
					$action = "updated";
					$r = mysqli_query($dbc,$q);
					
				} 
				
				
				if($r) {
					$message = '<p class="alert alert-success">Navigation Item was '.$action.'</p>';
				} else {
					$message = '<p class="alert alert-danger">Navigation Item could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					$message .= '<p class="alert alert-warning">Query: '.$q.'</p>';
				}
			}

			break;
						
			
			
		case 'settings':
			# Handle "Save" button for settings
			if(isset($_POST['submitted']) == 1) {
				$label = mysqli_real_escape_string($dbc, $_POST['label']);
				$value = mysqli_real_escape_string($dbc, $_POST['value']);

				
				if(isset($_POST['id']) != '') {
					$q = "UPDATE settings SET id = '$_POST[id]', label='$label', value='$value' WHERE id='$_POST[openedid]'";
					$action = "updated";
					$r = mysqli_query($dbc,$q);
					
				} 
				
				
				if($r) {
					$message = '<p class="alert alert-success">Setting was '.$action.'</p>';
				} else {
					$message = '<p class="alert alert-danger">Setting could not be '.$action.' because: '.mysqli_error($dbc).'</p>';
					$message .= '<p class="alert alert-warning">Query: '.$q.'</p>';
				}
			}

			break;
			
		default:
			
			break;
	}
	

?>