<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

/**
 * @property integer                         $id         Id.
 * @property string                          $uuid       IP of the customer.
 * @property \App\Models\Game                $game_id    Game associated to the counter of visits.
 * @property-read \Illuminate\Support\Carbon $created_at Created date.
 * @property-read \Illuminate\Support\Carbon $updated_at Updated date.
 *
 * @property-read \App\Models\Game $game Get the Game that owns Visits (belongs-to relationship).
 */
class Visit extends Model
{
    use HasFactory;

    /**
     * The attributes that are fillable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'game_id',
    ];

    // * METHODS

    /**
     * Set a visit and return a uuid.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Game         $gameModel
     * @return \Symfony\Component\HttpFoundation\Cookie
     */
    public function setVisit(Request $request, Game $gameModel): \Symfony\Component\HttpFoundation\Cookie
    {
        // Check if there is an existing cookie with universally unique identifier in,
        // if not in case, create it and store it.
        $cookieUUID = (is_null($request->cookie('visit-uuid'))) ?
            Str::uuid()->toString() :
            $request->cookie('visit-uuid');
        $cookie     = cookie('visit-uuid', $cookieUUID, time() + (10 * 365 * 24 * 60 * 60));

        // Validate the request.
        $validator = Validator::make(
            ['uuid' => $cookieUUID, 'game_id' => $gameModel->getKey()],
            [
                'uuid'    => 'required|uuid|string',
                'game_id' => 'required|numeric|exists:games,id|distinct',
            ]
        );

        // Check if the visit already exist.
        $visitExist = Visit::query()->where([
            ['uuid', $validator->validated()['uuid']],
            ['game_id', $validator->validated()['game_id']]
        ])->first();

        // Add new visit.
        if (!$visitExist) {
            (new Visit())->fill($validator->validated())->saveOrFail();
        }
        return $cookie;
    }

    // * RELATIONSHIPS

    /**
     * Get the Game that owns Visits (belongs-to relationship).
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function game(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Game::class);
    }
}
