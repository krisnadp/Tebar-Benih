<?php

namespace Modules\Slider\Http\Controllers;

use GroceryCrud\Core\GroceryCrud;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Slider\Entities\Slider;

class SliderController extends Controller
{
    private function _getDatabaseConnection() {
        $databaseConnection = config('database.default');
        $databaseConfig = config('database.connections.' . $databaseConnection);


        return [
            'adapter' => [
                'driver' => 'Pdo_Mysql',
                'database' => $databaseConfig['database'],
                'username' => $databaseConfig['username'],
                'password' => $databaseConfig['password'],
                'charset' => 'utf8'
            ]
        ];
    }

    private function _getGroceryCrudEnterprise() {
        $database = $this->_getDatabaseConnection();
        $config = config('grocerycrud');

        $crud = new GroceryCrud($config, $database);

        return $crud;
    }

    private function _show_output($output, $title = '') {
        if ($output->isJSONResponse) {
            return response($output->output, 200)
                  ->header('Content-Type', 'application/json')
                  ->header('charset', 'utf-8');
        }

        $css_files = $output->css_files;
        $js_files = $output->js_files;
        $output = $output->output;

        return view('grocery', [
            'output' => $output,
            'css_files' => $css_files,
            'js_files' => $js_files,
            'title' => $title
        ]);
    }

    public function index()
    {
        $title = "Slider Shows";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('sliders');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Slider Show', 'Slider Shows');
        $crud->columns(['title', 'description', 'updated_at']);
        $crud->fields(['title', 'description', 'image']);
        $crud->requiredFields(['title', 'description', 'image']);
        $crud->setTexteditor(['description']);
        $crud->setFieldUpload('image', 'storage', 'storage');
        $crud->callbackAfterInsert(function ($s) {
            $user = Slider::find($s->insertId);
            $user->created_at = now();
            $user->save();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Slider::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
