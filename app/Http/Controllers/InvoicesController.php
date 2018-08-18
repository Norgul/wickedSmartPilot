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

        $resource = (InvoiceResource::collection($invoices))
                    ->additional([
                        'meta' => [
                            'page'    => $invoices->currentPage(),
                            'pages'   => $invoices->lastPage(),
                            'perpage' => $invoices->perPage(),
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
