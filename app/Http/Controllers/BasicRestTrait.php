<?php 

namespace App\Http\Controllers;
use Illuminate\Http\Request;

trait BasicRestTrait {
  public function basicIndex(){
    return view($this->model, [$this->model => $this->model_object::paginate()]);
  }

  public function basicEdit($request, $model, $var = []) {
    return view($this->model.'.edit', array_merge([$this->model_single=> $model], $var));
  }

  public function basicUpdate($request, $model, $validation) {
    $validatedData = $request->validate($validation);

    $model->fill($validatedData)->save();

    $request->session()->flash($this->model_single.'_edited', true);

    return redirect("/".$this->model."/".$model->id."/edit");
  }

  public function basicUpdateFlash(){
    request()->session()->flash($this->model_single.'_edited', true);
  }

  public function basicUpdateRedirect($model) {
    return redirect("/".$this->model."/".$model->id."/edit");
  }

  public function basicStore($request, $validation, $additional = null) {
    $validatedData = $request->validate($validation);

    $model = $this->model_object::create($validatedData);

    if($additional){
      $additional($model);
    }

    $request->session()->flash($this->model_single.'_added', true);

    return redirect("/".$this->model."/".$model->id."/edit");
  }

  public function basicStoreFlash(){
    request()->session()->flash($this->model_single.'_added', true);
  }

  public function basicStoreRedirect($model){
    return redirect("/".$this->model."/".$model->id."/edit");
  }

  public function basicDestroy($request, $model) {
    $model->delete();
    
    $request->session()->flash($this->model_single.'_deleted', true);

    return redirect($this->model);
  }
}
