<?php

namespace Modules\CaraKerja\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GroceryCrud\Core\GroceryCrud;
use Modules\CaraKerja\Entities\Way;

class CaraKerjaController extends Controller
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
        $title = "Cara Kerja";

        $crud = $this->_getGroceryCrudEnterprise();
        $crud->setTable('ways');
        $crud->setSkin('bootstrap-v4');
        $crud->setSubject('Cara Kerja', 'Cara Kerja');
        $crud->columns(['title', 'description', 'updated_at']);
        $crud->fields(['title', 'description', 'image']);
        $crud->requiredFields(['title', 'description', 'image']);
        $crud->setFieldUpload('image', 'storage', 'storage');
        $crud->setTexteditor(['description']);
        $crud->callbackAfterInsert(function ($s) {
            $user = Way::find($s->insertId);
            $user->created_at = now();
            $user->save();
            return $s;
        });
        $crud->callbackAfterUpdate(function ($s) {
            $user = Way::find($s->primaryKeyValue);
            $user->touch();
            return $s;
        });
        $output = $crud->render();

        return $this->_show_output($output, $title);
    }
}
