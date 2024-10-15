@extends('back.layout')

@section('title', __('crud.meta.all_models', ['model' => str(__('models.statistic'))->plural()]))
@section('description', __('crud.meta.all_models_list', ['model' => str(__('models.statistic'))->plural()]))

@section('content')
    <section id="statistics">
        <div class="d-flex justify-content-between flex-md-nowrap align-items-center flex-wrap">
            @include('breadcrumbs.breadcrumb-body')
        </div>
        <!-- LATEST DATA UPDATED -->
        @if (count($navLinks))
            <div class="row py-3">
                <div class="col-12 py-0">
                    @include('back.pages.statistics.partials.latest-data')
                </div>
            </div>
        @endif
        <div class="row">
            <!-- CHARTS -->
            @php
                $array = [
                    ['models' => $activityModels, 'blade' => 'chart-activities'],
                    ['models' => $globalTags, 'blade' => 'chart-games-by-tags'],
                    ['models' => $globalFolders, 'blade' => 'chart-games-by-folders'],
                ]
            @endphp
            @foreach($array as $item)
                @if (count($item['models']))
                    <div class="col-12 mb-3">
                        <div class="card bg-body-tertiary border-top rounded-3 p-md-5 p-3">
                            @include("back.pages.statistics.partials.{$item['blade']}")
                        </div>
                    </div>
                @endif
            @endforeach
            <!-- COUNTERS -->
            <div class="col-12">
                <div class="card bg-body-tertiary border-top rounded-3 p-md-5 p-3">
                    <div class="row">
                        @php
                            $arrayCounters = [
                                ['models' => $ratingModels, 'blade' => 'most-liked-pictures'],
                                ['models' => $visitModels, 'blade' => 'most-visited-pages'],
                            ]
                        @endphp
                        @foreach($arrayCounters as $item)
                            <div class="col-12 col-xxl-6">
                                @include("back.pages.statistics.partials.{$item['blade']}")
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
