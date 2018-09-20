<?php
	// llamamos a las funciones controladoras
	require_once 'autoload.php';

	$pageTitle = 'Register Success';
	require_once 'includes/head.php';

	if ( !$Auth->isLoged() ) {
		header('location: index.php'); exit;
	}

	$myUsers = $DB->getAllUsers();
?>
	<?php require_once 'includes/navbar.php' ?>

	<div class="container">
		<?php if ($myUsers) : ?>
			<br>
			<h2 class="alert alert-success">Registro Existoso</h2>
			<h3>Los usuarios registrados son:</h3>
			<ul>
				<?php foreach ($myUsers as $oneUser): ?>
					<?php $oneUser = $DB->getUserByEmail($oneUser->email) ?>
					<li>
						<img src="data/avatars/<?= $oneUser->getAvatar() == '' ? 'default.png' : $oneUser->getAvatar() ?>" width="100"> <br>
						<em><?= $oneUser->getName() ?></em> /
						<a href="mailto: <?= $oneUser->getEmail() ?>"><?= $oneUser->getEmail() ?></a> /
						<b><?= $oneUser->getCountry() ?></b>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php else : ?>
			<br>
			<h2 class="alert alert-danger">No hay usuarios registrados</h2>
		<?php endif; ?>
	</div>

<?php require_once 'includes/footer.php' ?>
