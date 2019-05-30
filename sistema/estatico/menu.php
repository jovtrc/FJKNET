<!-- Menu -->
<nav class="menu bg-white border-left" id="menu-principal">
	<a class="logo-menu d-block px-3 mb-4" href="index.php">
		<img src="assets/img/logo/logo.png" class="img-fluid" alt="FJKNet">
	</a>

	<div class="itens-menu">
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link" href="index.php"><i class="fa fa-home"></i> Início</a>
			</li>

			<li class="nav-item submenu-toggle" onclick="$(this).toggleClass('aberto')">
				<a class="nav-link submenu-toggle"><i class="fa fa-user"></i> Clientes</a>

				<div class="submenu-menu">
					<a class="submenu-item" href="clientes.php">Listar clientes</a>
					<a class="submenu-item" href="clientesAdd.php">Cadastrar cliente</a>
				</div>
			</li>

			<li class="nav-item submenu-toggle" onclick="$(this).toggleClass('aberto')">
				<a class="nav-link submenu-toggle"><i class="fa fa-wifi"></i> Planos</a>

				<div class="submenu-menu">
					<a class="submenu-item" href="planos.php">Listar planos</a>
					<a class="submenu-item" href="planosAdd.php">Cadastrar plano</a>
				</div>
			</li>

			<li class="nav-item submenu-toggle" onclick="$(this).toggleClass('aberto')">
				<a class="nav-link submenu-toggle"><i class="fa fa-wrench"></i> Chamados</a>

				<div class="submenu-menu">
					<a class="submenu-item" href="chamados.php">Listar chamados</a>
					<!-- <a class="submenu-item" href="#">Categorias</a> -->
				</div>
			</li>

			<li class="nav-item submenu-toggle" onclick="$(this).toggleClass('aberto')">
				<a class="nav-link submenu-toggle"><i class="fa fa-dollar"></i> Financeiro</a>

				<div class="submenu-menu">
					<a class="submenu-item" href="lancamentos.php">Lançamentos</a>
					<!-- <a class="submenu-item" href="#">Despesas</a> -->
					<!-- <a class="submenu-item" href="#">Cobranças</a> -->
					<!-- <a class="submenu-item" href="#">Fluxo de caixa</a> -->
				</div>
			</li>

			<li class="nav-item submenu-toggle" onclick="$(this).toggleClass('aberto')">
				<a class="nav-link submenu-toggle"><i class="fa fa-archive"></i> Estoque</a>

				<div class="submenu-menu">
					<!-- <a class="submenu-item" href="#">Movimentação</a> -->
					<a class="submenu-item" href="produtos.php">Produtos</a>
					<a class="submenu-item" href="produtosCategorias.php">Categorias</a>
				</div>
			</li>

			<li class="nav-item submenu-toggle" onclick="$(this).toggleClass('aberto')">
				<a class="nav-link submenu-toggle"><i class="fa fa-gear"></i> Configurações</a>

				<div class="submenu-menu">
					<a class="submenu-item" href="usuarios.php">Usuários</a>
					<!-- <a class="submenu-item" href="#">Permissões</a> -->
					<!-- <a class="submenu-item" href="#">Formas de pagamento</a> -->
					<!-- <a class="submenu-item" href="#">Auditoria</a> -->
				</div>
			</li>

			<li class="nav-item d-block d-md-none">
				<a class="nav-link" href="../controller/logout.php"><i class="fa fa-sign-out"></i> Fazer logout</a>
			</li>
		</ul>
	</div>
</nav>
