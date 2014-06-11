<span>
    <?= $this->pagination_first([
        'url'  => $url,
        'link' => "<img src='$baseurl/img/icon_pagination_first.gif' alt='first' />",
        'inactivelink' => "<span class='spacer'>&nbsp;</span>"
    ]); ?>
    <?= $this->pagination_prev([
        'url'  => $url,
        'link' => "<img src='$baseurl/img/icon_pagination_prev.gif' alt='previous' />",
        'inactivelink' => "<span class='spacer'>&nbsp;</span>"
    ]); ?>
    <span class="pagelist">
        <?= $this->pagination_list(['url' => $url]); ?>
        (<?= $this->pagination_count(); ?>)
    </span>
    <?= $this->pagination_next([
        'url'  => $url,
        'link' => "<img src='$baseurl/img/icon_pagination_next.gif' alt='next' />",
        'inactivelink' => "<span class='spacer'>&nbsp;</span>"
    ]); ?>
    <?= $this->pagination_last([
        'url'  => $url,
        'link' => "<img src='$baseurl/img/icon_pagination_last.gif' alt='last' />",
        'inactivelink' => "<span class='spacer'>&nbsp;</span>"
    ]); ?>
</span>
