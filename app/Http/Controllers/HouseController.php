<?php

namespace App\Http\Controllers;

use App\House;
use App\Http\Requests\house\StoreHouseRequest;
use App\Http\Requests\house\UpdateHouseRequest;
use Illuminate\Support\Facades\Storage;

class HouseController extends Controller
{
    private $house;

    public function __construct(House $house)
    {
        $this->house = $house;
    }

    public function index()
    {
        $houses = $this->house->all();
        return $this->successResponse('Imóveis listados com sucesso.', $houses);
    }

    public function store(StoreHouseRequest $request)
    {

        $house = $this->house->create(
            array_replace(
                $request->all(),
                [
                    'main_image' => $request->hasFile('main_image') ?
                        $request->file('main_image')->store('images/houses/', 'public') :
                        null
                ]
            )
        );

        return $this->successResponse('Imóvel criado com sucesso.', $house);
    }

    public function show(int $id)
    {
        $house = $this->house->with('user')->find($id);

        if ($house === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        return $this->successResponse('Imóvel listado com sucesso.', $house);
    }

    public function update(UpdateHouseRequest $request, int $id)
    {
        $house = $this->house->find($id);

        if ($house === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        if ($request->hasFile('main_image')) {
            Storage::disk('public')->delete($house->main_image);
        }

        $house->update(array_replace($request->all(), [
            'main_image' => $request->hasFile('main_image') ?
                $request->file('main_image')->store('images/houses/', 'public') :
                $house->main_image
        ]));

        return $this->successResponse('Imóvel atualizado com sucesso.', $house);
    }

    public function destroy(int $id)
    {
        $house = $this->house->find($id);

        if ($house === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        $house->delete();

        return $this->successResponse('Imóvel deletado com sucesso.');
    }
}
