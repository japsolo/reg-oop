<?php
	// llamamos a las funciones controladoras
	require_once 'autoload.php';

	if( $Auth->isLoged() ) {
		header('location: profile.php');
	}

	$pageTitle = 'Register';
	require_once 'includes/head.php';
	$countries = [
		'ar' => 'Argentina',
		'bo' => 'Bolivia',
		'br' => 'Brasil',
		'co' => 'Colombia',
		'cl' => 'Chile',
		'ec' => 'Ecuador',
		'pa' => 'Paraguay',
		'pe' => 'Perú',
		'uy' => 'Uruguay',
		've' => 'Venezuela',
	];

	$userData = new RegisterValidator($_POST, $_FILES);

	if ($_POST) {
		if( $DB->emailExist($_POST['email']) ) {
			$userData->addError('email', 'Este email ya fue registrado');
		}

		if ( $userData->isValid() == true ) {
			if ( $userData->isValid() == true ) {
				SaveImage::uploadImage($_FILES['avatar']);

				$user = new User($_POST);
				$user->setAvatar(SaveImage::$imageName);
				$user->setId($DB->generateId());

				$DB->saveUser($user);

				$Auth->logIn($user->getEmail());
			}
		}
	}
?>
	<?php require_once 'includes/navbar.php'; ?>

	<!-- Register-Form -->
	<div class="container" style="margin-top:30px; margin-bottom: 30px;">
		<div class="row justify-content-center">
			<div class="col-md-10">
				<?php if ( $_POST && $userData->isValid() == false ): ?>
					<div class="alert alert-danger">
						<ul>
						<?php foreach ($userData->getAllErrors() as $error): ?>
							<li> <?= $error ?> </li>
						<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
				<h2>Formulario de registro</h2>

				<form method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Nombre completo:</b></label>
								<input
									type="text"
									name="name"
									class="form-control <?= $userData->fieldHasError('name') ? 'is-invalid' : ''; ?>"
									value="<?= $userData->getName() ; ?>"
								>
								<?php if ( $userData->fieldHasError('name')  ): ?>
									<div class="invalid-feedback">
										<?= $userData->getFieldError('name') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Correo electrónico:</b></label>
								<input
									type="text"
									name="email"
									class="form-control <?= $userData->fieldHasError('email') ? 'is-invalid' : ''; ?>"
									value="<?= $userData->getEmail() ; ?>"
								>
								<?php if ( $userData->fieldHasError('email')  ): ?>
									<div class="invalid-feedback">
										<?= $userData->getFieldError('email') ?>
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
									class="form-control <?= $userData->fieldHasError('password') ? 'is-invalid' : ''; ?>"
								>
								<?php if ( $userData->fieldHasError('password')  ): ?>
									<div class="invalid-feedback">
										<?= $userData->getFieldError('password') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Repetir Password:</b></label>
								<input
									type="password"
									name="rePassword"
									class="form-control <?= $userData->fieldHasError('password') ? 'is-invalid' : ''; ?>"
								>
								<?php if ( $userData->fieldHasError('password')  ): ?>
									<div class="invalid-feedback">
										<?= $userData->getFieldError('password') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>País de nacimiento:</b></label>
								<select
									name="country"
									class="form-control <?= $userData->fieldHasError('country') ? 'is-invalid' : ''; ?>"
								>
									<option value="">Elegí un país</option>
									<?php foreach ($countries as $code => $country): ?>
										<option
											<?= $code == $userData->getCountry() ? 'selected' : '' ?>
											value="<?= $code ?>"><?= $country ?></option>
									<?php endforeach; ?>
								</select>
								<?php if ( $userData->fieldHasError('country') ): ?>
									<div class="invalid-feedback">
										<?= $userData->getFieldError('country') ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label><b>Imagen de perfil:</b></label>
								<div class="custom-file">
									<input
										type="file"
										class="custom-file-input <?= $userData->fieldHasError('avatar') ? 'is-invalid' : ''; ?>"
									 	name="avatar"
									>
									<label class="custom-file-label">Choose file...</label>
									<?php if ( $userData->fieldHasError('avatar') ): ?>
										<div class="invalid-feedback">
											<?= $userData->getFieldError('avatar') ?>
										</div>
									<?php endif; ?>
								</div>
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
	<!-- //Register-Form -->

<?php require_once 'includes/footer.php'; ?>
