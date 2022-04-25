<?php
namespace Boxun\Model\Caption;

use Boxun\Model\Model;

class AllStagesModel extends Model
{
    protected $primaryKey = 'id';
    protected $isAutoIncr = true;
    protected $table = 'all_stages';

    protected function filter($filter)
    {
        if (isset($filter['last_id'])) {
            $this->db()->where('id', $filter['last_id'], '>');
        }

        if (isset($filter['type'])) {
            $this->db()->where('type', $filter['type']);
        }

        if (isset($filter['status'])) {
            $this->db()->where('status', $filter['status']);
        }
    }
}