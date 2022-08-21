<?php

namespace App\Http\Controllers;

use App\Repositories\TaskRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    /**
     * @var TaskRepository
     */
    private TaskRepository $taskRepository;

    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * @param TaskRepository $taskRepository
     * @param UserRepository $userRepository
     */
    public function __construct(TaskRepository $taskRepository, UserRepository $userRepository)
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $tasks = $this->taskRepository->getPaginate(10);

        return view('task.index')->with([
            'tasks' => $tasks
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $edit = false;

        $users = $this->userRepository->getAllUser();

        $admins = $this->userRepository->getAllAdmin();

        return view('task.form')->with([
            'edit' => $edit,
            'admins' => $admins,
            'users' => $users
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'assigned_by_id' => 'required|exists:users,id',
            'assigned_to_id' => 'required|exists:users,id'
        ]);

        $this->taskRepository->store($request->all());

        return redirect()->route('task.index')
            ->withInput($request->all())
            ->withSuccess(trans('Success Created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $edit = true;

        $model = $this->taskRepository->getById($id);

        $users = $this->userRepository->getAllUser();

        $admins = $this->userRepository->getAllAdmin();

        return view('task.form')->with([
            'edit' => $edit,
            'model' => $model,
            'users' => $users,
            'admins' => $admins
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'assigned_by_id' => 'required|exists:users,id',
            'assigned_to_id' => 'required|exists:users,id'
        ]);

        $this->taskRepository->update($id, $request->all());

        return redirect()->route('task.index')
            ->withInput($request->all())
            ->withSuccess(trans('Success update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->taskRepository->destroy($id);

        return redirect()->route('task.index')->withSuccess(trans('Success Delete'));
    }
}
