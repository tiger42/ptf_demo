<!DOCTYPE HTML>
<html>
    <head>
        <?php $this->include_tpl('include/pagehead.tpl.php', ['title' => 'Home']); ?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <?php $this->include_tpl('include/header.tpl.php'); ?>
                <?php $baseurl = $this->context->getBaseUrl(); ?>
            </div>
            <div id="menu">
                <?php if ($this->loggedIn): ?>
                    <a href="<?= $baseurl; ?>/article/create">New Article</a> |
                    <a href="<?= $baseurl; ?>/auth/logout">Logout</a>
                <?php else: ?>
                    <a href="<?= $baseurl; ?>/show/login">Login</a>
                <?php endif; ?>
            </div>
            <div id="content">
                <?php if (isset($this->saveSuccess) && $this->saveSuccess): ?>
                    <span class="message success">
                        Article successfully saved.
                    </span>
                <?php endif; ?>

                <?php if ($this->entryCount): ?>
                    <div id="blogEntries">
                        <?php while ($this->blogEntry->fetch($this->offset, $this->count)): ?>
                            <div class="blogEntry">
                                <div class="headline">
                                    <h2><?= $this->blogEntry['headline']; ?></h2>
                                    <span class="createdDate">
                                        <?= date_format(date_create($this->blogEntry['created_at']), 'd-M-Y H:i'); ?>
                                    </span>
                                </div>
                                <div class="text">
                                    <p>
                                        <?= $this->dblbr2p(nl2br($this->blogEntry['content'])); ?>
                                    </p>
                                </div>
                                <div class="footerLine">
                                    <span class="editedBy">
                                        last edited by <b><?= $this->blogEntry['username']; ?></b> on
                                        <?= $this->blogEntry['updated_at']; ?>
                                    </span>
                                    <?php if ($this->loggedIn): ?>
                                        <br />
                                        <a href="<?= $baseurl; ?>/article/edit?id=<?= $this->blogEntry['be_id']; ?>">(edit)</a>
                                        <a href="<?= $baseurl; ?>/article/delete?id=<?= $this->blogEntry['be_id']; ?>"
                                            onclick="return window.confirm('Do you really want to delete the article?');">(delete)</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>

                <?php if ($this->showPagination): ?>
                    <?php $blogurl = $baseurl . '/show/blog'; ?>
                    <div class="pagination">
                        <?php $this->include_tpl('include/pagination.tpl.php', ['baseurl' => $baseurl, 'url' => $blogurl]); ?>
                    </div>
                <?php endif; ?>
            </div>
            <div id="footer">
                <?php $this->include_tpl('include/footer.tpl.php'); ?>
            </div>
        </div>
    </body>
</html>
