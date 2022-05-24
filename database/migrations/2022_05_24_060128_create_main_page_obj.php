<?php

use Illuminate\Database\Migrations\Migration;
use Src\Modules\JsonObjects\Interfaces\IFactory;
use App\Providers\AppServiceProvider;
use Illuminate\Support\Facades\DB;

class CreateMainPageObj extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /** @var IFactory */
        $factory = app(AppServiceProvider::ADMIN_MODULES)->getJsonObjectsFactory();
        $item = $factory->getDtoFactory()->getItemFactory()->createPersist(\App\Models\JsonObjects\MainPageOptions::TYPE);
        $item->load(['key' => 'main_page_options', 'name' => 'Main page options', 'disabled' => 1]);
        $attrs = $item->getInsertAttrs();

        $qb = DB::table($factory->getSetting(IFactory::OBJECTS_TABLE));
        $qb->insert($attrs);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       
    }
}
