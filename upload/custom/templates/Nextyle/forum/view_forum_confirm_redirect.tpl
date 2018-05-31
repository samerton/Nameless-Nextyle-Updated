{include file='navbar.tpl'}

<div class="container">
    <div class="card">
        <div class="card-block">
            {$CONFIRM_REDIRECT}
            <hr />
            <div class="btn-group btn-group-lg" role="group" aria-label="...">
                <a href="{$FORUM_INDEX}" class="btn btn-secondary">{$NO}</a>
                <a href="{$REDIRECT_URL}" target="_blank" rel="noopener nofollow" class="btn btn-{$NEXTYLE_COLOR}">{$YES}</a>
            </div>
        </div>
    </div>
</div>

{include file='footer.tpl'}