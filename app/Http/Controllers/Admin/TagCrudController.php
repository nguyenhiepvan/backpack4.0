<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TagCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class TagCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Tag');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/tag');
        $this->crud->setEntityNameStrings('tag', 'tags');
        $this->crud->setCreateView('vendor.backpack.base.demo');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setFromDb();
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(TagRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        // $this->crud->setFromDb();
         $this->data['title'] = trans('backpack::base.dashboard'); // set the page title
         $this->data['widgets']['before_content'] = [
            [
                'type' => 'card',
                'wrapperClass' => 'col-12',
                'content' => [
                    'header' => 'Some card title',
                    'body' => '
                    <form method="POST" action="/admin/article/create">
                    <div class="form-group">
                    <lable for="name">Title:</lable>
                    <input class="form-control" name="name" id="name" type="text" placeholder="demo input">
                    </div>
                    <div class="form-group">
                    <lable for="name">Slug:</lable>
                    <input class="form-control" name="name" id="name" type="text" placeholder="demo input">
                    </div>
                    <button class="btn btn-info" type="submit">Save</button>
                    </form>
                    ',
                ]
            ],
        ];

        return view(backpack_view('demo'), $this->data);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
