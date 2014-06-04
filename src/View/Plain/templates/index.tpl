<!DOCTYPE HTML>
<html>
    <head>
        <?php $this->include_tpl('include/pagehead.tpl', ['title' => 'Home']); ?>
    </head>
    <body>
        <div id="main">
            <div id="header">
                <?php $this->include_tpl('include/header.tpl'); ?>
                <?php $baseurl = $this->context->getBaseUrl(); ?>
            </div>
            <div id="menu">
                <?php if ($this->loggedIn): ?>
                    <a href="<?= $baseurl; ?>/article/edit">New Article</a> |
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
                        <span>
                            <?= $this->pagination_first([
                                'url'  => $blogurl,
                                'link' => "<img src='$baseurl/img/icon_pagination_first.gif' alt='first' />",
                                'inactivelink' => "<span class='spacer'>&nbsp;</span>"
                            ]); ?>
                            <?= $this->pagination_prev([
                                'url'  => $blogurl,
                                'link' => "<img src='$baseurl/img/icon_pagination_prev.gif' alt='previous' />",
                                'inactivelink' => "<span class='spacer'>&nbsp;</span>"
                            ]); ?>
                            <span class="pagelist">
                                <?= $this->pagination_list(['url' => $blogurl]); ?>
                                (<?= $this->pagination_count(); ?>)
                            </span>
                            <?= $this->pagination_next([
                                'url'  => $blogurl,
                                'link' => "<img src='$baseurl/img/icon_pagination_next.gif' alt='next' />",
                                'inactivelink' => "<span class='spacer'>&nbsp;</span>"
                            ]); ?>
                            <?= $this->pagination_last([
                                'url'  => $blogurl,
                                'link' => "<img src='$baseurl/img/icon_pagination_last.gif' alt='last' />",
                                'inactivelink' => "<span class='spacer'>&nbsp;</span>"
                            ]); ?>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
            <div id="footer">
                <?php $this->include_tpl('include/footer.tpl'); ?>
            </div>
        </div>
    </body>
</html>
