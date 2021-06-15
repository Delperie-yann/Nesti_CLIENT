<?php

namespace App\Models;

use App\Entities\Recipes;
use App\Entities\Ingredient;
use App\Entities\Cat;
use CodeIgniter\Model;

class RecipesModel extends Model
{
    protected $table         = 'recipe';
    /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idRecipe', 'dateCreation', 'name', 'difficulty', 'portions', 'flag', 'preparationsTime', 'idChef', 'idImage', 'idCat'];
    protected $returnType    = 'App\Entities\Recipes';
    protected $primaryKey = 'idRecipe';


    /**
     *
     * @return Recipes|null
     */
    public function findAllForApi() 
    {
        $query = $this->db->query('SELECT * FROM recipe');
        return $query->getResult();
    }

    /**
     *@param string  $cat
     * @return Cat|array<string>
     */
    public function findCatForApi(string $cat) 
    {
        $query = $this->db->table('view_api_recipes');
        $query->where("cat", $cat);
        return $query->get()->getResult();
    }

    /**
     *@param string  $idRecipe
     * @return Ingredient|array<string>
     */
    public function findIngredientForApi(string $idRecipe) 
    {
        $builder = $this->db->table('view_api_ingredient');
        $builder->where("idRecipe", $idRecipe);
        return $builder->get()->getResult();
    }
    /**
     * @param string  $name
     * @return Recipes|array<string>
     */
    public function findRecipeForApi(string $name) 
    {
        $builder = $this->db->table('view_api_name');
        $builder->Like("name", $name);
        return $builder->get()->getResult();
    }
}
