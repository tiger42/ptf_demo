<!DOCTYPE HTML>
<html>
    <head>
        {include file="include/pagehead.tpl" title="Edit Article"}
    </head>
    <body>
        <div id="main">
            <div id="header">
                {include file="include/header.tpl"}
            </div>
            <div id="content">
                {nocache}
                    <h1>{if $blogEntry.id}Edit{else}Create{/if} blog article</h1>
                    {if isset($saveSuccess) && !$saveSuccess}
                        <span class="error">Error saving article.</span>
                    {/if}
                    <form class="article" action="{$context->getBaseUrl()}/" method="POST">
                        <input type="hidden" name="controller" value="article" />
                        <input type="hidden" name="action" value="save" />
                        <input type="hidden" name="blogEntry:id" value="{$blogEntry.id}" />
                        <p>
                            <label>Headline</label>
                            <input type="text" name="blogEntry:headline" value="{$blogEntry.headline}" />
                        </p>
                        <p>
                            <label>Text of article</label><br />
                            <textarea name="blogEntry:content">{$blogEntry.content}</textarea>
                        </p>
                        <input type="submit" value="Save" />
                    </form>
                {/nocache}
            </div>
            <div id="footer">
                {include file="include/footer.tpl"}
            </div>
        </div>
    </body>
</html>
