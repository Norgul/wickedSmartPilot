<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Http\Resources\InvoiceResource;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function fetch(Request $request)
    {
        $request->merge([
            'page' => $request->input('datatable.pagination.page', 1),
        ]);

        $queryBuilder = Invoice::with(['origin', 'destination']);

        $searchParam = $request->input('datatable.query.search');
        if ($searchParam) {
            $queryBuilder->search($searchParam);
        }

        $invoices = $queryBuilder
                        ->orderBy(
                            $request->input('datatable.sort.field', 'id'),
                            $request->input('datatable.sort.sort', 'asc')
                        )
                        ->paginate($request->input('datatable.pagination.perpage'));

        $chartData = $invoices->groupBy(function ($item, $key) {
            return $item->origin->name . ' to ' . $item->destination->name;
        })
        ->map(function ($chart) {
            $element['weight'] = $chart->sum('weight');
            $element['cost'] = $chart->sum('cost');

            $cpu = $element['cost'] / $element['weight'];

            $element['cost_per_unit'] = round($cpu, 2);

            return $element;
        });

        $chartContent = [
            'lables' => $chartData->keys()->all(),
            'series' => [
                $chartData->map(function ($item, $key) {
                    return [
                        'meta'  => $key,
                        'value' => $item['cost_per_unit'],
                    ];
                })->values()->all(),
            ],
        ];

        $resource = (InvoiceResource::collection($invoices))
                    ->additional([
                        'meta' => [
                            'page'    => $invoices->currentPage(),
                            'pages'   => $invoices->lastPage(),
                            'perpage' => $invoices->perPage(),
                        ],
                        'chart' => [
                            'content' => $chartContent,
                            'max'     => $chartData->max('cost_per_unit'),
                        ],
                    ]);

        return $resource;
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'id'     => 'required|exists:invoices',
            'status' => [
                'required',
                Rule::in(Invoice::availableStatuses()),
            ],
        ]);

        $invoice = Invoice::find($request->input('id'));

        $invoice->status = $request->input('status');
        $invoice->save();

        return new InvoiceResource($invoice);
    }
}
