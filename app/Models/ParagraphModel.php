<?php

namespace App\Models;

use CodeIgniter\Model;

class ParagraphModel extends Model
{

    protected $table         = 'paragraph';
    protected $allowedFields = ['idParagraph','content','paragraphPosition','dateCreation','idRecipe'];
    protected $returnType    = 'App\Entities\Paragraph';

    public function findParagraphForApi($idRecipe)
    {
     $builder = $this->db->table('view_api_paragraph');
     $builder->where("idRecipe",$idRecipe);
     return $builder->get()->getResult();
    }
}