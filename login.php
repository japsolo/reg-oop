<?php
	// llamamos a las funciones controladoras
	require_once 'autoload.php';

	if ( $Auth->isLoged() ) {
		header('location: profile.php');
	}

	$pageTitle = 'Login';
	require_once 'includes/head.php';

	$loginValidator = new LoginValidator($_POST);

	if ($_POST) {
		$user = $DB->getUserByEmail($_POST['email']);

		if ( $user == false ) {
			$loginValidator->addError('email', 'Este correo no pertenece a un registro válido');
		} else if( !password_verify( $_POST['password'], $user->getPassword() ) ) {
			$loginValidator->addError('email', 'Error de credenciales');
			$loginValidator->addError('password', 'Error de credenciales');
		}

		if( $loginValidator->isValid() == true ) {
			if ( isset($_POST['rememberUser']) ) {
				setcookie('rememberUser', $_POST['email'], time() + 3600);
			}

			$Auth->logIn($user->getEmail());
		}
	}
?>
	<?php require_once 'includes/navbar.php'; ?>

	<!-- Login-Form -->
	<div class="container" style="margin-top:30px; margin-bottom: 30px;">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<?php if ( $_POST && $loginValidator->isValid() == false ) : ?>
					<div class="alert alert-danger">
						<ul>
						<?php foreach ($loginValidator->getAllErrors() as $error) : ?>
							<li> <?= $error ?> </li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<h2>Formulario de Login</h2>

				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Correo electrónico:</b></label>
								<input
									type="text"
									name="email"
									class="form-control <?= $loginValidator->fieldHasError('email')? 'is-invalid' : ''; ?>"
									value="<?= $loginValidator->getEmail() ; ?>"
								>
								<?php if ( $loginValidator->fieldHasError('email') ) : ?>
									<div class="invalid-feedback">
										<?= $loginValidator->getFieldError('email') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Password:</b></label>
								<input
									type="password"
									name="password"
									class="form-control <?= $loginValidator->fieldHasError('password')? 'is-invalid' : ''; ?>"
								>
								<?php if ( $loginValidator->fieldHasError('password') ) : ?>
									<div class="invalid-feedback">
										<?= $loginValidator->getFieldError('password') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group form-check">
								<label class="form-check-label" >
									<input type="checkbox" class="form-check-input" name="rememberUser">Recordar mi usuario
								</label>
							</div>
						</div>
						<div class="col-12">
							<button type="submit" class="btn btn-primary">Registrarse</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- //Login-Form -->

<?php require_once 'includes/footer.php'; ?>
