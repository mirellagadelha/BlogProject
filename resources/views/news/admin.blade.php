@extends('layouts.app')
@section('content')
<body class="theme admin-page">
	<header class="header-blog" style="background-image: url('/images/header.png');">
		<div class="container">
	    	<div class="d-flex header-nav">
	            <a class="nav-icon-logo" href="/news"><i class="icon ion-md-list"></i></a>
	            <ul class="nav">
	              	<li class="nav-item active"><a class="nav-link" href="/news">Home</a></li>
	              	<li class="nav-item"><a class="nav-link" href="/admin">Conteúdo</a></li>
	            </ul>
	        </div>
	        <div class="header-content">
	            <h1 class="header-title">Blog</h1>
	            <div class="site-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
	        </div>
	    </div>
	</header>
</body>
<div class="container admin-feed shadow-sm">
	<div class="teste">
		<div class="alert alert-{{ Session::get('message-type') }} alert-dismissable">
	        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
	        <i class="glyphicon glyphicon-{{ Session::get('message-type') == 'success' ? 'ok' : 'remove'}}"></i> {{ Session::get('message') }}
	    </div>
    	<a id="insertNews" href="#insertNewsModal" class="link-add-news btn btn-default-blue" data-toggle="modal" data-target="#insertNewsModal">
        	<i class="icon ion-md-add-circle"></i><span>Adicionar Notícia</span>
      	</a>
        <table class="table">
        	<thead>
            	<tr>
              		<th scope="col">Título</th>
              		<th scope="col">Descrição</th>
              		<th scope="col">Categoria</th>
              		<th scope="col">Autor</th>
              		<th scope="col">Ações</th>
            	</tr>
            	{{ csrf_field() }}
          	</thead>
          	<tbody>
          		@foreach ($news as $value)
	            	<tr>
	              		<td><a href="{{ URL::to('news/' . $value->id) }}">{{ $value->title }}</a></td>
	              		<td>{{ str_limit($value->body, $limit = 70, $end = '...') }}</td>
	              		<td>{{ $value->category }}</td>
	              		<td>{{ $value->author }}</td>
	              		<td>
			                <a class="edit-form icon-edit" href="" data-toggle="modal" data-target="#editModal" data-id="{{$value->id}}" data-title="{{$value->title}}" data-body="{{$value->body}}" data-category="{{$value->category}}" data-author="{{$value->author}}" data-keywords="{{$value->keywords}}">
			                	<i class="icon ion-md-create"></i>
			                </a>
			                <a class="remove-news icon-delete" href="" data-toggle="modal" data-title="{{$value->title}}" data-id="{{$value->id}}" data-target="#deleteModal">
			                	<i class="icon ion-md-trash"></i>
			                </a>
	              		</td>
	            	</tr>
	            @endforeach
          	</tbody>
        </table>
    </div>
</div>

<div id="insertNewsModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
          	<form action="{{ route('news.store') }}" method="POST" id="addFormNews">
	            <div class="modal-header">
	            	<h4 class="modal-title">Adicionar Notícia</h4>
	              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            </div>
            	<div class="modal-body">
              		<div class="form-group">
                		<label>Título</label>
                		<input type="text" name="title" class="form-control" required>
              		</div>
              		<div class="form-group">
                		<label>Conteúdo</label>
                		<textarea class="form-control" name="body" required></textarea>
              		</div>
              		<div class="form-group">
                		<label>Categoria</label>
                		<input type="text" name="category" class="form-control" required>
              		</div>
              		<div class="form-group">
                		<label>Autor</label>
                		<input type="text" name="author" class="form-control">
              		</div>
              		<div class="form-group">
                		<label>Palavras-chave</label>
                		<input type="text" name="keywords" class="form-control">
              		</div>
            	</div>
            	<div class="modal-footer">
            		<button class="btn btn-default-blue" type="submit">
              			<span class="glyphicon glyphicon-plus"></span>Adicionar
            		</button>
            	</div>
          	</form>
        </div>
    </div>
</div>

<div id="editModal" class="modal fade">
    <div class="modal-dialog">
    	<div class="modal-content">
          	<form action="/news" method="put" id="editFormNews">
	            <div class="modal-header">
	              	<h4 class="modal-title">Editar Notícia</h4>
	              	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	            </div>
	            <div class="modal-body">
		            <div class="form-group">
		            	<label>ID</label>
		            	<input type="text" name="id" class="form-control" disabled>
		            </div>
		            <div class="form-group">
		            	<label>Título</label>
		            	<input type="text" name="title" class="form-control" required>
		            </div>
		            <div class="form-group">
		            	<label>Conteúdo</label>
		            	<textarea class="form-control" name="body" required></textarea>
		            </div>
	              	<div class="form-group">
	                	<label>Categoria</label>
	                	<input type="text" name="category" class="form-control" required>
	              	</div>
	              	<div class="form-group">
	                	<label>Autor</label>
	                	<input type="text" name="author" class="form-control" required>
	              	</div>
	              	<div class="form-group">
	                	<label>Palavras-chave</label>
	                	<input type="text" name="keywords" class="form-control" required>
	              	</div>
	            </div>
	            <div class="modal-footer">
            		<button class="btn btn-default-blue" id="edit" type="submit">
              			<span class="glyphicon glyphicon-plus"></span>Editar
            		</button>
            	</div>
        	</form>
     	</div>
    </div>
</div>

<div id="deleteModal" class="modal fade">
    <div class="modal-dialog">
    	<div class="modal-content">
	        <div class="modal-header">
	            <h4 class="modal-title">Excluir <span class="title"></span>?</h4>
	            <span class="hidden idNews"></span>
	            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
	        </div>
	        <div class="modal-body">
	            <p>Tem certeza que deseja excluir este registro?</p>
	        </div>
	        <div class="modal-footer">
            	<button class="btn btn-default-cancel" id="delete">
              		<span class="glyphicon glyphicon-plus"></span>Excluir
            	</button>
            </div>
        </div>
    </div>
</div>
@endsection