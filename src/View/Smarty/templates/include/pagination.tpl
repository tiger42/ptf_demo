<span>
    {pagination_first
        url=$blogurl
        link="<img src='$baseurl/img/icon_pagination_first.gif' alt='first' />"
        inactivelink="<span class='spacer'>&nbsp;</span>"
    }
    {pagination_prev
        url=$blogurl
        link="<img src='$baseurl/img/icon_pagination_prev.gif' alt='previous' />"
        inactivelink="<span class='spacer'>&nbsp;</span>"
    }
    <span class="pagelist">
        {pagination_list url=$blogurl}
        ({pagination_count})
    </span>
    {pagination_next
        url=$blogurl
        link="<img src='$baseurl/img/icon_pagination_next.gif' alt='next' />"
        inactivelink="<span class='spacer'>&nbsp;</span>"
    }
    {pagination_last
        url=$blogurl
        link="<img src='$baseurl/img/icon_pagination_last.gif' alt='last' />"
        inactivelink="<span class='spacer'>&nbsp;</span>"
    }
</span>
