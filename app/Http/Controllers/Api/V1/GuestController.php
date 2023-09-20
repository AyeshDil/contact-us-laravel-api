<?php

namespace App\Http\Controllers\Api\V1;

use App\Filters\V1\GuestFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGuestRequest;
use App\Http\Requests\UpdateGuestRequest;
use App\Http\Resources\V1\GuestCollection;
use App\Http\Resources\V1\GuestResource;
use App\Models\Guest;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = new GuestFilter();
        $filteredGuests = $filter->transform($request);
        $includeMessages = $request->query('includeMessages');

        $guests =Guest::where($filteredGuests);

        // dd($request->query('includeMessages'));
        if($includeMessages){
            $guests = $guests->with('messages');
        }

        return new GuestCollection($guests->paginate()->appends($request->query()));
        
        // if(isset($filteredGuests)){
        //     return new GuestCollection(Guest::where($filteredGuests)->paginate());
        // }
        // return new GuestCollection(Guest::paginate());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGuestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Guest $guest)
    {
        $includeMessages = request()->query('includeMessages');
        if ($includeMessages){
            return new GuestResource($guest->loadMissing('messages'));
        }
        return new GuestResource($guest);
        dd($guest);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Guest $guest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGuestRequest $request, Guest $guest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Guest $guest)
    {
        //
    }
}
