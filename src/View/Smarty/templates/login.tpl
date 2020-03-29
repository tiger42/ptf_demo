<!DOCTYPE HTML>
<html>
    <head>
        {include file="include/pagehead.tpl" title="Login"}
    </head>
    <body>
        <div id="main">
            <div id="header">
                {include file="include/header.tpl"}
            </div>
            <div id="content">
                <h1>Enter your login data</h1>
                <p>
                    Use <b>demo/demo</b> or <b>ptf/ptf</b> to log in.
                </p>
                {nocache}
                    {if isset($error) && $error}
                        <span class="error">Invalid username or password</span>
                    {/if}
                    <form class="login" action="{$context->getBaseUrl()}/" method="POST">
                        <input type="hidden" name="controller" value="auth" />
                        <input type="hidden" name="action" value="login" />
                        <p>
                            <label {if isset($error) && $error}class="error"{/if}>Username</label>
                            <input type="text" name="username" maxlength="100"{if isset($username)} value="{$username}"{/if} />
                        </p>
                        <p>
                            <label {if isset($error) && $error}class="error"{/if}>Password</label>
                            <input type="password" name="password" maxlength="100" />
                        </p>
                        <div class="formActions">
                            <input type="submit" value="Login" />
                            <a href="{$context->getBaseUrl()}">cancel</a>
                        </div>
                    </form>
                {/nocache}
            </div>
            <div id="footer">
                {include file="include/footer.tpl"}
            </div>
        </div>
    </body>
</html>
