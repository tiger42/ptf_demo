<!DOCTYPE HTML>
<html>
    <head>
        {include file="include/pagehead.tpl" title="Error 404"}
    </head>
    <body>
        <div id="main">
            <div id="header">
                {include file="include/header.tpl"}
            </div>
            <div id="content">
                <h1>Page not found (Error 404)</h1>
                <p>
                    The requested page was not found.
                </p>
                <p>
                    <a href="{$context->getBaseUrl()}">Home</a>
                </p>
            </div>
            <div id="footer">
                {include file="include/footer.tpl"}
            </div>
        </div>
    </body>
</html>
