<?php
/**
 * Created by PhpStorm.
 * User: Dave
 * Date: 8/19/2018
 * Time: 12:58 PM
 */

namespace App\Services\Package;


use App\Constants;
use App\Exceptions\SubscriptionException;
use App\Models\Package;

class PackageService
{
    public function __construct(Package $model)
    {
        $this->model = $model;
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * @param array $request
     * @return mixed
     */
    public function create($request = [])
    {
        return $this->model->create(array_only($request, $this->model->getFillable()));
    }

    /***
     * @param Package $package
     * @param array $request
     * @return Package
     */
    public function update(Package $package, $request = [])
    {
        $package->update(array_only($request, $package->getFillable()));

        return $package;
    }


    /**
     * @param Package $package
     * @return Package
     */
    public function destroy(Package $package)
    {
        $package->status = Constants::STATUS_DELETED;

        $package->save();

        return $package;
    }
}