<?php

namespace Callmeaf\Geography\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Geography\Events\ContinentDestroyed;
use Callmeaf\Geography\Events\ContinentIndexed;
use Callmeaf\Geography\Events\ContinentShowed;
use Callmeaf\Geography\Events\ContinentStatusUpdated;
use Callmeaf\Geography\Events\ContinentStored;
use Callmeaf\Geography\Events\ContinentUpdated;
use Callmeaf\Geography\Http\Requests\V1\Api\ContinentDestroyRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ContinentIndexRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ContinentShowRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ContinentStatusUpdateRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ContinentStoreRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\ContinentUpdateRequest;
use Callmeaf\Geography\Models\Continent;
use Callmeaf\Geography\Services\V1\ContinentService;
use Callmeaf\Geography\Utilities\V1\Api\Continent\ContinentResources;

class ContinentController extends ApiController
{
    protected ContinentService $continentService;
    protected ContinentResources $continentResources;
    public function __construct()
    {
        app(config('callmeaf-continent.middlewares.continent'))($this);
        $this->continentService = app(config('callmeaf-continent.service'));
        $this->continentResources = app(config('callmeaf-continent.resources.continent'));
    }

    public function index(ContinentIndexRequest $request)
    {
        try {
            $resources = $this->continentResources->index();
            $continents = $this->continentService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    ContinentIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
            return apiResponse([
                'continents' => $continents,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(ContinentStoreRequest $request)
    {
        try {
            $resources = $this->continentResources->store();
            $continent = $this->continentService->create(data: $request->validated(),events: [
                ContinentStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'continent' => $continent,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $continent->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(ContinentShowRequest $request,Continent $continent)
    {
        try {
            $resources = $this->continentResources->show();
            $continent = $this->continentService->setModel($continent)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    ContinentShowed::class,
                ],
            );
            return apiResponse([
                'continent' => $continent,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(ContinentUpdateRequest $request,Continent $continent)
    {
        try {
            $resources = $this->continentResources->update();
            $continent = $this->continentService->setModel($continent)->update(data: $request->validated(),events: [
                ContinentUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'continent' => $continent,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $continent->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(ContinentStatusUpdateRequest $request,Continent $continent)
    {
        try {
            $resources = $this->continentResources->statusUpdate();
            $continent = $this->continentService->setModel($continent)->update([
                'status' => $request->get('status'),
            ],events: [
                ContinentStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'continent' => $continent,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $continent->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(ContinentDestroyRequest $request,Continent $continent)
    {
        try {
            $resources = $this->continentResources->destroy();
            $continent = $this->continentService->setModel($continent)->delete(events: [
                ContinentDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'continent' => $continent,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $continent->responseTitles(ResponseTitle::DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
