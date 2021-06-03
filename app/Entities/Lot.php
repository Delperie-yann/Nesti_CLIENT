<?php
namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\ArticlesModel;
use App\Models\ProductModel;
use App\Models\ImageModel;

class Lot extends Entity
{

    /**
     * Get the value of idArticle
     */
    public function getIdArticle()
    {
        return $this->idArticle;
    }

    /**
     * Set the value of idArticle
     */
    public function setIdArticle($idArticle) : self
    {
        $this->idArticle = $idArticle;

        return $this;
    }

    /**
     * Get the value of idSupplierOrder
     */
    public function getIdSupplierOrder()
    {
        return $this->idSupplierOrder;
    }

    /**
     * Set the value of idSupplierOrder
     */
    public function setIdSupplierOrder($idSupplierOrder) : self
    {
        $this->idSupplierOrder = $idSupplierOrder;

        return $this;
    }

    /**
     * Get the value of unitCost
     */
    public function getUnitCost()
    {
        return $this->unitCost;
    }

    /**
     * Set the value of unitCost
     */
    public function setUnitCost($unitCost) : self
    {
        $this->unitCost = $unitCost;

        return $this;
    }

    /**
     * Get the value of dateReception
     */
    public function getDateReception()
    {
        return $this->dateReception;
    }

    /**
     * Set the value of dateReception
     */
    public function setDateReception($dateReception) : self
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    /**
     * Get the value of quantity
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set the value of quantity
     */
    public function setQuantity($quantity) : self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function setLotFromArray($recipe)
    {

        foreach ($recipe as $key => $value) {

            $this->$key = $value;
        }
    }

    }
