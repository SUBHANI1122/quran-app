<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use App\Http\Resources\SurahResource;
use App\Models\Surah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SurahController extends Controller
{

    /**
     * get all surah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Surah::class)
            ->allowedIncludes(['ayahs'])
            ->allowedFilters([
                AllowedFilter::scope('by_search'),
                'name_ar',          // Ensure this matches your database column
                'revelation_type'
            ])
            ->defaultSort('number') // Sort by surah number instead of created_at
            ->allowedSorts('number', 'name_ar', 'created_at') // Sorted by surah number and name
            ->paginate($request->get('per_page', 30));

        return SurahResource::collection($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();

        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $surah = new Surah;
        $surah->name = $request->name;
        $surah->icon = $request->icon;
        $surah->save();

        return new SurahResource($surah);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $surah = Surah::with('ayahs')->findOrFail($id);
        return new SurahResource($surah);    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Surah $surah)
    {
        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $surah->name = $request->name;
        $surah->icon = $request->icon;
        $surah->save();

        return new SurahResource($surah);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Surah $surah)
    {
        $surah->delete();
        return response(['status' => 'surah deleted']);
    }
}
