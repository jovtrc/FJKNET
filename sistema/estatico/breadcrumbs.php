<!-- AREA TOPO/LOGOUT -->
<div class="container-fluid">
	<div class="topo py-4">
		<div class="row align-items-center">
			<div class="col-12 col-md-6">
				<h1 class="mb-0">
					FJKNET

					<?php
						if($_SESSION['FJK_tipo'] == 3) {
							echo '<a class="btn btn-sm btn-primary float-right mt-1 d-inline-block d-md-none" href="../controller/logout.php">Fazer logout</a>';
						} else { ?>
							<button class="btn float-right btn-lg d-inline-block d-md-none" onclick="$('body').toggleClass('menuAberto');"><i class="fa fa-bars"></i></button>
					<?php	}
					?>
				</h1>
			</div>

			<div class="col-12 col-md-6 d-none d-md-block text-right">
				<div class="dropdown">
					<button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> <?php echo $_SESSION['FJK_nome']; ?></button>
					<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						<a class="dropdown-item" href="../controller/logout.php">Fazer logout</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
