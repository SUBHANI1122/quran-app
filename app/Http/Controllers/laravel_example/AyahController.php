<?php

namespace App\Http\Controllers\laravel_example;

use App\Http\Controllers\Controller;
use App\Http\Resources\ScheduleResource;
use App\Http\Resources\AyahResource;
use App\Models\Ayah;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class AyahController extends Controller
{

    /**
     * get all ayah.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = QueryBuilder::for(Ayah::class)
            ->allowedFilters([
                AllowedFilter::scope('by_search'),
                'surah_number', 
                'juz',         
                'hizb_quarter'
            ])
            ->defaultSort('ayah_number') 
            ->allowedSorts('ayah_number') 
            ->allowedIncludes(['surah'])
            ->paginate($request->get('per_page', 30));
    
        return AyahResource::collection($data);
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

        $ayah = new Ayah;
        $ayah->name = $request->name;
        $ayah->icon = $request->icon;
        $ayah->save();
        
        return new AyahResource($ayah);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ayah $ayah)
    {
        return new AyahResource($ayah);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ayah $ayah)
    {
        $this->validate($request, [
            'name'  => 'required',
            'icon'  => 'required',
        ]);

        $ayah->name = $request->name;
        $ayah->icon = $request->icon;
        $ayah->save();
        
        return new AyahResource($ayah);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ayah $ayah)
    {
        $ayah->delete();
        return response(['status' => 'ayah deleted']);
    }

}