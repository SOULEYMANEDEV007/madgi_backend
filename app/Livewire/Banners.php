<?php

namespace App\Livewire;

use App\Models\Banner;
use App\Models\Media;
use Livewire\Component;
use Livewire\WithFileUploads;
use Flash;

use function Laravel\Prompts\alert;

class Banners extends Component
{
    use WithFileUploads;

    public $photo1;
    public $photo2;
    public $photo3;

    public function save()
    {
        if($this->photo1 != null) {
            $this->validate(['photo1' => 'image|mimes:jpeg,png,jpg|max:5120'/*|dimensions:min_height=500,max_height=500'*/], [
                'photo1.mimes' => 'L\'image 1 doit-être de type jpeg/png/jpg',
                'photo1.dimensions' => 'La hauteur de l\'image 1 doit-être de 500px'
            ]);
            $profileImage = date("YmdHis1") . "." . $this->photo1->getClientOriginalExtension();
            Media::updateOrCreate(['source' => Media::SLIDE . 1],
            [
                'src' => "/bannieres/$profileImage",
                'source_id' => 1,
                'source' => Media::SLIDE . 1
            ]);
            $this->photo1->storePubliclyAs('bannieres', $profileImage, 'local');
        }
        if($this->photo2 != null) {
            $this->validate(['photo2' => 'image|mimes:jpeg,png,jpg|max:5120'/*|dimensions:min_height=500,max_height=500'*/], [
                'photo2.mimes' => 'L\'image 2 doit-être de type jpeg/png/jpg',
                'photo2.dimensions' => 'La hauteur de l\'image 2 doit-être de 500px'
            ]);
            $profileImage = date("YmdHis2") . "." . $this->photo2->getClientOriginalExtension();
            Media::updateOrCreate(['source' => Media::SLIDE . 2],
            [
                'src' => "/bannieres/$profileImage",
                'source_id' => 2,
                'source' => Media::SLIDE . 2
            ]);
            $this->photo2->storePubliclyAs('bannieres', $profileImage, 'local');
        }
        if($this->photo3 != null) {
            $this->validate(['photo3' => 'image|mimes:jpeg,png,jpg|max:5120'/*|dimensions:min_height=500,max_height=500'*/], [
                'photo3.mimes' => 'L\'image 3 doit-être de type jpeg/png/jpg',
                'photo3.dimensions' => 'La hauteur de l\'image 3 doit-être de 500px'
            ]);
            $profileImage = date("YmdHis3") . "." . $this->photo3->getClientOriginalExtension();
            Media::updateOrCreate(['source' => Media::SLIDE . 3],
            [
                'src' => "/bannieres/$profileImage",
                'source_id' => 3,
                'source' => Media::SLIDE . 3
            ]);
            $this->photo3->storePubliclyAs('bannieres', $profileImage, 'local');
        }

        session()->flash('message', 'Bannière modifié avec succès.');
    }

    public function render()
    {
        return view('livewire.banners', [
            'slide1' => $this->slide1,
            'slide2' => $this->slide2,
            'slide3' => $this->slide3,
        ])
        ->layout('layouts.app');
    }

    public function getSlide1Property()
    {
        return Media::where('source', Media::SLIDE.'1')->first();
    }

    public function getSlide2Property()
    {
        return Media::where('source', Media::SLIDE.'2')->first();
    }

    public function getSlide3Property()
    {
        return Media::where('source', Media::SLIDE.'3')->first();
    }
}