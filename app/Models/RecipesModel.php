<?php

namespace App\Models;

use CodeIgniter\Model;

class RecipesModel extends Model
{
    protected $table         = 'recipe';
    protected $allowedFields = ['idRecipe','dateCreation','name','difficulty','portions','flag','preparationsTime','idChef','idImage','idCat'];
    protected $returnType    = 'App\Entities\Recipes';
 
    public function findAllForApi()
    {
        $query = $this->db->query('SELECT * FROM recipe');
        return $query->getResult();
    }
    public function findCatForApi($cat)
    {
        $query = $this->db->table('view_api_recipes');
        $query->where("cat", $cat);
        return $query->get()->getResult();
    }

    public function findIngredientForApi($idRecipe)
    {
        $builder = $this->db->table('view_api_ingredient');
        $builder->where("idRecipe", $idRecipe);
        return $builder->get()->getResult();
    }
    public function findRecipeForApi($name)
    {
        $builder = $this->db->table('view_api_name');
        $builder->Like("name", $name);
        return $builder->get()->getResult();
    }
}
