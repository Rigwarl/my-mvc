
<div class="container">
	<h1><?php echo $this->title; ?></h1>

	<?php if($this->is_error('empty')): ?>
	    <p class='alert alert-danger'>Search rules must not be empty...</p>
	<?php endif; ?>

	<form method="post" action="/professors/find" class="form-inline mb15">
	  <div class="form-group">
		<label class="control-label" for="name">Name</label>
		<input type="text" name="name" class="form-control" id="name" placeholder="Name" value="<?php echo $name; ?>">
	  </div>
	  <div class="form-group">  
		<label class="control-label" for="patronymic">Patronymic</label>
		<input type="patronymic" name="patronymic" class="form-control" id="patronymic" placeholder="Patronymic" value="<?php echo $patronymic; ?>">
	  </div>
	  <div class="form-group">  
		<label class="control-label" for="surname">Surname</label>
		<input type="surname" name="surname" class="form-control" id="surname" placeholder="Surname" value="<?php echo $surname; ?>">
	  </div>
	  <button type="submit" class="btn btn-primary">Search</button>
	</form>

	<?php if ($professors): ?>
		<ul>
			<?php foreach ($professors as $professor): ?>
				
				<li><a href="/professors/show/<?php echo $professor['id']; ?>"><?php echo $professor['name'] . " " . $professor['patronymic'] . " " . $professor['surname'] ; ?></a></li>

			<?php endforeach; ?>
		</ul>
	<?php else: ?>
		<p class="alert alert-warning">Nothing found, we are sorry...</p>
	<?php endif; ?>
</div>