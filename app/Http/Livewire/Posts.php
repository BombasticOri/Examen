<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;

class Posts extends Component{

    public $posts, $title, $body, $post_id;
    public $isOpen = false;

    public function render(){
        $this->posts = Post::all();
        return view('livewire.posts');
    }

    public function create(){
        $this->resetInputFields();
        $this->openModal();
    }

    public function openModal(){
        $this->isOpen = true;
    }

    public function closeModal(){
        $this->isOpen = false;
    }

    private function resetInputFields(){
        $this->Nombres = '';
        $this->Apellidos = '';
        $this->Sexo = '';
        $this->Direccion = '';
        $this->NumerodeCelular = '';
        $this->Fechadenacimiento = '';
        $this->Nacionalidad = '';
        $this->post_id = '';
    }

    public function store(){
        $this->validate([
            'Nombres' => 'required',
            'Apellidos' => 'required',
            'Sexo' => 'required',
            'Direccion' => 'required',
            'NumerodeCelular' => 'required',
            'Fechadenacimiento' => 'required',
            'Nacionalidad' => 'required',
        ]);
   
        Post::updateOrCreate(['id' => $this->post_id], [
            'Nombres' => $this->Nombres,
            'Apellidos' => $this->Apellidos,
            'Sexo' => $this->Sexo,
            'Direccion' => $this->Direccion,
            'NumerodeCelular' => $this->NumerodeCelular,
            'Fechadenacimiento' => $this->Fechadenacimiento,
            'Nacionalidad' => $this->Nacionalidad
        ]);
  
        session()->flash('message', 
        $this->post_id ? 'Post Updated Successfully.' : 'Post Created Successfully.');
  
        $this->closeModal();
        $this->resetInputFields();
    }

    public function edit($id){
        $post = Post::findOrFail($id);
        $this->post_id = $id;
        $this->Nombres = $post->Nombres;
        $this->Apellidos = $post->Apellidos;
        $this->Sexo = $post->Sexo;
        $this->Direccion = $post->Direccion;
        $this->NumerodeCelular = $post->NumerodeCelular;
        $this->Fechadenacimiento = $post->Fechadenacimiento;
        $this->Nacionalidad = $post->Nacionalidad;
    
        $this->openModal();
    }

    public function delete($id){
        Post::find($id)->delete();
        session()->flash('message', 'Post Deleted Successfully.');
    }

}
