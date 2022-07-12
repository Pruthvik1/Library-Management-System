 <!-- .site-header -->
 <?=$this->Flash->render()?>
 <?= $this->Html->css('milligram.min.css') ?>

 <div class='container'>
 	<div class="page">
 		<div class="container">
 			<div class="row">
 				<div class="col-md-5">
 					<div class="project-images w-100 h-100" style="height: 80%!important;">
 						<?= $this->Html->image($book->book_img,['style'=>'width:330px;height:450px']) ?>
 					</div>
 					<div style="margin-bottom:9px ;">Auther: &nbsp;&nbsp;&nbsp;&nbsp;  <?= h($book->auther) ?></div>
 					<div style="margin-bottom:9px ;">Category: &nbsp;<?= h($book->category->name) ?></div>
 					<div style="margin-bottom:9px ;">ISBN No:  &nbsp;<?= h($book->isbn_no) ?></div>
 					<div style="margin-bottom:9px ;"><?= $this->Html->link(
								'Borrow Book',
								['controller' => 'users', 'action' => 'borrowBook',$book->id],
								['class'=>'btn btn-danger']
							); ?></div>
 				</div>
 				<div class="col-md-7">
 					<div class="project-detail">
 						<h2 class="project-title"><?= h($book->title) ?></h2>
 						<?= h($book->summary) ?>
 					</div>
 				</div>
 			</div>
 		</div>
 	</div>
 </div> 