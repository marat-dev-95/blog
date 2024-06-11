<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PostRequest;
use App\Models\User;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class PostCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class PostCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *./vendor/bin/sail php artisan migrate --path=vendor/spatie/laravel-permission/database/migrations

     * @return void
     */
    public function setup()
    {
        if(backpack_user()->role == User::ROLE_MODERATOR) {
            $this->crud->denyAccess('delete');
            $this->crud->denyAccess('create');
        }
        CRUD::setModel(\App\Models\Post::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/post');
        CRUD::setEntityNameStrings('post', 'posts');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('preview')->type('image')->prefix('storage/');
        CRUD::setFromDb(); // set columns from db columns.
        CRUD::removeColumn("body");

        CRUD::column('categories')->type('select_multiple')->label('Categories');

      //  CRUD::field('preview')->type("text")
        /**
         * Columns can be defined using the fluent syntax:
         * - CRUD::column('price')->type('number');
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(PostRequest::class);
        CRUD::setFromDb(); // set fields from db columns.
        CRUD::field("preview")->type('upload')->prefix("storage")
            ->withFiles([
                'disk' => 'public', // the disk where file will be stored
                'path' => 'uploads', // the path inside the disk where file will be stored
            ]);
       // CRUD::removeColumn("body");
        CRUD::field('body')->type('summernote');
        CRUD::field('categories')->type('select_multiple')->label('Categories');
        /**
         * Fields can be defined using the fluent syntax:
         * - CRUD::field('price')->type('number');
         */
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

    public function setupShowOperation()
    {
        // using the array syntax
        CRUD::setFromDb();
        CRUD::column('categories')->type('select_multiple')->label('Categories');
        CRUD::column('preview')->type('image')->prefix('storage/');
        CRUD::column('body')->type('summernote');
        // or using the fluent syntax

    }
}
