<!DOCTYPE HTML>
<html>
    <head>
        <?php $this->include_tpl('include/pagehead.tpl.php', ['title' => 'Login']); ?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <?php $this->include_tpl('include/header.tpl'); ?>
            </div>
            <div id="content">
                <h1>Please log in</h1>
                <p>
                    Use <b>demo/demo</b> or <b>ptf/ptf</b> to log in.
                </p>
                <?php if (isset($this->error) && $this->error): ?>
                    <span class="error">Invalid username or password</span>
                <?php endif; ?>
                <form class="login" action="<?= $this->context->getBaseUrl(); ?>/" method="POST">
                    <input type="hidden" name="controller" value="auth" />
                    <input type="hidden" name="action" value="login" />
                    <p>
                        <label<?php if (isset($this->error) && $this->error): ?> class="error"<?php endif; ?>>Username</label>
                        <input type="text" name="username" maxlength="100"<?php if (isset($this->username)): ?> value="<?= $this->username; ?>"<?php endif; ?> />
                    </p>
                    <p>
                        <label<?php if (isset($this->error) && $this->error): ?> class="error"<?php endif; ?>>Password</label>
                        <input type="password" name="password" maxlength="100" />
                    </p>
                    <input type="submit" value="Login" />
                </form>
            </div>
            <div id="footer">
                <?php $this->include_tpl('include/footer.tpl.php'); ?>
            </div>
        </div>
    </body>
</html>
