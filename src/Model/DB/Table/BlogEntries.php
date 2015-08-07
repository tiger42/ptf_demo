<?php

namespace PtfDemo\Model\DB\Table;

/**
 * Model class for the "blog_entries" DB table
 */
class BlogEntries extends \Ptf\Model\DB\Table
{
    /**
     * Initialize the table object from the config data
     *
     * @param   \PtfDemo\App\Context $context The application's context
     */
    public function __construct(\PtfDemo\App\Context $context)
    {
        $dbConfig = $context->getConfig('DB_Local');

        parent::__construct('blog_entries', $dbConfig, $context);
    }

    /**
     * Join this table with the "users" table
     *
     * @return  \PtfDemo\Model\DB\Table\BlogEntries This object (for fluent interface)
     */
    public function joinUsers()
    {
        $users = new \Ptf\Model\DB\Table('users', $this->getDB()->getConfig(), $this->context);

        return $this->join($users, 'users.id = user_id', \Ptf\Model\DB\Table::LEFT_JOIN);
    }

}
