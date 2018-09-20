<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">Avengers Fucking Site</a>

	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myOwnNav" aria-controls="myOwnNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="myOwnNav">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
			<li class="nav-item"><a class="nav-link" href="">About</a></li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="dropNavBar" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					Services
				</a>
				<div class="dropdown-menu" aria-labelledby="dropNavBar">
					<a class="dropdown-item" href="#">Service 01</a>
					<a class="dropdown-item" href="#">Service 02</a>
					<a class="dropdown-item" href="#">Service 03</a>
				</div>
			</li>
			<?php if ( $Auth->isLoged() ) : ?>
			<li class="nav-item"><a class="nav-link" href="all-users.php">View all users</a></li>
			<?php endif; ?>
		</ul>
		<ul class="navbar-nav ml-auto">
			<?php if ( $Auth->isLoged() ) : ?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="dropUser" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<img src="data/avatars/<?= $theUser->getAvatar() ?>" width="40" style="border-radius: 100%;">
						Hi <?= $theUser->getName() ?>
					</a>
					<div class="dropdown-menu" aria-labelledby="dropUser" style="left: auto; right: 0;">
						<a class="dropdown-item" href="profile.php">My profile</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="logout.php">Logout</a>
					</div>
				</li>
			<?php else : ?>
				<li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>
				<li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
			<?php endif; ?>
		</ul>
	</div>
</nav>
