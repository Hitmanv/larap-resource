namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use {{ studly_case($name) }};

class {{ studly_case(str_plural($name)) }}Controller extends Controller
{
    public function index(Request $request)
    {
        ${{ str_plural($name) }} = {{ studly_case($name) }}::paginate();

        return response()->json(${{ str_plural($name) }});
    }

    public function show(Request $request, $id)
    {
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);

        return response()->json(${{ $name }});
    }

    public function store(Request $request)
    {
        $data    = $request->all();
        ${{ $name }} = {{ studly_case($name) }}::create($data);

        return response()->json(${{ $name }});
    }

    public function update(Request $request, $id)
    {
        $data    = $request->all();
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);

        return response()->json(${{ $name }});
    }

    public function destroy(Request $request, $id)
    {
        ${{ $name }} = {{ studly_case($name) }}::findOrFail($id);
        ${{ $name }}->delete();

        return response()->json(true);
    }
}
