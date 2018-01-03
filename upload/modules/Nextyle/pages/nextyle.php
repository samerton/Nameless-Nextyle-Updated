<?php
/*
 *	Made by Nexious
 *  https://nexious.net
 *  NamelessMC version 2.0.0-dev
 *
 *  License: MIT
 *
 *  Nextyle for NamelessMC
 */

// Can the user view the AdminCP?
if($user->isLoggedIn()){
	if(!$user->canViewACP()){
		// No
		Redirect::to(URL::build('/'));
		die();
	} else {
		// Check the user has re-authenticated
		if(!$user->isAdmLoggedIn()){
			// They haven't, do so now
			Redirect::to(URL::build('/admin/auth'));
			die();
		}
	}
} else {
	// Not logged in
	Redirect::to(URL::build('/login'));
	die();
}
 
 
$page = 'admin';
$admin_page = 'nextyle';

?>
<!DOCTYPE html>
<html>
  <head>
    <!-- Standard Meta -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<?php 
	$title = $language->get('admin', 'admin_cp');
	require('core/templates/admin_header.php'); 
	?>
  
  </head>
  <body>
    <?php require('modules/Core/pages/admin/navbar.php'); ?>
	<div class="container">
	  <div class="row">
	    <div class="col-md-3">
		  <?php require('modules/Core/pages/admin/sidebar.php'); ?>
		</div>
		<div class="col-md-9">
		  <div class="card">
		    <div class="card-block">
			<h3><?php echo $nextyle_language->get('language', 'nextyle_title'); ?></h3>
			<hr>
			<?php
			if(isset($_POST['view'])){
				$view = $_POST['view']; $getTheme = $_POST['theme']; $getBG = $_POST['bg']; $getLOGO = $_POST['logo'];
			} else $view = null;
			if ($view == "update") { 
				$f=fopen("./modules/Nextyle/pages/settings.php","w");
				require 'settings.default.php';

				if (fwrite($f,$settings_inf)>0){
					fclose($f);
				}

				echo "<div class='alert alert-success' role='alert'>Successfully updated!</div>";
				echo "<hr><a href='' role='button' class='btn btn-primary'>Back</a>";

			} else { require 'settings.php'; $getNavbarTheme = NEXTYLE_THEME; $getNavbarBg = NEXTYLE_BG; $getNavbarLogo = NEXTYLE_LOGO;

			echo "<form class='form-group' method='post'>
				<label for='Theme'>Theme</label>
				<select class='form-control' name='theme'>
					<option value='red'" . (($getNavbarTheme == 'red') ? ' selected' : '') . ">Red</option>
					<option value='blue'" . (($getNavbarTheme == 'blue') ? ' selected' : '') . ">Blue</option>
					<option value='gold'" . (($getNavbarTheme == 'gold') ? ' selected' : '') . ">Gold</option>
				</select>
				<br>
				<label for='bg'>Navigation background</label>
				<input type='text' name='bg' value='$getNavbarBg' class='form-control' placeholder='Background-image link..'>
				<br>
				<label for='logo'>Logo</label>
				<input type='text' name='logo' value='$getNavbarLogo' class='form-control' placeholder='Logo-image link..'>
				<input type='hidden' name='view' value='update'>
				<hr>
				<button type='submit' class='btn btn-primary'>Submit</button>
			</form>";
			} ?>
		    </div>
		  </div>
		</div>
	  </div>
    </div>
	
	<?php require('modules/Core/pages/admin/footer.php'); ?>

    <?php require('modules/Core/pages/admin/scripts.php'); ?>
	
  </body>
</html>