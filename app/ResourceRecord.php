<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\{Model, Builder};
use App\Http\Requests\ResourceStatusUpdateRequest as Request;

class ResourceRecord extends Model {

	/**
	 * {@inheritDoc}
	 */
	protected $fillable = ['available', 'resource_id'];

	/**
	 * {@inheritDoc}
	 */
	protected $casts = ['available' => 'boolean'];

	/**
	 * Update the availability of the last known record of a resource.
	 *
	 * @param  Request $request
	 * @return bool
	 */
	public function updateAvailability(Request $request): bool
	{
        if ($record = $this->recentRecords($request->uuid)->first()) {
        	$record->available = $request->status();
        	$record->save();
        }

        return (bool) $record;
	}

	/**
	 * Get the recent records.
	 *
	 * @param  Builder  $query
	 * @param  string            $uuid
	 * @param  int|integer       $minutes
	 * @return Builder
	 */
	public function scopeRecentRecords($query, string $uuid, int $minutes = 2) : Builder
	{
		return $query->whereResourceId($uuid)
					 ->where('created_at', '>=', Carbon::now()->subMinutes($minutes))
					 ->whereRaw('updated_at = created_at')
                     ->orderBy('created_at', 'desc');
	}

	/**
	 * Record relationship.
	 */
	public function resource()
	{
		return $this->belongsTo(Record::class);
	}
}
