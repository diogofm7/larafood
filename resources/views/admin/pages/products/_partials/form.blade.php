@include('admin.includes.alerts')

@csrf

<div class="form-group">
    <label>* Titulo:</label>
    <input type="text" name="title" class="form-control" placeholder="Titulo:" value="{{ $product->title??old('title') }}">
</div>

<div class="form-group">
    <label>* Preço:</label>
    <input type="text" name="price" class="form-control" placeholder="Preço:" value="{{ $product->price??old('price') }}">
</div>

<div class="form-group">
    <label>* Imagem:</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label>* Descrição:</label>
    <textarea name="description" cols="30" rows="5" class="form-control" placeholder="Descrição">{{ $product->description??old('description') }}</textarea>
</div>

<div class="form-group">
    <button type="submit" class="btn btn-dark">Enviar</button>
</div>
