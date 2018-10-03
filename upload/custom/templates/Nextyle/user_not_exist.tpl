{include file='header.tpl'}
{include file='navbar.tpl'}
<br />
<div class="container">
  <div class="row">
	<div class="col-md-6 offset-md-3">
	  <div class="jumbotron">
		<center>
		  <h2>{$NOT_FOUND}</h2>
		  <br />
		  <div class="btn-group" role="group" aria-label="...">
			<button href="#" class="btn btn-primary btn-lg" onclick="javascript:history.go(-1)">{$BACK}</button>
			<a href="{$SITE_HOME}" class="btn btn-success btn-lg">{$HOME}</a>
		  </div>
		</center>
	  </div>
	</div>
  </div>
</div>
{include file='footer.tpl'}