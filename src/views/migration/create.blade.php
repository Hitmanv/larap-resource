
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class {{ $className }} extends Migration
{
    public function up()
    {
        Schema::create('{{ $tableName }}', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('{{ $tableName }}');
    }
}

