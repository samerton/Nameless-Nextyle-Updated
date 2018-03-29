{include file='navbar.tpl'}

<div class="home-news">
  <div class="container">
    <br />
    {if isset($HOME_SESSION_FLASH)}
      <div class="alert alert-info">
        {$HOME_SESSION_FLASH}
      </div>
    {/if}
    {if isset($HOME_SESSION_ERROR_FLASH)}
      <div class="alert alert-danger">
        {$HOME_SESSION_ERROR_FLASH}
      </div>
    {/if}
	<div class="row">
	
	  {if isset($NEWS)}
	  <div class="col-md-8">
	    <center><h2>{$LATEST_ANNOUNCEMENTS} <i class="fa fa-bullhorn"></i></h2></center>
		<hr />
		{foreach from=$NEWS item=item}
		<div class="card">
		  <div class="card-header text-white header-{$NEXTYLE_COLOR}">
			<a href="{$item.url}">{$item.title}</a>
			<span class="pull-right" data-toggle="tooltip" title="{$item.date}">{$item.time_ago}</span>
		  </div>
		  <div class="card-block">
			{$item.content}
			<hr />
			<a href="{$item.author_url}"><img class="img-circle" src="{$item.author_avatar}" style="max-height:30px; max-width=30px;" /></a> <a href="{$item.author_url}" style="{$item.author_style}">{$item.author_name}</a>
		    <span class="pull-right"><a href="{$item.url}" class="btn btn-{$NEXTYLE_COLOR} btn-sm">{$READ_FULL_POST} &raquo;</a></span>
		  </div>
		</div>
		{/foreach}
	  </div>
	  <div class="col-md-4">
	  
	  {else}
	  <div class="col-md-4 offset-md-4">
	  {/if}
	  
	    <center><h2>{$SOCIAL} <i class="fa fa-users" aria-hidden="true"></i></h2></center>
	    <hr />
		{if count($WIDGETS)}
		  {foreach from=$WIDGETS item=widget}
			{$widget}
			<br /><br />
		  {/foreach}
		{/if}
	    
	  </div>
	</div>
  </div>
</div>

<br />

{include file='footer.tpl'}