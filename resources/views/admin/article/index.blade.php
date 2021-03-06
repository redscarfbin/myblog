<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>文章列表</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.5 -->
	<link rel="stylesheet" href="/admin/bootstrap/css/bootstrap.min.css">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="/admin/dist/dfonts/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="/admin/dist/dfonts/ionicons.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="/admin/plugins/datatables/dataTables.bootstrap.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="/admin/dist/css/AdminLTE.min.css">
	<!-- AdminLTE Skins. Choose a skin from the css/skins
			 folder instead of downloading all of them to reduce the load. -->
	<link rel="stylesheet" href="/admin/dist/css/skins/_all-skins.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	<style>
	th{text-align:center;}
	.f-ib{display:inline-block;}
	#example1{margin-top:10px;}
	img{max-width: 100%; max-height: 500px;}
	.pic{position: relative; top: 7px; visibility: hidden;}
	.gal{margin-top: 20px;}
	.gallerys li{width:10%; min-width: 80px; position: relative;}
	.delpic{position: absolute; right: 0; top: -5px;}
	.gallery{width: 80px; height: 80px; background: url("/admin/image/catetypecreate/add.jpg") center center no-repeat; border: solid #ddd 1px;  cursor: pointer; display:table-cell; vertical-align: middle;}
	.gallery img{max-width: 100%; max-height: 100%;}
	.addpic{margin-top: -100px;}
	.hid{display:none;}
	</style>
	@include('UEditor::head')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
	@include('inc.admin.mainHead')
		<!-- Left side column. contains the logo and sidebar -->
	<aside class="main-sidebar">
		<!-- sidebar: style can be found in sidebar.less -->
		@include('inc.admin.sidebar')
		<!-- /.sidebar -->
	</aside>

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>文章列表</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-body">
							<table class="table table-bordered table-striped">
								<tr>
									<th width="5">ID</th>
									<th width="25%">标题</th>
									<th width="25%">副标题</th>
									<th width="10%">作者</th>
									<th width="20%">发布时间</th>
									<th width="15%">操作</th>
								</tr>
								@foreach ($article_list as $data)
								<tr>
								    <td align="center">{{$data->article_id}}</td>
									<td align="center"><a href="http://www.rqbin.net/article/info/{{$data->article_id}}" target="_blank">{{$data->title}}</a></td>
									<td align="center">{{$data->subheading}}</td>
									<td align="center">{{$data->author}}</td>
									<td align="center">{{$data->created_at}}</td>
									<td align="center" class="hid">{{htmlspecialchars($data->content)}}</td>
									<td align="center">
										<button type='button' class='edit f-ib btn btn-primary btn-xs' data-toggle="modal" data-target="#myModal">编辑</button>
										<button type="button" class="del f-ib btn btn-danger btn-xs" data-id="{{$data->article_id}}">删除</button>
									</td>
								</tr>
								@endforeach
								<tr>
								  <td colspan="6" align="center">
									<?php echo $article_list->render(); ?>
								  </td>
								</tr>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</section>
		<!-- /.content -->
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title">文章编辑</h4>
				</div>
				<div class="modal-body">
					<form role="form" class="form-horizontal" action="" method="post" id="updateform">
						<input type="hidden" name="_method" value="PUT">
						<div class="form-group">
							<label class="col-sm-2 control-label" for="name">标题</label>
							<div class="col-sm-8">
								<input type="text" name="title" class="form-control" id="title" placeholder="标题15字以内" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="name">副标题</label>
							<div class="col-sm-8">
								<input type="text" name="subheading" class="form-control" id="subheading" placeholder="副标题20字以内" required>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label" for="name">内容</label>
							<div class="col-sm-10" id="container">
								<div style="padding-left:0" class="col-sm-10" id="editer">
								<script type="text/javascript">
									UE.getEditor('editer');
								</script>
								</div>
							</div>
						</div>
						<div class="form-group text-center">
							<label class="col-sm-3 control-label"></label>
							<div class="col-sm-3">
								<button type="submit" class="btn btn-info" id="save">保存</button>
							</div>
						</div><!--end form-group text-center-->
					</form>
					<hr>
					<h5 class="text-center">图片信息</h5>
						<div id="method"></div>
						<input type="hidden" name="cid" id="cid">
						<div class="gal form-group">
							<table class="table">
								<input type="hidden" id="chat_id" value="">
								<input type="hidden" id="imgdata" value="">

								<tr id="imgcontent">
								</tr>
							</table>
						</div>
				</div>
			</div>
		</div>
	</div>
	<!-- /.content-wrapper -->
    <input type="hidden" id="activeFlag" value="treearticle">
	@include('inc.admin.footer')
</div>
<!-- ./wrapper -->
<!-- Bootstrap 3.3.5 -->
<script src="/admin/bootstrap/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="/admin/plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="/admin/dist/js/app.min.js"></script>
{{--引入jquery插件验证表单--}}
<script src="/admin/plugins/form/jquery.validate.min.js"></script>
<script src="/admin/js/jquery.form.js"></script>
<script src="/admin/js/webuploader.html5only.min.js"></script>
<script src="/admin/js/diyUpload.js"></script>
<script src="/admin/js/article.js"></script>
</body>
</html>
