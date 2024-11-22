<?php

namespace Callmeaf\Geography\Http\Controllers\V1\Api;

use Callmeaf\Base\Enums\ResponseTitle;
use Callmeaf\Base\Http\Controllers\V1\Api\ApiController;
use Callmeaf\Geography\Events\CountryDestroyed;
use Callmeaf\Geography\Events\CountryIndexed;
use Callmeaf\Geography\Events\CountryShowed;
use Callmeaf\Geography\Events\CountryStatusUpdated;
use Callmeaf\Geography\Events\CountryStored;
use Callmeaf\Geography\Events\CountryUpdated;
use Callmeaf\Geography\Http\Requests\V1\Api\CountryDestroyRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\CountryIndexRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\CountryShowRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\CountryStatusUpdateRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\CountryStoreRequest;
use Callmeaf\Geography\Http\Requests\V1\Api\CountryUpdateRequest;
use Callmeaf\Geography\Models\Country;
use Callmeaf\Geography\Services\V1\CountryService;
use Callmeaf\Geography\Utilities\V1\Api\Country\CountryResources;

class CountryController extends ApiController
{
    protected CountryService $countryService;
    protected CountryResources $countryResources;
    public function __construct()
    {
        app(config('callmeaf-country.middlewares.country'))($this);
        $this->countryService = app(config('callmeaf-country.service'));
        $this->countryResources = app(config('callmeaf-country.resources.country'));
    }

    public function index(CountryIndexRequest $request)
    {
        try {
            $resources = $this->countryResources->index();
            $countries = $this->countryService->all(
                relations: $resources->relations(),
                columns: $resources->columns(),
                filters: $request->validated(),
                events: [
                    CountryIndexed::class,
                ],
            )->getCollection(asResourceCollection: true,asResponseData: true,attributes: $resources->attributes());
            return apiResponse([
                'countries' => $countries,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function store(CountryStoreRequest $request)
    {
        try {
            $resources = $this->countryResources->store();
            $country = $this->countryService->create(data: $request->validated(),events: [
                CountryStored::class
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'country' => $country,
            ],__('callmeaf-base::v1.successful_created', [
                'title' => $country->responseTitles(ResponseTitle::STORE),
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function show(CountryShowRequest $request,Country $country)
    {
        try {
            $resources = $this->countryResources->show();
            $country = $this->countryService->setModel($country)->getModel(
                asResource: true,
                attributes: $resources->attributes(),
                relations: $resources->relations(),
                events: [
                    CountryShowed::class,
                ],
            );
            return apiResponse([
                'country' => $country,
            ],__('callmeaf-base::v1.successful_loaded'));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function update(CountryUpdateRequest $request,Country $country)
    {
        try {
            $resources = $this->countryResources->update();
            $country = $this->countryService->setModel($country)->update(data: $request->validated(),events: [
                CountryUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'country' => $country,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $country->responseTitles(ResponseTitle::UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function statusUpdate(CountryStatusUpdateRequest $request,Country $country)
    {
        try {
            $resources = $this->countryResources->statusUpdate();
            $country = $this->countryService->setModel($country)->update([
                'status' => $request->get('status'),
            ],events: [
                CountryStatusUpdated::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'country' => $country,
            ],__('callmeaf-base::v1.successful_updated', [
                'title' =>  $country->responseTitles(ResponseTitle::STATUS_UPDATE)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }

    public function destroy(CountryDestroyRequest $request,Country $country)
    {
        try {
            $resources = $this->countryResources->destroy();
            $country = $this->countryService->setModel($country)->delete(events: [
                CountryDestroyed::class,
            ])->getModel(asResource: true,attributes: $resources->attributes(),relations: $resources->relations());
            return apiResponse([
                'country' => $country,
            ],__('callmeaf-base::v1.successful_deleted', [
                'title' =>  $country->responseTitles(ResponseTitle::DESTROY)
            ]));
        } catch (\Exception $exception) {
            report($exception);
            return apiResponse([],$exception);
        }
    }
}
