<?php


namespace App\Http\Controllers;


use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::where(function ($query) use ($request) {
            if ($request->project_id) {
                $query->where('project_id', $request->project_id);
            }
        })->orderByDesc('priority')->ordered()->paginate(10);

        $projects = Project::get()->pluck('title', 'id')->toArray();

        return view('index', compact('tasks', 'projects'));
    }

    public function store(StoreTaskRequest $request)
    {
        Task::create([
            'title' => $request->title,
            'project_id' => $request->project_id
        ]);

        return back()->with('success', 'New Task Added Successfully');
    }

    public function update(UpdateTaskRequest $request)
    {
        $task = Task::FindOrFail($request->id);

        $task->update([
            'title' => $request->title,
            'priority' => $request->priority,
            'project_id' => $request->project_id
        ]);

        return back()->with('success', 'Task Updated Successfully');
    }

    public function sort(Request $request)
    {
        Task::setNewOrder($request->sortedIds);

        return response()->json([
            'status' => 'success',
            'message' => 'resorted successfully'
        ]);
    }

    public function delete(Task $task)
    {
        $task->delete();

        return back()->with('success', 'Task Successfully Deleted');
    }
}
