<?php

namespace App\Http\Controllers\API;

use App\Interfaces\Repositories\PlayerRepositoryInterface;
use App\Repositories\PlayerRepository;
use App\Models\Player;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PlayerController extends Controller
{
    /** @var PlayerRepository */
    protected $playerRepository;

    /**
     * PlayerController constructor
     *
     * @param PlayerRepositoryInterface $playerRepository
     * */
    public function __construct(PlayerRepositoryInterface $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->playerRepository->with('team')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->playerRepository->crudRules()
        );

        $player = $this->playerRepository->create($data);
        return $player;
    }

    /**
     * Display the specified resource.
     *
     * @param  Player $player
     * @return Response
     */
    public function show(Player $player)
    {
        $player->load('team');
        return $player;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Player $player
     * @param  Request $request
     * @return Response
     */
    public function update(Player $player, Request $request)
    {
        $data = $request->validate(
            $this->playerRepository->crudRules()
        );
        $player->update($data);

        $player->load('team');
        return $player;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Player $player
     * @return Response
     */
    public function destroy(Player $player)
    {
        $player->delete();
        return ['success' => true];
    }
}
