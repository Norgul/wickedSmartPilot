<?php

namespace App\Http\Resources;

use App\Invoice;
use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $response                  = parent::toArray($request);
        $response['status_class']  = $this->statusClass();
        $response['paperwork_url'] = $this->paperWorkURL();

        $options = '';

        foreach (Invoice::availableStatuses() as $status) {
            $options .= "<option value='${status}'";

            if ($status === $this->status) {
                $options .= ' selected ';
            }

            $options .= ">{$status}</option>";
        }

        $response['status_options']  = $options;

        return $response;
    }
}
