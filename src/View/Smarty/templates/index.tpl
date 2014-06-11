<!DOCTYPE HTML>
<html>
    <head>
        {include file="include/pagehead.tpl" title="Home"}
    </head>
    <body>
        <div id="main">
            <div id="header">
                {include file="include/header.tpl"}
            </div>
            {nocache}
                {assign var=baseurl value=$context->getBaseUrl() nocache}
                <div id="menu">
                    {if $loggedIn}
                        <a href="{$baseurl}/article/edit">New Article</a> |
                        <a href="{$baseurl}/auth/logout">Logout</a>
                    {else}
                        <a href="{$baseurl}/show/login">Login</a>
                    {/if}
                </div>
                <div id="content">
                    {if isset($saveSuccess) && $saveSuccess}
                        <span class="message success">
                            Article successfully saved.
                        </span>
                    {/if}

                    {if $entryCount}
                        <div id="blogEntries">
                            {fetch_dbtable dbtable=$blogEntry offset=$offset count=$count}
                                <div class="blogEntry">
                                    <div class="headline">
                                        <h2>{$blogEntry.headline}</h2>
                                        <span class="createdDate">
                                            {$blogEntry.created_at|date_format:"d-M-Y H:i"}
                                        </span>
                                    </div>
                                    <div class="text">
                                        <p>
                                            {$blogEntry.content|nl2br|dblbr2p}
                                        </p>
                                    </div>
                                    <div class="footerLine">
                                        <span class="editedBy">
                                            last edited by <b>{$blogEntry.username}</b> on
                                            {$blogEntry.updated_at}
                                        </span>
                                        {if $loggedIn}
                                            <br />
                                            <a href="{$baseurl}/article/edit?id={$blogEntry.be_id}">(edit)</a>
                                            <a href="{$baseurl}/article/delete?id={$blogEntry.be_id}"
                                                onclick="return window.confirm('Do you really want to delete the article?');">(delete)</a>
                                        {/if}
                                    </div>
                                </div>
                            {/fetch_dbtable}
                        </div>
                    {/if}

                    {if $showPagination}
                        {assign var=blogurl value=$baseurl|cat:"/show/blog" nocache}
                        <div class="pagination">
                            {include file="include/pagination.tpl"}
                        </div>
                    {/if}
                </div>
            {/nocache}
            <div id="footer">
                {include file="include/footer.tpl"}
            </div>
        </div>
    </body>
</html>
