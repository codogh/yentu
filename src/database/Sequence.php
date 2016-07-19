<?php
namespace yentu\database;

class Sequence extends \yentu\database\DatabaseItem
{
    private $name;
    private $schema;
    
    public function __construct($name, $schema) 
    {
        $this->name = $name;
        $this->schema = $schema;
        $sequence = $this->getDriver()->doesSequenceExist($this->buildDescription());
       
        if($sequence === false)
        {
            $this->new = true;
        }
    }
    
    public function drop()
    {
        $this->getDriver()->dropSequence($this->buildDescription());
        return $this;
    }
    
    public function commitNew() 
    {
        $this->getDriver()->addSequence($this->buildDescription());
    }
    
    protected function buildDescription() {
        return array(
            'name' => $this->name,
            'schema' => $this->schema->getName()
        );
    }    
}
