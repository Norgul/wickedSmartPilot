<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    //region Properties
    protected $fillable = [
        'invoice_no',
        'weight',
        'cost',
        'paper_work',
        'status',
    ];

    protected $appends = [
        'cost_per_unit',
    ];
    //endregion Properties

    //region Object Methods

    //region Mutators
    //endregion Mutators

    //region Accessors
    public function getCostPerUnitAttribute()
    {
        return round($this->cost / $this->weight, 2);
    }

    //endregion Accessors

    public function priceFormatting($amount)
    {
        return '$' . str_pad($amount, 6, '0', STR_PAD_LEFT);   // TODO: Can do alot more than just prefixing currency statically.
    }

    public function statusClass()
    {
        switch ($this->status) {
            case 'approved':
                return 'success';

            case 'rejected':
                return 'danger';

            case 'under-review':
                return 'warning';

            default:
                return 'default';
        }
    }

    //endregion Object Methods

    //region Relationships

    public function origin()
    {
        return $this->belongsTo(Location::class, 'origin_id');
    }

    public function destination()
    {
        return $this->belongsTo(Location::class, 'destination_id');
    }

    //endregion Relationships

    //region Local Scopes

    public function scopeStatus($query, ...$status)
    {
        if (is_array($status[0])) {
            $statusToSearch = $status[0];
        } else {
            $statusToSearch = $status;
        }

        $query->whereIn('staus', $statusToSearch);

        return $query;
    }

    //endregion Local Scopes

    //region Static Methods
    public static function availableStatuses()
    {
        return [
            'under-review',
            'approve',
            'reject',
        ];
    }

    //endregion Static Methods
}
