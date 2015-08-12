
<div class="container">
	<div class="clearfix">
		<h1 class="pull-left"><?php echo $this->title; ?></h1>
		<a href="/professors/show/<?php echo $id; ?>" class="btn btn-primary pull-right">← back to professor</a>
	</div>

	  <?php if($this->is_error('save')): ?>
	  	<p class='alert alert-danger'>Sorry, something went wrong. Please try later...</p>
	  <?php elseif($this->msg('saved')): ?>
	    <p class='alert alert-success'>Professor successfully changed! <a href="/admin/professors" class="btn btn-primary"> Back to list</a></p>
	  <?php endif; ?>

	  <form method="post" action="/professors/comment/<?php echo $id; ?>">
	    <div class="form-group<?php echo $this->is_error('title') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="title">
	        <?php if ($this->is_error('title', 'required')): ?>
	          Title must not be blank
	        <?php else: ?>
	          Title
	        <?php endif; ?>
	      </label>
	      <input type="text" name="title" class="form-control" id="title" placeholder="Title" value="<?php echo $title ?>">
	    </div>
	    <div class="form-group<?php echo $this->is_error('estimate') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="estimate">
	        <?php if ($this->is_error('estimate', 'required')): ?>
	          Estimate must not be blank
	        <?php else: ?>
	          Estimate from 1 to 10
	        <?php endif; ?>
	      </label>
	      <input type="text" name="estimate" class="form-control" id="estimate" placeholder="Estimate" value="<?php echo $estimate ?>">
	    </div>
	    <div class="form-group<?php echo $this->is_error('comment') ? ' has-error' : ''; ?>">
	      <label class="control-label" for="comment">
	        <?php if ($this->is_error('comment', 'required')): ?>
	          Comment must not be blank
	        <?php else: ?>
	          Comment
	        <?php endif; ?>
	      </label>
	      <textarea name="comment" class="form-control" id="comment"><?php echo $comment; ?></textarea>
	    </div>
	    <button type="submit" class="btn btn-success">Save</button>
	  </form>
</div>