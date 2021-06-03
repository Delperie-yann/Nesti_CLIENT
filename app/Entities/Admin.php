<?php

class Admin
{
    private $idAdmin;



    /**
     * Get the value of idAdmin
     */
    public function getIdAdmin()
    {
        return $this->idAdmin;
    }

    /**
     * Set the value of idAdmin
     */
    public function setIdAdmin($idAdmin) : self
    {
        $this->idAdmin = $idAdmin;

        return $this;
    }
}