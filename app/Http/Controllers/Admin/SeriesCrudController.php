<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SeriesRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SeriesCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SeriesCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Series::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/series');
        CRUD::setEntityNameStrings('series', 'series');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
         CRUD::setFromDb(); // set columns from db columns.

        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */


        CRUD::column('name')->label('Series Name');
         CRUD::column('status')->type('badge')->colors([
        'success' => 'ongoing',
        'primary' => 'completed', 
        'danger' => 'cancelled',
        'warning' => 'hiatus'
    ]);
         CRUD::column('genre')->type('badge');
         CRUD::column('start_year');
         CRUD::column('comics_count')->type('relationship_count');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SeriesRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */

        CRUD::field('name')->type('text')->label('Series Name');
    CRUD::field('slug')->type('text');
    CRUD::field('description')->type('textarea');
    CRUD::field('image_url')->type('url')->label('Cover Image');
    CRUD::field('start_year')->type('number');
    CRUD::field('end_year')->type('number');
    CRUD::field('status')->type('select_from_array')->options([
        'ongoing' => 'Ongoing',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled',
        'hiatus' => 'Hiatus'
    ]);
    CRUD::field('genre')->type('select_from_array')->options([
        'superhero' => 'Superhero',
        'action' => 'Action',
        'adventure' => 'Adventure',
        'sci-fi' => 'Sci-Fi'
    ]);
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
