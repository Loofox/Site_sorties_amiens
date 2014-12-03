<!-- start template-->
<html>
	<head>
		<title>{$titre}</title>
		<script src='js/jquery-1.10.2.min.js'></script>
		<script src='js/jquery-ui-1.10.3.custom.min.js'></script>	
		<script src='styles/bootstrap/js/bootstrap.min.js'></script>	
		<script src='js/default.js'></script>	
		<link rel='stylesheet' href='styles/ui-lightness/jquery-ui-1.10.3.custom.min.css' />
		<link rel='stylesheet' href='styles/bootstrap/css/bootstrap.min.css' />	
		<link rel='stylesheet' href='styles/defaut.css' />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
	<body>


<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">On va ou ce soir ?</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Sorties du jour</a></li>
        <li><a href="?module=CarteBar">Bars</a></li>
        <li><a href="#">Cinémas</a></li>
        <li><a href="#">Concerts</a></li> 
        <li>
        	<form class="navbar-form navbar-left" role="search">
        		<div class="form-group">
        			<input type="text" class="form-control" placeholder="Search">
        		</div>
        		<button type="submit" class="btn btn-default">Rechercher</button>
        	</form>
        </li>  
      </ul>
      <!--
     <ul class="nav navbar-nav navbar-right">
        
        <li>
        	<form class="navbar-form navbar-left" role="connexion">
       			<div class="form-group">
          			<input type="text" class="form-control" placeholder="Login">
          			<input type="password" class="form-control" placeholder="Pass">
        		</div>
        		<button type="submit" class="btn btn-default">Connexion</button>
      		</form>
        </li>
    

        

      </ul>
      -->
      {$Bloc_Login}
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


    <div class="container">
		<ol class="breadcrumb">
			<li><a href="?module">Home</a></li>
			<li><a href="?module={$module}">{$module}</a></li>
			<li class="active">{$titre}</li>
		</ol>

		{if $messages}
			<div class="bs-callout bs-callout-danger">
				{$messages}
			</div>
		{/if}


		<div id='module'>
			{$bloc_contenu}
		</div>			

			{if $erreurs}
			<div class='alert alert-warning'>
				<h4>Erreurs diverses</h4>			
				<p>
				{$erreurs}
				</p>
			</div>
			{/if}
	</div>
	</body>
		
</html>
<!-- end template-->