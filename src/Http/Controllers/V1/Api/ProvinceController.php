<?php

namespace Callmeaf\Geography\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Geography\Events\ProvinceDestroyed;
use Callmeaf\Geography\Events\ProvinceIndexed;
use Callmeaf\Geography\Events\ProvinceShowed;
use Callmeaf\Geography\Events\ProvinceStatusUpdated;
use Callmeaf\Geography\Events\ProvinceStored;
use Callmeaf\Geography\Events\ProvinceUpdated;
use Callmeaf\Geography\Http\Requests\V1\Api\ProvinceDestroyRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ProvinceIndexRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ProvinceShowRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ProvinceStatusUpdateRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ProvinceStoreRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ProvinceUpdateRequest;
use Callmeaf\Geography\Models\Province;
use Callmeaf\Geography\Services\V1\ProvinceService;
use Callmeaf\Geography\Utilities\V1\Api\Province\ProvinceResources;

class ProvinceController extends ApiController
{
    protected ProvinceService $provinceService;
    protected ProvinceResources $provinceResources;
    public function __construct()
    {
        app(config('callmeaf-province.middlewares.province'))($this);
        $this->provinceService = app(config('callmeaf-province.service'));
        $this->provinceResources = app(config('callmeaf-province.resources.province'));
    }

    public function index(ProvinceIndexRequest $request)
    {
        try {
            $resources = $this->provinceResources->index();
            $provinces = $this->provinceService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    ProvinceIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
            return apiResponse([
                'provinces' => $provinces,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(ProvinceStoreRequest $request)
    {
        try {
            $resources = $this->provinceResources->store();
            $province = $this->provinceService->create(data: $request->validated(),events: [
                ProvinceStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'province' => $province,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $province->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(ProvinceShowRequest $request,Province $province)
    {
        try {
            $resources = $this->provinceResources->show();
            $province = $this->provinceService->setModel($province)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    ProvinceShowed::class,
                ],
            );
            return apiResponse([
                'province' => $province,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(ProvinceUpdateRequest $request,Province $province)
    {
        try {
            $resources = $this->provinceResources->update();
            $province = $this->provinceService->setModel($province)->update(data: $request->validated(),events: [
                ProvinceUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'province' => $province,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $province->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(ProvinceStatusUpdateRequest $request,Province $province)
    {
        try {
            $resources = $this->provinceResources->statusUpdate();
            $province = $this->provinceService->setModel($province)->update([
                'status' => $request->get('status'),
            ],events: [
                ProvinceStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'province' => $province,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $province->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(ProvinceDestroyRequest $request,Province $province)
    {
        try {
            $resources = $this->provinceResources->destroy();
            $province = $this->provinceService->setModel($province)->delete(events: [
                ProvinceDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'province' => $province,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $province->responseTitles(ResponseTitle::DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
