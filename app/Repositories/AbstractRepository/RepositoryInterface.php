<?php
/*
 * Created by PhpStorm.
 * Developer: Tariq Ayman ( tariq.ayman94@gmail.com )
 * Date: 4/14/22, 12:06 AM
 * Last Modified: 4/14/22, 12:03 AM
 * Project Name: GenCode
 * File Name: RepositoryInterface.php
 */

namespace App\Repositories\AbstractRepository;

interface RepositoryInterface
{
    /**
     * @param string $key
     * @param $value
     * @param bool $withTrashed
     * @return mixed
     */
    public function exists(string $key, $value, bool $withTrashed = false): bool;

    /**
     * @param string $attr_name
     * @param mixed $attr_value
     * @param array $relations
     * @param bool $withTrashed
     * @param array $selects
     * @return mixed
     */
    public function getByAttribute(
        string $attr_name,
               $attr_value,
        array  $relations = [],
        bool   $withTrashed = false,
        array  $selects = []
    );

    /**
     * @param int $n
     * @param array $relations
     * @param bool $withTrashed
     * @param array $selects
     * @return mixed
     */
    public function getPaginate(int $n, array $relations = [], bool $withTrashed = false, array $selects = []);

    /**
     * @param array $inputs
     * @return mixed
     */
    public function store(array $inputs);

    /**
     * @param $id
     * @param array $relations
     * @param bool $withTrashed
     * @param array $selects
     * @return mixed
     */
    public function getById($id, array $relations = [], bool $withTrashed = false, array $selects = []);

    /**
     * @param $key
     * @param $value
     * @param array $relations
     * @param bool $withTrashed
     * @param array $selects
     * @return mixed
     */
    public function search($key, $value, array $relations = [], bool $withTrashed = false, array $selects = []);

    /**
     * @param array $relations
     * @param bool $withTrashed
     * @param array $selects
     * @return mixed
     */
    public function getAll(array $relations = [], bool $withTrashed = false, array $selects = []);

    /**
     * @param bool $withTrashed
     * @return mixed
     */
    public function countAll(bool $withTrashed = false);

    /**
     * @param $key
     * @return mixed
     */
    public function getAllSelectable($key);

    /**
     * @param $id
     * @param array $inputs
     * @return mixed
     */
    public function update($id, array $inputs);

    /**
     * @param $id
     * @return bool
     */
    public function destroy($id): bool;

    /**
     * @return bool
     */
    public function destroyAll(): bool;

    /**
     * @param $id
     * @return bool
     */
    public function forceDelete($id): bool;

    /**
     * @param $id
     * @return bool
     */
    public function restore($id): bool;
}
