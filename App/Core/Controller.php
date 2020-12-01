<?php
/**
 * 
 * Controller
 * Require [ Models , Views ]
 */
namespace Core;
class Controller
{

    /**
     * Method to require Model
     */
    // public static function model($model)
    // {
    //     $model_file = dirname(__DIR__) . '/Models/' . $model . '.php';
    //     if( ! file_exists( $model_file ) ){
    //         return false;
    //     }

    //     $models_arr = self::StroreModels();

    //     // model key is exits in StroreModels array
    //     if( ! array_key_exists( $model, $models_arr ) ){
    //         return 'model not exist';
    //     }

    //     // Reutrn new object of model
    //     return new $models_arr[$model];
    // }

    /**
     * Store Contrllers
     */
    public static function StroreModels()
    {
        return [
            'products' => \Models\products::class,
            'user' => \Models\user::class,
        ];
    }

    /**
     * Method to require Views
     */
    public function Views( $view_path, $data  )
    {
        $view_path = dirname(__DIR__) . '/Views/' . $view_path;

        if( ! file_exists( $view_path ) ) {
            return false;
        }

        require_once $view_path;
        return;
    }
}