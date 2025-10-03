<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ComicRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ComicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ComicCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Comic::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/comic');
        CRUD::setEntityNameStrings('comic', 'comics');
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

         CRUD::column('title');
         CRUD::column('series')->type('relationship');
         CRUD::column('issue_number')->label('Issue #');
         CRUD::column('status')->type('badge');
         CRUD::column('release_date')->type('date');
         CRUD::column('is_featured')->type('boolean');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ComicRequest::class);
        CRUD::setFromDb(); // set fields from db columns.

        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */

        CRUD::field('series_id')->type('select2')->entity('series')
        ->model('App\Models\Series')->attribute('name');
        CRUD::field('title')->type('text');
        CRUD::field('slug')->type('text');
        CRUD::field('description')->type('textarea');
        CRUD::field('cover_image')->type('url');
        CRUD::field('issue_number')->type('number');
        CRUD::field('release_date')->type('date');
        CRUD::field('writer')->type('text');
        CRUD::field('artist')->type('text');
        CRUD::field('status')->type('select_from_array')->options([
        'published' => 'Published',
        'upcoming' => 'Upcoming', 
        'draft' => 'Draft'
    ]);
    CRUD::field('is_featured')->type('boolean');
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
