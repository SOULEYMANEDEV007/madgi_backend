<div>
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1>Ajouter des bannières</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        
        <div class="card">
            <div class="card-body">
                <div x-cloak x-data="{ number: [0, 1, 2] }" class="mt-3">
                    <div class="row">
                        <div class="col-md-2">
                            @if (!empty($slide1))
                                <div class="text-center mx-1">
                                    <label for="dropzone-file" class="dropzone-file">
                                        <img @if($photo1 != null) src="{{ $photo1->temporaryUrl() }}" @else src="{{ env('APP_URL') . $slide1->src }}" @endif class="image-preview" @if($photo1 != null || $slide1 != null) width="100" height="100" @endif>
                                        @if($slide1 == null)
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                        @endif
                                        <p class="mt-4 mb-2 text-sm">
                                            <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                            <span class="font-semibold">ou glisser-déposer</span>
                                        </p>
                                        <small>PNG, JPG ou JPEG (MAX. 2MB)</small>
                                        <input wire:model="photo1" id="dropzone-file" type="file" class="custom-file-input" />
                                    </label>
                                </div>
                            @else
                                <div class="text-center mx-1">
                                    <label for="dropzone-file" class="dropzone-file">
                                        <img @if($photo1 != null) src="{{ $photo1->temporaryUrl() }}" @else src="" @endif class="image-preview" @if($photo1 != null || $slide1 != null) width="100" height="100" @endif>
                                        @if($photo1 == null)
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                        @endif
                                        <p class="mt-4 mb-2 text-sm">
                                            <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                            <span class="font-semibold">ou glisser-déposer</span>
                                        </p>
                                        <small>PNG, JPG ou JPEG (MAX. 2MB)</small>
                                        <input wire:model="photo1" id="dropzone-file" type="file" class="custom-file-input" />
                                    </label>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-2">
                            @if (!empty($slide2))
                                <div class="text-center mx-1">
                                    <label for="dropzone-file" class="dropzone-file">
                                        <img @if($photo2 != null) src="{{ $photo2->temporaryUrl() }}" @else src="{{ env('APP_URL') . $slide2->src }}" @endif class="image-preview" @if($photo2 != null || $slide2 != null) width="100" height="100" @endif>
                                        @if($slide2 == null)
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                        @endif
                                        <p class="mt-4 mb-2 text-sm">
                                            <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                            <span class="font-semibold">ou glisser-déposer</span>
                                        </p>
                                        <small>PNG, JPG ou JPEG (MAX. 2MB)</small>
                                        <input wire:model="photo2" id="dropzone-file" type="file" class="custom-file-input" />
                                    </label>
                                </div>
                            @else
                                <div class="text-center mx-1">
                                    <label for="dropzone-file" class="dropzone-file">
                                        <img @if($photo2 != null) src="{{ $photo2->temporaryUrl() }}" @else src="" @endif class="image-preview" @if($photo2 != null || $slide2 != null) width="100" height="100" @endif>
                                        @if($photo2 == null)
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                        @endif
                                        <p class="mt-4 mb-2 text-sm">
                                            <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                            <span class="font-semibold">ou glisser-déposer</span>
                                        </p>
                                        <small>PNG, JPG ou JPEG (MAX. 2MB)</small>
                                        <input wire:model="photo2" id="dropzone-file" type="file" class="custom-file-input" />
                                    </label>
                                </div>
                            @endif
                        </div>

                        <div class="col-md-2">
                            @if (!empty($slide3))
                                <div class="text-center mx-1">
                                    <label for="dropzone-file" class="dropzone-file">
                                        <img @if($photo3 != null) src="{{ $photo3->temporaryUrl() }}" @else src="{{ env('APP_URL') . $slide3->src }}" @endif class="image-preview" @if($photo3 != null || $slide3 != null) width="100" height="100" @endif>
                                        @if($slide3 == null)
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                        @endif
                                        <p class="mt-4 mb-2 text-sm">
                                            <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                            <span class="font-semibold">ou glisser-déposer</span>
                                        </p>
                                        <small>PNG, JPG ou JPEG (MAX. 2MB)</small>
                                        <input wire:model="photo3" id="dropzone-file" type="file" class="custom-file-input" />
                                    </label>
                                </div>
                            @else
                                <div class="text-center mx-1">
                                    <label for="dropzone-file" class="dropzone-file">
                                        <img @if($photo3 != null) src="{{ $photo3->temporaryUrl() }}" @else src="" @endif class="image-preview" @if($photo3 != null || $slide3 != null) width="100" height="100" @endif>
                                        @if($photo3 == null)
                                            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16" style="width: 100px; height: 100px;">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                            </svg>
                                        @endif
                                        <p class="mt-4 mb-2 text-sm">
                                            <span class="font-semibold">Cliquez pour télécharger</span> <br>
                                            <span class="font-semibold">ou glisser-déposer</span>
                                        </p>
                                        <small>PNG, JPG ou JPEG (MAX. 2MB)</small>
                                        <input wire:model="photo3" id="dropzone-file" type="file" class="custom-file-input" />
                                    </label>
                                </div>
                            @endif
                        </div>
                    </div>
                    @error('photo1') <span class="error text-danger">{{ $message }}</span> @enderror
                    @error('photo2') <span class="error text-danger">{{ $message }}</span> @enderror
                    @error('photo3') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="card-footer">
                @can(\App\Models\Permission::BANNER['CREATE'])
                    <div class="d-block">
                        <button wire:click="save" type="button" class="btn btn-primary btn-sm">Enregistrer</button>
                    </div>
                @endcan
            </div>
        </div>
    </div>
</div>