<?php

namespace PtfDemo\Core\Auth;

/**
 * Application specific Auth class.
 *
 * For demonstration purposes we have overridden the default checkPassword() method to change the password hashing algorithm.
 */
class PtfDemo extends \Ptf\Core\Auth\DB
{
    /**
     * Test the user's password against the hash value (MD5) from the DB.
     *
     * @param string $password  The password to test against the hash
     * @param string $hash      The MD5 hash value from the DB
     *
     * @return boolean  Does the password match?
     */
    protected function checkPassword(string $password, string $hash): bool
    {
        return md5($password) == $hash;
    }
}
