<?php

/**
 * Model Class
 */
class Model
{

    /**
     * Array of attributes
     *
     * @var array
     */
    public $attributes;

    /**
     * Array of configs
     *
     * @var array
     */
    protected $config = [];

    /**
     * Primary key for identification
     *
     * @var string
     */
    private $primaryKey = 'id';


    /**
     * Initializing Model
     *
     * @param array $attributes = []
     */
    function __construct ($attributes = []) {
        $this->attributes = $attributes;
    }

    /**
     * Statically create
     *
     * @param array $attributes = []
     * @return void
     */

    public static function create ($attributes = []) {
        $item = new (get_called_class())($attributes);
        $item->save();
        return $item;
    }

    public function save($attributes = []) {

        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }

        $this->saveItemToFile();
    }

    public function delete() {

        $this->deleteItemToFile();
    }

    public function saveItemToFile () {

        // decode the data
        $json = json_decode(file_get_contents('./data/data.json'), true);
        $list = @$json[$this->config['data_column']];

        // check if saved
        $saved = false;

        if ($list == null) {
            $list = [];
        }

        // save the Data
        $list = array_map(function ($item) use (&$saved) {
            if ($item->{ $this->primaryKey } == $this->attributes[ $this->primaryKey ]) {
                $item = $this->attributes;
                $saved = true;
            }
            return $item;
        }, $list);

        // if record doesn't exist, add it
        if (!$saved) {
            $list[] = $this->attributes;
        }

        // encode and write to the file
        $json->{$this->config['data_column']} = $list;
        file_put_contents('./data/data.json', json_encode($json));

        return $this;
    }

    public static function all () {

        $obj = new (get_called_class())();

        // decode the data
        $json = json_decode(file_get_contents('./data/data.json'), true);
        $list = @$json[($obj->config['data_column'])];

        if ($list == null) {
            $list = [];
        }

        // save the Data
        $list = array_map(function ($item) {
            return new (get_called_class())($item);
        }, $list);

        return $list;
    }

    public function deleteItemToFile () {

        // decode the data
        $json = json_decode(file_get_contents('./data/data.json'), true);
        $list = @$json[$this->config['data_column']];

        if ($list == null) {
            $list = [];
        }

        // save the data
        $list = array_filter($list, function ($item) {
            if ($item[$this->primaryKey] == $this->attributes[$this->primaryKey]) {
                return false;
            }
            return true;
        });


        // encode and write to the file
        $json[$this->config['data_column']] = $list;
        file_put_contents('./data/data.json', json_encode($json));

        return $this;
    }

    public function __get($name)
    {
        if (@$this->{$name} == null) {
            return @$this->attributes[$name];
        }

        return $this->{$name};
    }


}
