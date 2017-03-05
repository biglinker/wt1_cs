<nav class="navbar navbar-inverse navbar-default">
	<div class="navbar-header">
			
		<a class="navbar-brand" href="main.php">
		<img alt="Brand-Logo" src="src/png/logo_wo_text.png" width="24" height="24">
		</a>	
		
		<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
		</button>
		  
		<a class="navbar-brand" href="main.php">Agricola</a>
	</div>
	<div id="navbar" class="navbar-collapse collapse">
		<ul class="nav navbar-nav">
			<li><a href="new.php">Inserat erfassen</a></li>
			<!--<li><a href="main.php">Home</a></li>-->
			
			<!-- Drop Down Account -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="login.php">Login</a></li>
					<li><a href="logout.php">Logout</a></li>
					<li><a href="register.php">Registrieren</a></li>
					<li><a href="konto.php">Konto verwalten</a></li>
					<li role="separator" class="divider"></li>
					<li class="dropdown-header">Inserieren</li>
					<li role="separator" class="divider"></li>
					<li><a href="new.php">Inserat erfassen</a></li>
					<li><a href="suche.php">Suchen</a></li>
				</ul>
            </li>
			
			<!-- Drop Down Über uns -->
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Über uns <span class="caret"></span></a>
				<ul class="dropdown-menu">
					<li><a href="about.php">Über uns</a></li>
					<li><a href="contact.php">Kontakt</a></li>
				</ul>
            </li>
			
			<!-- Suchfeld -->
			<li>
			  <!-- Suche in DB -->
			  <form class="navbar-form navbar-left" action="suche.php" method="get" id="searchform" role="search" >
					<div class="form-group">
						<input type="text" name="search" size="55" class="form-control" placeholder="Suchen...">
					</div>
						<button type="submit" class="btn btn-default"> <span class="glyphicon glyphicon-search"></span></button>
				</form>
			</li>
			<?php 
				// User ist nicht eingeloggt
				IF( !isset($_SESSION['B_id']) ) {
				?>
					<li><a href="login.php">Hallo Gast</a></li>
				<?php
				}	
				// User ist eingeloggt
				IF( isset($_SESSION['B_id']) ) {
					$user = $_SESSION['B_id'];
					
					echo "<li><a href='konto.php'>Hallo User $user</a></li>";
				
				}	
				?>		  
			  
		  </ul>
	</div><!--/.nav-collapse -->
</nav>