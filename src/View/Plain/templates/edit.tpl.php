<!DOCTYPE HTML>
<html>
    <head>
        <?php $title = $this->blogEntry['id'] ? 'Edit Article' : 'Create Article'; ?>
        <?php $this->include_tpl('include/pagehead.tpl.php', ['title' => $title]); ?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <?php $this->include_tpl('include/header.tpl'); ?>
            </div>
            <div id="content">
                <h1><?php if ($this->blogEntry['id']): ?>Edit<?php else: ?>Create<?php endif; ?> blog article</h1>
                <?php if (isset($this->saveSuccess) && !$this->saveSuccess): ?>
                    <span class="error">Error saving article.</span>
                <?php endif; ?>
                <form class="article" action="<?= $this->context->getBaseUrl(); ?>/" method="POST">
                    <input type="hidden" name="controller" value="article" />
                    <input type="hidden" name="action" value="save" />
                    <input type="hidden" name="blogEntry:id" value="<?= $this->blogEntry['id']; ?>" />
                    <p>
                        <label>Headline</label>
                        <input type="text" name="blogEntry:headline" value="<?= $this->blogEntry['headline']; ?>" />
                    </p>
                    <p>
                        <label>Text of article</label><br />
                        <textarea name="blogEntry:content"><?= $this->blogEntry['content']; ?></textarea>
                    </p>
                    <input type="submit" value="Save" />
                </form>
            </div>
            <div id="footer">
                <?php $this->include_tpl('include/footer.tpl.php'); ?>
            </div>
        </div>
    </body>
</html>
