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
use Barryvdh\DomPDF\Facade\Pdf as PDF;

//use PDF;

class ProjectController extends Controller
{

    public function pdfDownload()
    {
        $data = Project::all();
//        dd($data);
        $dataArray = $data->toArray();
//        return view('pdf.project',compact('data'));

        $pdf = pdf::loadView('pdf.project', ['data' => $dataArray]);
//          print_r($pdf);
//        dd($pdf);
//        return $pdf->download('TABREJ.pdf');
        return $pdf->stream();


    }
    public function index(){
        $projectTable=SpladeTable::for(Project::all())
            ->column('name')
            ->column('project_details')
            ->column('project_number')
            ->column('total_fund','Total Fund Available')
            ->column('fund_utilize')
            ->column('total_sum', 'Total Sum')
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

    public function update(Project $project, ProjectRequest $request)
    {
        $requestData = $request->all();

        // Calculate the total sum of fund_utilize for all projects
        $totalSum = Project::sum('fund_utilize');

        // Calculate the remaining funds
        $remainingFunds = $project->total_fund - $requestData['fund_utilize'];

        // Ensure remaining funds are not negative
        if ($remainingFunds < 0) {
            Toast::success('Fund utilization exceeds the total funds.');
            return redirect()->route('project.edit', ['project' => $project->id]);
        }

        // Update the project with the new data
        $project->update([
            'name' => $requestData['name'],
            'project_details' => $requestData['project_details'],
            'project_number' => $requestData['project_number'],
            'total_fund' => $remainingFunds,
            'fund_utilize' => $requestData['fund_utilize'],
        ]);

        // Update the total_sum for all projects
        Project::updateTotalSum($totalSum);

        Toast::success('Successfully update project');
        return redirect()->route('project.index');
    }



    public function delete(Project $project){
        $project->delete();
        Toast::success('successfully delete project ');
        return redirect()->route('project.index');
    }
}
