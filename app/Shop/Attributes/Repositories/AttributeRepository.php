<?php

namespace App\Shop\Attributes\Repositories;

use App\Shop\Attributes\Attribute;
use App\Shop\Attributes\Exceptions\CreateAttributeErrorException;
use App\Shop\Attributes\Exceptions\UpdateAttributeErrorException;
use App\Shop\Base\BaseRepository;
use Illuminate\Support\Collection;
use Illuminate\Database\QueryException;

class AttributeRepository extends BaseRepository implements AttributeRepositoryInterface
{
    /**
     * @var Attribute
     */
    protected $model;

    /**
     * AttributeRepository constructor.
     * @param Attribute $attribute
     */
    public function __construct(Attribute $attribute)
    {
        parent::__construct($attribute);
        $this->model = $attribute;
    }

    /**
     * @param array $data
     * @return Attribute
     * @throws CreateAttributeErrorException
     */
    public function createAttribute(array $data) : Attribute
    {
        try {
            $attribute = new Attribute($data);
            $attribute->save();
            return $attribute;
        } catch (QueryException $e) {
            throw new CreateAttributeErrorException($e);
        }
    }

    /**
     * @param array $data
     * @return bool
     * @throws UpdateAttributeErrorException
     */
    public function updateAttribute(array $data) : bool
    {
        try {
            return $this->model->update($data);
        } catch (QueryException $e) {
            throw new UpdateAttributeErrorException($e);
        }
    }

    /**
     * @return bool|null
     */
    public function deleteAttribute() : ?bool
    {
        return $this->model->delete();
    }

    /**
     * @param array $columns
     * @param string $orderBy
     * @param string $sortBy
     * @return Collection
     */
    public function listAttributes($columns = array('*'), string $orderBy = 'id', string $sortBy = 'asc') : Collection
    {
        return $this->all($columns, $orderBy, $sortBy);
    }
}