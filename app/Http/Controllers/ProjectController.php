<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequests\ProjectRequest;
use App\Repositories\Eloquent\ProjectRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class ProjectController extends Controller
{

    private $projectRepository;
    public const indexRoute = 'projects.index';
    private $messages = [
        'add' => 'add success',
        'update' => 'update success',
        'delete' => 'delete done!'
    ];
    private $views = [
        'index_page'=>'admin.project.index',
        'create_page'=>'admin.project.create',
        'update_page'=>'admin.project.update'
    ];

    public function __construct(ProjectRepository $projectRepository)
    {
        $this->projectRepository = $projectRepository;
    }
    /**
     * Display a listing of the resource.
     *
     *  @return Factory|View
     */
    public function index()
    {
        //
        $projects = $this->projectRepository->all();
        return $projects;
//        return view($this->views['index_page'],compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *  @return Factory|View
     */
    public function create()
    {
        return view($this->views['create_page']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProjectRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(ProjectRequest $request)
    {
        //
        $validated = $request->validated();
        $this->projectRepository->create($validated);
        $projects = $this->projectRepository->all();
        return $projects;
      //  return  redirect(route(self::indexRoute))->with('message',$this->messages['add']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {

        $project= $this->projectRepository->show($id);
        return $project;
//        return view($this->views['update_page'],compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(ProjectRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $this->projectRepository->update($validated,$id);
        $projects = $this->projectRepository->all();
        return $projects;
     //   return  redirect(route(self::indexRoute))->with('message',$this->messages['update']);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        //
        $this->projectRepository->delete($id);
        $projects = $this->projectRepository->all();
        return $projects;
      //  return redirect(route(self::indexRoute))->with('message', $this->messages['delete']);
    }

}
