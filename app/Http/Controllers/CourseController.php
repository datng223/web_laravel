<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\DestroyRequest;
use App\Http\Requests\Course\StoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Models\Course;
//use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{

    public function index()
    {
//        $search = $request->get('q');
//        $data = Course::query()
//            ->where('name', 'like', '%' . $search . '%')
//            ->paginate(2);
//        $data->appends(['q' => $search]);

//        return view('course.index', [
//            'data' => $data,
//            'search' => $search,
//        ]);
        return view('course.index');
    }

    public function api()
    {
        return DataTables::of(Course::query())
            ->editColumn('created_at', function ($object) {
                return $object->year_created_at;
            })
            ->addColumn('edit', function ($object) {
                $link = route('courses.edit', $object);

                return "<a class='btn btn-primary' href='$link'>Edit</a>";
            })
            ->rawColumns(['edit'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('course.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCourseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
//        $object = new Course();
//        $object->fill($request->validated());
//        $object->save();
        Course::create($request->validated());

        return redirect()->route('courses.index');
    }


    public function edit(Course $course)
    {
        return view('course.edit', [
            'each' => $course,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCourseRequest  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, Course $course)
    {
//        Course::where('id', $course->id)->update(
//            $request->except([
//                '_token',
//                '_method',
//            ])
//        );
//        $course->update(
//            $request->validated([
//                '_token',
//                '_method',
//            ])
//        );

        $course->fill($request->validated());
        $course->save();

        return redirect()->route('courses.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(DestroyRequest $request, $course)
    {
//        $course->delete();


         Course::destroy($course);
        // Course::where('id', $course->id)->delete();
        return redirect()->route('courses.index');
    }
}
