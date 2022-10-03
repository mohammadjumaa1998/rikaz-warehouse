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
        CRUD::setEntityNameStrings(trans('item.item'), trans('item.items'));
        if (!backpack_user()->can('mange item')) {
            CRUD::denyAccess('create');
        }
        if (!backpack_user()->can('mange item')) {
            CRUD::denyAccess('update');
        }
        if (!backpack_user()->can('mange item')) {
            CRUD::denyAccess('delete');
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
        CRUD::addColumn(['name' => 'name','label'  => trans('item.name')]);
        CRUD::addColumn(['name' => 'code','label'  => trans('item.code')]);
        CRUD::addColumn(['name' => 'min','label'  => trans('item.min')]);
        CRUD::addColumn(['name' => 'qty','label'  => trans('item.qty')]);
        CRUD::addColumn(['name' => 'price','label'  => trans('item.price')]);
        CRUD::addColumn(['name' => 'active','label' => trans('item.active')]);
        CRUD::addColumn(['name' => 'image','label'  => trans('item.image'),'type'  => 'image']);
        $this->crud->addColumn([
            'label' => trans('item.group'), // Table column heading
            'type' => "select",
            'name' => 'group_id', // the column that contains the ID of that connected entity;
            'entity' => 'group', // the method that defines the relationship in your Model
            'attribute' => "name", // foreign key attribute that is shown to user
            'model' => "App\Models\Group", // foreign key model
        ]);

        if (backpack_user()->can('change')) {
            $this->crud->addButton('line', 'change', 'view', 'crud::buttons.change');
        }
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

        CRUD::addField(['name' => 'group_id', 'label' => trans('item.group')]);
        CRUD::addField(['name' => 'name', 'label' => trans('item.name')]);
        CRUD::addField(['name' => 'code', 'label' => trans('item.code')]);
        CRUD::addField(['name' => 'min', 'label' => trans('item.min')]);
        CRUD::addField(['name' => 'qty', 'label' => trans('item.qty')]);
        CRUD::addField(['name' => 'price', 'label' => trans('item.price')]);
        CRUD::addField(['name' => 'active', 'label' => trans('item.active')]);
        CRUD::addField(['name' => 'name', 'label' => trans('item.name')]);
        $this->crud->addField([ // image
            'label' => trans('item.image'),
            'name' => "image",
            'type' => 'upload',
            'upload' => true,
            'disk' => 'uploads'
        ], 'both');




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
