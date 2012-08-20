<!DOCTYPE html>
<html>
<head>
	<title>Exemplos Javascript não obstrutivo</title>
	<!-- ADICIONA CLASSE NO HTML QUANDO HA SUPORTE -->
	<script>document.getElementsByTagName('html')[0].className += ' js'</script>

	<style>
		ul {
			overflow:hidden;
			list-style:none;
		}
		ul li {
			float:left;
			padding-right:30px;
		}
		.aba {
			display:block;
			border-top:solid 1px #CCC;
			padding:30px;
		}
	</style>
</head>
<body>

	<h1>Exemplo javascript não obstrutivo em abas / páginas com ajax</h1>
	<ul>
		<li><a href="aba1.html">Aba 1</a></li>
		<li><a href="aba2.html">Aba 2</a></li>
		<li><a href="aba3.html">Aba 3</a></li>
		<li><a href="aba4.html">Aba 4</a></li>
	</ul>

	<div class="aba">
		<?php
			include("aba1.html");
		?>
	</div>

	<!-- TENTA CARREGAR JQUERY EXTERNO, EM CASO DE TIMEOUT CARREGA LOCAL -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="scripts/jquery-1.7.1.min.js"><\/script>')</script>

	<script>
		var conteudoAbas = $(".aba")
			, abas = $("ul a")
			, pagina

		abas.click(function(e) {
			e.preventDefault();

			pagina = $(this).attr('href')
			$.ajax({
				url: pagina,
				success: function(data) {
					conteudoAbas.html(data)
				}
			});
		});
	</script>
</body>
</html>