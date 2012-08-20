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

	<h1>Exemplo MAIS BONITO de javascript não obstrutivo em abas / páginas com ajax</h1>
	<div>Contador: <strong id="counter"></strong></div>
	<ul>
		<li><a href="?p=aba1">Aba 1</a></li>
		<li><a href="?p=aba2">Aba 2</a></li>
		<li><a href="?p=aba3">Aba 3</a></li>
		<li><a href="?p=aba4">Aba 4</a></li>
	</ul>

	<div class="aba">
		<?php
			$p = $_REQUEST["p"];
			if (!($p)) $p = "aba1";

			include($p.".html");
		?>
	</div>

	<!-- TENTA CARREGAR JQUERY EXTERNO, EM CASO DE TIMEOUT CARREGA LOCAL -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="scripts/jquery-1.7.1.min.js"><\/script>')</script>

	<script>
		var conteudoAbas = $(".aba")
			, abas = $("ul a")
			, pagina
			, link
			, state

		abas.click(function(e) {
			e.preventDefault();

			link = $(this).attr('href')
			pagina = link.replace(/.*p=/,"")+".html"
			state = {
				'pagina': pagina
			}

			$.ajax({
				url: pagina,
				success: function(data) {
					conteudoAbas.html(data)
					history.pushState(state, link, "abacate") /* State, title, url */
				}
			});
		});

		// Popstate
		window.onpopstate = function(event) {
			if (event.state == null)
				return;

			$.ajax({
				url: event.state.pagina,
				success: function(data) {
					conteudoAbas.html(data)
				}
			});
		}

		// Contador
		var cont = 0;
		setInterval(function() {
			$("#counter").html(cont++)
		},1000)
	</script>
</body>
</html>