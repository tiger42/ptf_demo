<?php

namespace PtfDemo\Model\DB\Table;

use PtfDemo\App\Context;
use PtfDemo\Model\DB\Table\BlogEntries as BlogEntriesTable;
use Ptf\Model\DB\Table;

/**
 * Model class for the "blog_entries" DB table.
 */
class BlogEntries extends \Ptf\Model\DB\Table
{
    /**
     * Initialize the table object from the config data.
     *
     * @param Context $context  The application's context
     */
    public function __construct(Context $context)
    {
        $dbConfig = $context->getConfig('DB_Local');

        parent::__construct('blog_entries', $dbConfig, $context);
    }

    /**
     * Join this table with the "users" table.
     *
     * @return BlogEntriesTable  This object (for fluent interface)
     */
    public function joinUsers(): BlogEntriesTable
    {
        $users = new Table('users', $this->getDB()->getConfig(), $this->context);

        return $this->join($users, 'users.id = user_id', Table::LEFT_JOIN);
    }
}
