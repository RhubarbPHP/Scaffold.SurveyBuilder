<?php

namespace Rhubarb\Scaffolds\SurveyBuilder\Models;


use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\ModelSchema;

class Survey extends Model
{

    /**
     * Returns the schema for this data object.
     *
     * @return \Rhubarb\Stem\Schema\ModelSchema
     */
    protected function createSchema()
    {
        $schema = new ModelSchema( "tblSurvey" );
        return $schema;
    }
}