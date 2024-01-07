<?PHP 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRcrTable extends Migration
{
    public function up()
    {
        Schema::create('rcrs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('need_id');
            $table->string('title');
            $table->text('description');
            $table->unsignedBigInteger('status_id');
            $table->text('result');
            $table->integer('cost');
            $table->timestamps();

            // Define foreign key constraints
            $table->foreign('need_id')->references('id')->on('needs');
            $table->foreign('status_id')->references('id')->on('need_statuses');
        });
    }

    public function down()
    {
        Schema::dropIfExists('rcrs');
    }
}
