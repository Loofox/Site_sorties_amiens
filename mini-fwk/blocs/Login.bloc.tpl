{if isset($login) }	
<ul class="nav navbar-nav navbar-right">
	<li><a href='?module=portailAsso'>{$login}</a></li>
	<li><a href='?module=Connexion&action=deconnect'>| Se déconnecter</a></li>
</ul>


{else}
<ul class="nav navbar-nav navbar-right">
	<li>
		<form class="navbar-form navbar-right" role="form" method='POST' action="index.php?module=Connexion&action=login">
			<div class="form-group">
				<input name='Login' type="textnav" placeholder="Identifiant" class="form-control">
			</div>
			<div class="form-group">
				<input name='Pass' type="passwordnav" placeholder="Pass" class="form-control">
			</div>
		<input type="submit" class="btn btn-success" value='Connexion'>
		</form>
	</li>
	<li><a href="?module=Formulaire_event">Inscription</a></li>
</ul>
{/if}
</div>
