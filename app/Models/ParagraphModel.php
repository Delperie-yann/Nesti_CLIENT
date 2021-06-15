<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\Paragraph;
class ParagraphModel extends Model
{

    protected $table         = 'paragraph';
      /**
     * @var array<string> $allowedFields 
     */
    protected $allowedFields = ['idParagraph','content','paragraphPosition','dateCreation','idRecipe'];
    protected $returnType    = 'App\Entities\Paragraph';
    protected $primaryKey = 'idParagraph';
       /**
     * @param string $idRecipe
     * @return Paragraph|array<string>
     */
    public function findParagraphForApi(string $idRecipe) 
    {
     $builder = $this->db->table('view_api_paragraph');
     $builder->where("idRecipe",$idRecipe);
     return $builder->get()->getResult();
    }
}