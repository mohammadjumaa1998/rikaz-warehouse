<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SupplierRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SupplierCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SupplierCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Supplier::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/supplier');
        CRUD::setEntityNameStrings(trans('supplier.supplier'), trans('supplier.suppliers'));
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::addColumn(['name' => 'name','label'  => trans('supplier.name')]);
        CRUD::addColumn(['name' => 'phone','label'  => trans('supplier.phone')]);
        CRUD::addColumn(['name' => 'email','label'  => trans('supplier.email')]);
        CRUD::addColumn(['name' => 'block','label'  => trans('supplier.block')]);


    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(SupplierRequest::class);
        CRUD::addField(['name' => 'name','label'  => trans('supplier.name')]);
        CRUD::addField(['name' => 'phone','label'  => trans('supplier.phone')]);
        CRUD::addField(['name' => 'email','label'  => trans('supplier.email')]);
        CRUD::addField(['name' => 'block','label'  => trans('supplier.block')]);

    }
    protected function setupShowOperation()
    {
        CRUD::addColumn(['name' => 'name','label'  => trans('supplier.name')]);
        CRUD::addColumn(['name' => 'phone','label'  => trans('supplier.phone')]);
        CRUD::addColumn(['name' => 'email','label'  => trans('supplier.email')]);
        CRUD::addColumn(['name' => 'block','label'  => trans('supplier.block')]);


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
