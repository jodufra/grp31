@extends('layouts.scaffold')

@section('body')

<div class="col-md-8 col-md-offset-2">
	<h1>Create Game</h1>
	<div class="row">
		<div class="col-md-7">
			<div class="row row-item">
				<div class="media">
					<a class="media-left media-middle" href="">
						<span ng-hide="userHavePicture()" class="fa-stack fa-lg text-muted">
							<i class="fa fa-user fa-stack-1x"></i>
							<i class="fa fa-square-o fa-stack-2x"></i>
						</span>
						<img class="hidden" alt="" src="...">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
					</div>
				</div>
				<div class="media">
					<a class="media-left media-middle" href="">
						<span ng-hide="userHavePicture()" class="fa-stack fa-lg text-muted">
							<i class="fa fa-user fa-stack-1x"></i>
							<i class="fa fa-square-o fa-stack-2x"></i>
						</span>
						<img class="hidden" alt="" src="...">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
					</div>
				</div>	
				<div class="media">
					<a class="media-left media-middle" href="">
						<span ng-hide="userHavePicture()" class="fa-stack fa-lg text-muted">
							<i class="fa fa-user fa-stack-1x"></i>
							<i class="fa fa-square-o fa-stack-2x"></i>
						</span>
						<img class="hidden" alt="" src="...">
					</a>
					<div class="media-body">
						<h4 class="media-heading">Media heading</h4>
					</div>
				</div>		
			</div>					
		</div>
		<div class="col-md-4 col-md-offset-1">
			<div class="row row-item">
				<table class="table">
					<thead><th>Invitations</th></thead>
					<tbody>
						<td>
							<div class="media">
								<a class="media-left media-middle" href="">
									<i class="fa fa-spinner fa-spin"></i>
								</a>
								<div class="media-body">
									<span class="media-heading">Media heading</span>
								</div>
							</div>
							<div class="media">
								<a class="media-left media-middle" href="">
									<i class="fa fa-remove text-danger"></i>
								</a>
								<div class="media-body">
									<span class="media-heading">Media heading</span>
								</div>
							</div>
							<div class="media">
								<a class="media-left media-middle" href="">
									<i class="fa fa-check text-success"></i>
								</a>
								<div class="media-body">
									<span class="media-heading">Media heading</span>
								</div>
							</div>
						</td>
					</tbody>
				</table>
			</div>
			<div class="row row-item">
				<table class="table">
					<thead><th>Friends List</th></thead>
					<tbody>
						<td>
							<div class="media">
								<a class="media-left media-middle" href="">
									<i class="fa fa-plus"></i>
								</a>
								<div class="media-body">
									<span class="media-heading">Media heading</span>
								</div>
							</div>
							<div class="media">
								<a class="media-left media-middle" href="">
									<i class="fa fa-plus"></i>
								</a>
								<div class="media-body">
									<span class="media-heading">Media heading</span>
								</div>
							</div>
						</td>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="row">
		<hr>
		<button class="btn btn-default ">Quit</button>
		<button class="btn btn-primary pull-right">Start Game</button>
	</div>
</div>
@endsection
