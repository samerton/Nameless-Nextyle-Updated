{include file='header.tpl'}
{include file='navbar.tpl'}

<div class="container">
    <div class="card">
        <div class="card-block">
            <h2 style="display:inline">{$SEARCH_RESULTS}</h2>
            <span class="pull-right"><a href="{$NEW_SEARCH_URL}" class="btn btn-{$NEXTYLE_COLOR}">{$NEW_SEARCH}</a></span>
            <br /><br />

            {if isset($RESULTS)}
                {foreach from=$RESULTS item=result}
                    <div class="panel panel-{$NEXTYLE_COLOR}">
                        <div class="panel-heading">
                            <a href="{$result.post_url}" class="white-text">{$result.topic_title}</a>
                            <span class="pull-right" data-toggle="tooltip" title="{$result.post_date_full}">{$result.post_date_friendly}</span>
                        </div>
                        <div class="panel-body">
                            {$result.content}
                            <hr />
                            <a href="{$result.post_author_profile}"><img class="img-circle" src="{$result.post_author_avatar}" style="max-height:40px; max-width:40px;"/></a> <a href="{$result.post_author_profile}" style="{$result.post_author_style}" data-poload="{$USER_INFO_URL}{$result.post_author_id}" data-html="true" data-placement="top">{$result.post_author}</a>
                            <span class="pull-right"><a href="{$result.post_url}" class="btn btn-{$NEXTYLE_COLOR} btn-sm">{$READ_FULL_POST} &raquo;</a></span>
                        </div>
                    </div>
					<br />
                {/foreach}
            {else}
                <div class="alert alert-info">
                    {$NO_RESULTS}
                </div>
            {/if}

            {if isset($PAGINATION)}
                <br />
                {$PAGINATION}
            {/if}
        </div>
    </div>
</div>

{include file='footer.tpl'}