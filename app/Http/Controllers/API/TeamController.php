<?php

namespace App\Http\Controllers\API;

use App\Interfaces\Repositories\TeamRepositoryInterface;
use App\Repositories\TeamRepository;

use App\Models\Team;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TeamController extends Controller
{
    /** @var TeamRepository */
    protected $teamRepository;

    /**
     * PlayerController constructor
     *
     * @param TeamRepositoryInterface $teamRepository
     * */
    public function __construct(TeamRepositoryInterface $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->teamRepository->all();
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
            $this->teamRepository->crudRules()
        );

        $team = $this->teamRepository->create($data);
        return $team;
    }

    /**
     * Display the specified resource.
     *
     * @param  Team $team
     * @return Response
     */
    public function show(Team $team)
    {
        $team->load('players');
        return $team;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Team $team
     * @return Response
     */
    public function update(Team $team, Request $request)
    {
        $data = $request->validate(
            $this->teamRepository->crudRules($team->getKey())
        );
        $team->update($data);

        $team->load('players');
        return $team;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Team $team
     * @return Response
     */
    public function destroy(Team $team)
    {
        $team->delete();
        return ['success' => true];
    }
}
