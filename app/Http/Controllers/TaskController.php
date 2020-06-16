<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\TaskRequests\TaskRequest;
use App\Repositories\Eloquent\ProjectRepository;
use App\Repositories\Eloquent\TaskRepository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class TaskController extends Controller
{

    private $taskRepository;
    private $projectRepository;
    public const indexRoute = 'tasks.index';
    private $messages = [
        'add' => 'add success',
        'update' => 'update success',
        'delete' => 'delete done!'
    ];
    private $views = [
        'index_page'=>'admin.task.index',
        'create_page'=>'admin.task.create',
        'update_page'=>'admin.task.update'
    ];

    public function __construct(TaskRepository $taskRepository,ProjectRepository $projectRepository)
    {
        $this->taskRepository = $taskRepository;
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
        $tasks = $this->taskRepository->all();
        return $tasks;
//        return view($this->views['index_page'],compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     *  @return Factory|View
     */
    public function create()
    {
        //
        $projects = $this->projectRepository->all();
        return $projects;
//        return view($this->views['create_page'],compact('projects'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param TaskRequest $request
     * @return RedirectResponse|Redirector
     */
    public function store(TaskRequest $request)
    {
        //
        $validated = $request->validated();
        $this->taskRepository->create($validated);
        $tasks = $this->taskRepository->all();
        return $tasks;
//        return  redirect(route(self::indexRoute))->with('message',$this->messages['add']);
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
        //
        $projects = $this->projectRepository->all();
        $task= $this->taskRepository->show($id);
        return ['task'=>$task,'projects'=>$projects];
//        return view($this->views['update_page'],compact(['task','projects']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaskRequest $request
     * @param  int  $id
     * @return Application|RedirectResponse|Redirector
     */
    public function update(TaskRequest $request, $id)
    {
        //
        $validated = $request->validated();
        $this->taskRepository->update($validated,$id);
        $tasks = $this->taskRepository->all();
        return $tasks;
//        return  redirect(route(self::indexRoute))->with('message',$this->messages['update']);
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
        $this->taskRepository->delete($id);
        $tasks = $this->taskRepository->all();
        return $tasks;
//        return redirect(route(self::indexRoute))->with('message', $this->messages['delete']);
    }

}
