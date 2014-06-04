<!DOCTYPE HTML>
<html>
    <head>
        <?php $this->include_tpl('include/pagehead.tpl', ['title' => 'Error 404']); ?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <?php $this->include_tpl('include/header.tpl'); ?>
            </div>
            <div id="content">
                <h1>Page not found (Error 404)</h1>
                <p>
                    The requested page was not found.
                </p>
                <p>
                    <a href="<?= $this->context->getBaseUrl(); ?>">Home</a>
                </p>
            </div>
            <div id="footer">
                <?php $this->include_tpl('include/footer.tpl'); ?>
            </div>
        </div>
    </body>
</html>
