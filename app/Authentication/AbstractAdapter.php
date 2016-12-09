<?php
namespace App\Authentication;
/* 
 * Authenticate abstractAdapter
 * @author Thieu.LeQuang <quangthieuagu@gmail.com>
 */
abstract class AbstractAdapter
{
    /**
     * @var mixed
     */
    protected $credential;

    /**
     * @var mixed
     */
    protected $identity;
    

    /**
     * Returns the credential of the account being authenticated, or
     * NULL if none is set.
     *
     * @return mixed
     */
    public function getCredential()
    {
        return $this->credential;
    }

    /**
     * Sets the credential for binding
     *
     * @param  mixed           $credential
     * @return AbstractAdapter
     */
    public function setCredential($credential)
    {
        $this->credential = $credential;

        return $this;
    }

    /**
     * Returns the identity of the account being authenticated, or
     * NULL if none is set.
     *
     * @return mixed
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * Sets the identity for binding
     *
     * @param  mixed          $identity
     * @return AbstractAdapter
     */
    public function setIdentity($identity)
    {
        $this->identity = $identity;

        return $this;
    }
}
