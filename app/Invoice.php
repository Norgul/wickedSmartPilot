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

    public function paperWorkURL()
    {
        return route('paperwork.pdf', $this->paper_work);
    }

    public function statusClass()
    {
        switch ($this->status) {
            case 'approve':
            case 'approved':
                return 'success';

            case 'reject':
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

    public function scopeSearch($query, $search)
    {
        $query->where('id', 'like', '%' . $search . '%');
        $query->orWhere('weight', 'like', $search . '%');
        $query->orWhere('cost', 'like', $search . '%');
        $query->orWhere('status', 'like', $search . '%');

        $query->orWhereHas('destination', function ($innerQuery) use ($search) {
            $innerQuery->search($search);
        });

        $query->orWhereHas('origin', function ($innerQuery) use ($search) {
            $innerQuery->search($search);
        });

        return $query;
    }

    public function scopeFilter($query, $filters)
    {
        if (is_array($filters)) {
            foreach ($filters as $filter => $values) {
                $query->whereIn($filter, $values);
            }
        }

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
