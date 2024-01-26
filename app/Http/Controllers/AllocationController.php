<?php

namespace App\Http\Controllers;

use App\Allocation;
use App\House;
use App\Http\Requests\allocation\StoreAllocationRequest;
use App\Http\Requests\allocation\UpdateAllocationRequest;
use App\User;

class AllocationController extends Controller
{
    private $allocation;
    private $today;

    public function __construct(Allocation $allocation)
    {
        $this->allocation = $allocation;
        $this->today = strtotime(date("Y-m-d"));
    }


    public function index()
    {
        $allocations = $this->allocation->all();
        return $this->successResponse('Alocações listadas com sucesso.', $allocations);
    }

    public function store(StoreAllocationRequest $request)
    {
        $user = User::where('id', $request->user_id)->get();

        if ($user->isEmpty()) {
            return $this->errorResponse('Usuário não encontrado.');
        }

        $house = House::where('id', $request->house_id)->get();

        if ($house->isEmpty()) {
            return $this->errorResponse('Imóvel não encontrado.');
        }

        $allocation_date_request = strtotime($request->allocation_date);
        $departure_date_request = strtotime($request->departure_time);


        if ($allocation_date_request < $this->today) {
            return $this->errorResponse('A data de alocação deve ser igual ou posterior à data atual.');
        }


        if ($allocation_date_request > $departure_date_request) {
            return $this->errorResponse('A data de alocação deve ser anterior à data de término.');
        }

        $houses = $this->allocation->where('house_id', $request->house_id)->get();

        if (!$houses->isEmpty()) {
            foreach ($houses as $house) {
                $allocation_date = strtotime($house->allocation_date);
                $departure_date = strtotime($house->departure_time);

                if (
                    ($allocation_date_request >= $allocation_date && $allocation_date_request <= $departure_date) ||
                    ($departure_date_request >= $allocation_date && $departure_date_request <= $departure_date)
                ) {
                    return $this->errorResponse('O período de alocação já está reservada.');
                }
            }
        }

        $allocation = $this->allocation->create($request->all());

        return $this->successResponse('Alocação criado com sucesso', $allocation);
    }

    public function show(int $id)
    {
        $allocation = $this->allocation->with('house')->with('user')->find($id);

        if ($allocation === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }
        return $this->successResponse('Alocações listado com sucesso.', $allocation);
    }

    public function update(UpdateAllocationRequest $request, int $id)
    {
        $allocation = $this->allocation->find($id);

        if ($allocation === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        $user = User::where('id', $request->user_id)->get();

        if ($user->isEmpty()) {
            return $this->errorResponse('Usuário não encontrado.');
        }

        $house = House::where('id', $request->house_id)->get();

        if ($house->isEmpty()) {
            return $this->errorResponse('Imóvel não encontrado.');
        }

        $allocation_date_request = strtotime($request->allocation_date);
        $departure_date_request = strtotime($request->departure_time);

        if ($allocation_date_request < $this->today) {
            return $this->errorResponse('A data de alocação deve ser igual ou posterior à data atual.');
        }


        if ($allocation_date_request > $departure_date_request) {
            return $this->errorResponse('A data de alocação deve ser anterior à data de término.');
        }

        $houses = $this->allocation->where('house_id', $request->house_id)->get();

        if (!$houses->isEmpty()) {
            foreach ($houses as $house) {
                $allocation_date = strtotime($house->allocation_date);
                $departure_date = strtotime($house->departure_time);

                if (
                    ($allocation_date_request >= $allocation_date && $allocation_date_request <= $departure_date) ||
                    ($departure_date_request >= $allocation_date && $departure_date_request <= $departure_date)
                ) {
                    return $this->errorResponse('O período de alocação já está reservada.');
                }
            }
        }

        $allocation->update($request->all());

        return $this->successResponse('Alocação atualizado com sucesso', $allocation);
    }

    public function destroy( int $id)
    {
        $allocation = $this->allocation->find($id);

        if ($allocation === null) {
            return $this->errorResponse('Recurso não encontrado.');
        }

        $allocation->delete();

        return $this->successResponse('Alocação deletado com sucesso.');
    }
}
