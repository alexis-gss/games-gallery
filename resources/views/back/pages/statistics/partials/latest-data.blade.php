<div class="card card-stats border-0">
    <ul class="nav nav-tabs" id="tab-latest-data-updated" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                type="button" role="tab" aria-controls="disabled-tab-pane" aria-selected="false" disabled>
                {{ __('bo_other_stats_latest_model') }}
            </button>
        </li>
        @foreach ($navLinks as $navLink)
            <li class="nav-item" role="presentation">
                <button id="{{ $navLink['name'] }}-tab" data-bs-toggle="tab"
                    data-bs-target="#{{ $navLink['name'] }}-tab-pane" type="button" role="tab"
                    aria-controls="{{ $navLink['name'] }}-tab-pane" aria-selected="true" @class(['nav-link', 'active' => $loop->first])>
                    {{ str($navLink['translation'])->ucFirst() }}
                </button>
            </li>
        @endforeach
    </ul>
    <div class="tab-content border-top-0 rounded-bottom border" id="tab-latest-data-updated-content">
        @foreach ($navLinks as $navLink)
            <div id="{{ $navLink['name'] }}-tab-pane" role="tabpanel" aria-labelledby="{{ $navLink['name'] }}-tab"
                @class(['tab-pane fade', 'active show' => $loop->first])>
                <div class="card-body bg-body-tertiary">
                    <table class="table-hover m-0 table">
                        <tbody>
                            <tr class="border-bottom">
                                <td class="bg-transparent text-center align-middle">
                                    {{ str($navLink['field'])->ucfirst() }}
                                </td>
                                <td class="bg-transparent text-center align-middle">
                                    <a class="btn btn-sm btn-primary" data-bs-tooltip="tooltip"
                                        href="{{ route('bo.' . str($navLink['name'])->plural() . '.edit', $navLink['model']) }}"
                                        title="{{ __('crud.actions_model.show', ['model' => $navLink['translation']]) }}"
                                        target="_blank">
                                        {{ $navLink['value'] }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="border-0 bg-transparent text-center align-middle">
                                    {{ str(__('validation.attributes.updated_at'))->ucfirst() }}
                                </td>
                                <td class="border-0 bg-transparent text-center align-middle">
                                    <span class="badge rounded-pill text-bg-secondary">
                                        {{ $navLink['model']->updated_at->isoFormat('LLLL') }}
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        @endforeach
    </div>
</div>
