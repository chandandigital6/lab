<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use Illuminate\Http\Request;
use ProtoneMedia\Splade\Facades\Toast;
use ProtoneMedia\Splade\FormBuilder\Input;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\SpladeTable;

class ProjectController extends Controller
{
    public function index(){
        $projectTable=SpladeTable::for(Project::all())
            ->column('name')
            ->column('project_details')
            ->column('project_number')
            ->column('total_fund')
            ->column('fund_utilize')
            ->column('action');

       return view('project.index',compact('projectTable'));
    }

    public function create(){
        $projectForm=SpladeForm::make()->action(route('project.store'))->method('post')->fields([
            Input::make('name')->label('Project name')->placeholder('enter project number')->required(),
            Input::make('project_details')->label('project_details')->placeholder('project_details')->required(),
            Input::make('project_number')->label('project_number')->placeholder('project_number')->required(),
            Input::make('total_fund')->label('total_fund')->placeholder('total_fund')->required(),
            Input::make('fund_utilize')->label('fund_utilize')->placeholder('fund_utilize')->required(),
            Submit::make('Create')->label('Add project'),

        ]);
        return view('project.create',compact('projectForm'));
    }
    public function store(ProjectRequest $request){
        $project=Project::create($request->all());
        Toast::success('successfully create project ');
        return redirect()->route('project.index');
    }
    public function edit($project){
        $project=Project::find($project);
        $projectForm=SpladeForm::make()->fill($project)->action(route('project.update',['project'=>$project->id]))->method('put')->fields([
            Input::make('name')->label('Project name')->placeholder('enter project number')->required(),
            Input::make('project_details')->label('project_details')->placeholder('project_details')->required(),
            Input::make('project_number')->label('project_number')->placeholder('project_number')->required(),
            Input::make('total_fund')->label('total_fund')->placeholder('total_fund')->required(),
            Input::make('fund_utilize')->label('fund_utilize')->placeholder('fund_utilize')->required(),
            Submit::make('Update')->label('Update project'),

        ]);

        return view('project.edit',compact('projectForm'));
    }
    public function update(Project $project, ProjectRequest $request){
        $project->update($request->all());
        Toast::success('successfully update project ');
        return redirect()->route('project.index');
    }

    public function delete(Project $project){
        $project->delete();
        Toast::success('successfully delete project ');
        return redirect()->route('project.index');
    }
}
