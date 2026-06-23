<?php

namespace App\Livewire;

use App\Jobs\GoogleVisionLabelImage;
use App\Jobs\GoogleVisionSafeSearch;
use App\Jobs\RemoveFaces;
use App\Jobs\ResizeImage;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Symfony\Component\Mime\Message;

class CreateArticleForm extends Component
{
    #[Validate('required', message: 'Il titolo è obbligatorio')]
    #[Validate('min:3', message: 'Il titolo deve avere almeno 3 caratteri')]
    public $title;
    #[Validate('required', message: 'La descrizione è obbligatoria')]
    #[Validate('min:10', message: 'La descrizione deve avere almeno 10 caratteri')]
    public $description;
    #[Validate('required', message: 'Il prezzo è obbligatorio')]
    #[Validate('numeric', message: 'Il prezzo deve essere un numero')]
    public $price;
    #[Validate('required', message: 'La categoria è obbligatoria')]

    public $category = '';
    public $article;
    public $images = [];
    public $temporary_images = [];

    use WithFileUploads;

    protected function cleanForm()
    {
        $this->title = '';
        $this->description = '';
        $this->category = '';
        $this->price = '';
        $this->images = [];
    }

    public function store()
    {
        $this->validate();
        $this->article = Article::create([
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category,
            'user_id' => Auth::id()

        ]);

 
if (count($this->images) > 0) {
    foreach ($this->images as $image) {
        $newFileName = "articles/{$this->article->id}";
        $newImage = $this->article->images()->create(['path' => $image->store($newFileName, 'public')]);
        //vecchio codice
        // dispatch(new ResizeImage($newImage->path, 600, 600));
        // dispatch(new GoogleVisionSafeSearch($newImage->id));
        // dispatch(new GoogleVisionLabelImage($newImage->id));
        //nuovo codice
        RemoveFaces::withChain([
            new ResizeImage($newImage->path, 600, 600),
            new GoogleVisionSafeSearch($newImage->id),
            new GoogleVisionLabelImage($newImage->id),
        ])->dispatch($newImage->id);
    }
    File::deleteDirectory(storage_path('/app/livewire-tmp'));
}



        session()->flash('success', 'Articolo creato correttamente');
        $this->cleanForm();
    }

    public function render()
    {
        return view('livewire.create-article-form');
    }

    public function updatedTemporaryImages()
    {
        if ($this->validate([
            'temporary_images.*' => 'image|max:1024',
            'temporary_images' => 'max:6'
        ])) {
            foreach ($this->temporary_images as $image) {
                $this->images[] = $image;
            }
        }
    }

    public function removeImage($key)
    {
        if (in_array($key, array_keys($this->images))) {
            unset($this->images[$key]);
        }
    }
}
