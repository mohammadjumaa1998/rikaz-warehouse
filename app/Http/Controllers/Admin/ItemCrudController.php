<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ItemRequest;
use App\Models\Item;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ItemCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ItemCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Item::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/item');
        CRUD::setEntityNameStrings('item', 'items');
        if (!backpack_user()->can('mange item')) {
            CRUD::denyAccess('create');
        }
        if (!backpack_user()->can('mange item')) {
            CRUD::denyAccess('update');
        }
        if (!backpack_user()->can('mange item')) {
            CRUD::denyAccess('delete');
        }

        if (!backpack_user()->can('change')) {
            CRUD::denyAccess('change');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *  
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name');
        CRUD::column('code');
        CRUD::column('min');
        CRUD::column('qty');
        CRUD::column('active');
        CRUD::column('image')->type('image');
        $this->crud->addColumn([
            'label' => "Group", // Table column heading
            'type' => "select",
            'name' => 'group_id', // the column that contains the ID of that connected entity;
            'entity' => 'group', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Group", // foreign key model
        ]);

        //  $this->crud->removeButton('change');
        // $this->crud->addButton('line', 'change', 'view', 'crud::buttons.change', 'end');
        // CRUD::button('change')->view('crud::buttons.change');
        //  if (backpack_user()->can('change')) {
        //     $this->crud->addButton('line', 'change',  'view', 'vendor.backpack.crud.buttons.change', 'end');
        // }
        $this->crud->addButton('line', 'change', 'view', 'crud::buttons.change');
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {

        CRUD::setValidation(ItemRequest::class);

        CRUD::field('name');
        CRUD::field('code');
        CRUD::field('min');
        CRUD::field('qty');
        CRUD::field('active');
        $this->crud->addField([ // image
            'label' => "Image",
            'name' => "image",
            'type' => 'upload',
            'upload' => true,
            'disk' => 'uploads'
        ], 'both');
        // CRUD::field('image')->type('upload');
        CRUD::field('group_id');



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
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

    public function change($id)
    {


        // get entry ID from Request (makes sure its the last ID for nested resources)
        $id = $this->crud->getCurrentEntryId() ?? $id;

        $item = $this->crud->getModel()->findOrFail($id);

        $item->update([
            'active' => !$item->active
        ]);
        \Alert::success(trans('backpack::crud.update_success'))->flash();

        return back();
    }
}
