<?php
	require_once 'autoload.php';

	if ( !$Auth->isLoged() ) {
		header('location: login.php');
	}

	$pageTitle = 'Home';
	require_once 'includes/head.php';

	$theUser = $DB->getUserByEmail($_SESSION['userEmail']);
?>
	<?php require_once 'includes/navbar.php'; ?>

	<!-- Container -->
	<div class="container" style="margin-top: 40px;">
		<div class="row">
			<div class="col-md-3">
				<h2>Hi <?= $theUser->getName() ?></h2>
				<img src="data/avatars/<?= $theUser->getAvatar() ?>" width="100%">
				<br>
				<br>
				<div class="alert alert-success"><?= $theUser->getEmail() ?></div>
			</div>
		</div>
	</div>
	<!-- //Container -->

<?php require_once 'includes/footer.php'; ?>
