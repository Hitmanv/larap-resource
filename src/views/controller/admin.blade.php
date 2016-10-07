namespace App\Http\Controllers\Web\Admin;

use Illuminate\Http\Request;
use {{ studly_case($name) }};

class {{ studly_case(str_plural($name)) }}Controller extends Controller
{
    public function index(Request $request)
    {
        ${{ str_plural($name) }} = {{ studly_case($name) }}::paginate();

        return view('admin.resource.{{ $name }}.index', ['{{ str_plural($name) }}' => ${{ str_plural($name) }}]);
    }

    public function show(Request $request, $id)
    {
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);

        return view('admin.resource.{{ $name }}.show', ['{{ $name }}' => ${{ $name }}]);
    }

    public function create(Request $request)
    {
        return view('admin.resource.{{ $name }}.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        {{ studly_case($name) }}::create($data);

        return redirect('/{{ str_plural($name) }}');
    }

    public function edit(Request $request, $id)
    {
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);

        return view('admin.resource.{{ $name }}.edit', ['{{ $name }}' => ${{$name}}]);
    }

    public function update(Request $request, $id)
    {
        $data   = $request->all();
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);

        return redirect('/{{ str_plural($name) }}');
    }

    public function destroy(Request $request, $id)
    {
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);
        ${{ $name }}->delete();

        return redirect('/{{ str_plural($name) }}');
    }
}
