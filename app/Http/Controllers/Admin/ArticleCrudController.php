<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArticleRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

use DateTime;
/**
 * Class ArticleCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class ArticleCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Article');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/article');
        $this->crud->setEntityNameStrings('article', 'articles');
        // $this->crud->setCreateView('vendor.backpack.base.demo');
    }

    protected function setupListOperation()
    {
        // TODO: remove setFromDb() and manually define Columns, maybe Filters
        $this->crud->setColumns(['title','slug']);
    }

    protected function setupCreateOperation()
    {
        // $this->crud->setValidation(ArticleRequest::class);

        // TODO: remove setFromDb() and manually define Fields
        $this->crud->addField([
            'name' => 'title',
            'type' => 'text',
            'label' => "Title"
        ]);
        $this->crud->addField([   // Browse
            'name' => 'thumbnail',
            'label' => 'Thumbnail',
            'type' => 'browse'
        ]);
        $this->crud->addField([   // CKEditor
            'name' => 'content',
            'label' => 'Content',
            'type' => 'ckeditor',
    // optional:
    // 'extra_plugins' => ['oembed', 'widget'],
            'options' => [
                'autoGrow_minHeight' => 200,
                'autoGrow_bottomSpace' => 50,
                'removePlugins' => 'resize,maximize',
            ]
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    public function store(ArticleRequest $request)
    {
    // dd($this->slugify($request->title));
        $this->crud->hasAccessOrFail('create');
        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        $data = $request->except(['_token','http_referrer','save_action']);
        $data['slug'] = $this->slugify($data['title']);
        // insert item in the db
        $item = $this->crud->create($data);
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.insert_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

    public function update(ArticleRequest $request)
    {
        $this->crud->hasAccessOrFail('update');

        // execute the FormRequest authorization and validation, if one is required
        $request = $this->crud->validateRequest();
        $alticle = $this->crud->getEntry($request->id);
        $data = $request->except(['_token','http_referrer','save_action']);

        if($data['title'] != $alticle->title){
            $data['slug'] = $this->slugify($data['title']);
        }
        // update the row in the db
        $item = $this->crud->update($request->get($this->crud->model->getKeyName()),
            $data);
        $this->data['entry'] = $this->crud->entry = $item;

        // show a success message
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        // save the redirect choice for next time
        $this->crud->setSaveAction();

        return $this->crud->performSaveAction($item->getKey());
    }

     //Hàm này dùng để tạo ra slug
    public function slugify($text)
    {
  // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

  // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
      $text = trim($text, '-');

  // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

  // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
    }
    $date = new DateTime();
    return $text .'-'.$date->getTimestamp();
}
}
