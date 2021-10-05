<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddSubjectRequest;
use App\Http\Requests\FilterSubjectRequest;
use App\Models\Subject;
use Illuminate\Http\Request;
use PDF;

class SubjectController extends Controller
{
    private $success_code = 200;
    /**
     * Display a listing page for the subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('subject.index');
    }

    /**
     * Displays subjects information on datatable
     *
     * @param FilterSubjectRequest $request
     * @return void
     */
    public function getSubjectList(FilterSubjectRequest $request)
    {

        $totalData = Subject::count();

        $totalFiltered = $totalData;

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $request->getOrderColumn();
        $dir = $request->getDir();
        $searchValue = $request->input('search.value');

        if (empty($searchValue)) {
            $subjects = Subject::offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();
        } else {
            $search = $searchValue;

            $subjects = Subject::where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
                ->offset($start)
                ->limit($limit)
                ->orderBy($order, $dir)
                ->get();

            $totalFiltered = Subject::where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('name', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%");
            })
                ->count();
        }

        $data = array();

        if (!empty($subjects)) {

            foreach ($subjects as $key => $subject) {
                $nestedData['id'] = $key + $start + 1;
                $nestedData['title'] = ucfirst($subject->title);
                $nestedData['name'] = ucfirst($subject->name);
                $nestedData['description'] = $subject->description;
                $nestedData['options'] = $subject->id;
                $data[] = $nestedData;
            }
        }

        $json_data = array(
            "draw" => intval($request->input('draw')),
            "recordsTotal" => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data" => $data,
        );
        return response()->json($json_data, 200);
    }

    /**
     * Store a newly created subject.
     *
     * @param  AddSubjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddSubjectRequest $request)
    {
        Subject::create($request->getData());
        return response()->json([
            'success' => true,
            'message' => __('response.subject.add_success'),
        ], $this->success_code);
    }

    /**
     * Remove the specified subject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::whereId($id)->delete();
        return response()->json([
            'success' => true,
            'message' => __('response.subject.delete_sucess'),
        ], $this->success_code);
    }

    public function generatePDF()
    {
        $data = [
            'title' => 'Subject List PDF - ' . date('m/d/Y'),
            'subjects' => Subject::all(),
        ];

        $pdf = PDF::loadView('pdf.subjects', $data);

        return $pdf->download('subjects.pdf');
    }
}
