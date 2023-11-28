<div style="font-size: 100px; margin-top:35%; text-align: center; font-family: sans-serif">
<?php

// Скрит для поиска факториал числа после изучения функций ;)

$num = 3; //задаём число

$arr = range(1,$num);
$res = array_product($arr);

echo $res; //вывод результата
Route::get('/workers', [\App\Http\Controllers\WorkerControler::class, 'index']);

Route::get('/workers/show', [\App\Http\Controllers\WorkerControler::class, 'show']);

Route::get('/workers/create', [\App\Http\Controllers\WorkerControler::class, 'create']);

Route::get('/workers/update', [\App\Http\Controllers\WorkerControler::class, 'update']);

Route::get('/workers/delete', [\App\Http\Controllers\WorkerControler::class, 'delete']);

?></div>
public function index()
{
$workers = Worker::all();
foreach ($workers as $worker) {
dump($worker->name);
}
}

public function show()
{
$worker = Worker::find(1);
dd($worker->toArray());
}

public function create()
{
$worker = [
'name' => 'Vlad',
'surname' => 'Ivanov',
'email' => 'Vlad@mail.ru',
'age' => 30,
'description' => 'Vlad good boy',
'is_married' => false,
];

Worker::create($worker);

return "Vlad has been created";
}

public function update()
{
$worker = Worker::find(1);
$worker->update([
'name' => 'karl',
]);
}

public function delete()
{
return "this is home page";
}