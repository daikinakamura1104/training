<?php
class Animal
{
  public function bark()
  {
    echo 'Yeah, it’s barking.' . PHP_EOL;
  }
}

class Dog extends Animal
{
  public $name;
  public $age;

  public function __construct($name, $age=1)
  {
    $this->name = $name;
    $this->age = $age;
  }
}

class MechaDog extends Dog
{
  private $data;

  public function __construct($name, $age=1)
  {
    parent::__construct($name);
    $this->data = array(
      'apache' => 'apache',
      'bsd' => 'mit',
      'chef' => 'apache'
    );
  }

  public function proc($arg)
  {
    $path = explode("/", explode(" ", $arg)[0]);
    var_dump($path);
    // eplode後の$path変数の配列の値に"GET"が入っているが、array_shiftを行うと配列の先頭の要素を削除した後の先頭の要素を取り出すので、"bsd"要素の前の要素を取り出す必要がある。
    array_shift($path);
    var_dump($path);
    // array_shift後の$path変数の配列の値がNULLになっているが、[0]=> "bsd"の配列のキーと値が保存されているべき。
    if( is_null($path) ) {
      $keys = array();
      while (list($key, $val) = each($this->data)) {
        array_push($keys, $key);
      }
      var_dump($keys);
    }
    else if(count($path) == 2){
      $this->data[$path[0]] = $path[1];
      echo $path[1] . PHP_EOL;
    }
    else {
      echo $path[0] . "=>" . $this->data[$path[0]] . PHP_EOL;
    }
  }
}

$mdog = new MechaDog('tom');
$mdog->bark();
echo $mdog->name . PHP_EOL;
echo $mdog->age . PHP_EOL;
$mdog->proc("GET /bsd HTTP/1.1");